<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';
require_once 'db_connection.php';
require_once 's3_config.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// 1. Check if the form was actually submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Grab the text data from the form
    $refNumber = trim($_POST['ref_number']);
    $lastName = trim($_POST['last_name']);
    $testName = trim($_POST['test_name']);
    $examDate = $_POST['exam_date'];
    
    // Grab the file data
    $file = $_FILES['result_pdf'];

    // 2. Validate that it is actually a PDF
    if ($file['type'] !== 'application/pdf') {
        header("Location: ../frontend/admin.php?error=" . urlencode("Only PDF files are allowed."));
        exit();
    }

    // 3. Create a unique file name for S3 (e.g., REF99999_CBC_1701234567.pdf)
    // This prevents old files from being overwritten if a patient gets the same test twice!
    $safeTestName = preg_replace('/[^A-Za-z0-9]/', '', $testName);
    $uniqueFileName = $refNumber . '_' . $safeTestName . '_' . time() . '.pdf';

    // 4. Initialize AWS S3 Connection
    $s3Client = new S3Client([
        'region'  => 'us-east-1',
        'version' => 'latest'
    ]);

    try {
        // 5. Upload the physical file to the AWS S3 Bucket
        $result = $s3Client->putObject([
            'Bucket'      => $S3_BUCKET,
            'Key'         => $uniqueFileName,
            'SourceFile'  => $file['tmp_name'],
            'ContentType' => 'application/pdf'
        ]);

        // 6. If S3 upload is successful, write the record into the RDS Database
        $pdo = getDatabaseConnection();
        $stmt = $pdo->prepare("
            INSERT INTO patient_results (reference_number, last_name, test_name, exam_date, result_status, result_pdf_key) 
            VALUES (?, ?, ?, ?, 'Available', ?)
        ");
        $stmt->execute([$refNumber, $lastName, $testName, $examDate, $uniqueFileName]);

        // 7. Kick the admin back to the form with a success message!
        header("Location: ../frontend/admin.php?success=1");
        exit();

    } catch (AwsException $e) {
        // Catch AWS errors (like permission issues)
        header("Location: ../frontend/admin.php?error=" . urlencode("AWS S3 Error: " . $e->getAwsErrorMessage()));
        exit();
    } catch (\PDOException $e) {
        // Catch Database errors
        header("Location: ../frontend/admin.php?error=" . urlencode("Database Error: " . $e->getMessage()));
        exit();
    }
} else {
    // If someone tries to visit upload.php directly without submitting the form
    header("Location: ../frontend/admin.php");
    exit();
}
