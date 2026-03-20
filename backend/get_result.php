<?php
require 'vendor/autoload.php'; // Loads the AWS SDK
use Aws\S3\S3Client;

// 1. Connect to S3
$s3Client = new S3Client([
    'region' => 'us-east-1',
    'version' => 'latest'
]);

$bucket = 'your-diagnostic-results-bucket';
$key = 'results/REF12345_lab_report.pdf'; // This filename should come from your RDS database

// 2. Create a Pre-Signed URL (valid for 20 minutes)
$cmd = $s3Client->getCommand('GetObject', [
    'Bucket' => $bucket,
    'Key'    => $key
]);

$request = $s3Client->createPresignedRequest($cmd, '+20 minutes');

// 3. Get the actual string URL
$presignedUrl = (string)$request->getUri();

// Now, in your HTML, you just use:
// <a href="<?php echo $presignedUrl; ?>" class="btn">Download Results</a>
?>