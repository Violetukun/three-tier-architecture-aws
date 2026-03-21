<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';
require_once 'db_connection.php';
require_once 's3_config.php';

$pdo = getDatabaseConnection();
use Aws\S3\S3Client;

$s3Client = new S3Client([
    'region' => 'us-east-1',
    'version' => 'latest'
]);

$bucket = $S3_BUCKET; 

// Dynamic Listener
if (!isset($_GET['file']) || empty($_GET['file'])) {
    die("<h2>Error: No file specified in the URL.</h2>");
}
$key = $_GET['file']; 

try {
    $cmd = $s3Client->getCommand('GetObject', [
        'Bucket' => $bucket,
        'Key'    => $key
    ]);

    $request = $s3Client->createPresignedRequest($cmd, '+20 minutes');
    $presignedUrl = (string)$request->getUri();

    header("Location: " . $presignedUrl);
    exit;

} catch (Exception $e) {
    echo "<h2>AWS Error:</h2><p>" . $e->getMessage() . "</p>";
}
// NO CLOSING PHP TAG HERE
