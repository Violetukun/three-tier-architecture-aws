<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Security Check
if (!isset($_SESSION['patient_ref'])) {
    header("Location: index.php");
    exit();
}

require_once '../backend/db_connection.php';
$pdo = getDatabaseConnection();

$patientName = $_SESSION['patient_name'] ?? 'Patient';
$patientRef = $_SESSION['patient_ref'];

// Fetch the patient's data
$stmt = $pdo->prepare("
    SELECT test_name, 
           DATE_FORMAT(exam_date, '%b %d, %Y') AS formatted_date, 
           result_status,
           result_pdf_key
    FROM patient_results 
    WHERE reference_number = ?
    ORDER BY exam_date DESC
");
$stmt->execute([$patientRef]);
$realResults = $stmt->fetchAll(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard - Diagnostic Center</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; margin: 0; padding: 20px; }
        .dashboard-container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #eee; padding-bottom: 20px; margin-bottom: 30px; }
        .logout-btn { color: #dc3545; text-decoration: none; font-weight: bold; font-size: 1.1em; }
        .logout-btn:hover { text-decoration: underline; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; color: #333; }
        .status-badge { padding: 5px 10px; border-radius: 20px; font-size: 0.9em; font-weight: bold; }
        .status-completed { background-color: #d4edda; color: #155724; }
        .status-pending { background-color: #fff3cd; color: #856404; }
        .view-btn { background-color: #007bff; color: white; padding: 8px 15px; text-decoration: none; border-radius: 5px; font-size: 0.9em; }
        .view-btn:hover { background-color: #0056b3; }
    </style>
</head>
<body>

<div class="dashboard-container">
    <div class="header">
        <div>
            <h1>Welcome, <?php echo htmlspecialchars($patientName); ?></h1>
            <p style="color: #666; margin-top: 5px;">Reference Number: <strong><?php echo htmlspecialchars($patientRef); ?></strong></p>
        </div>
        <a href="logout.php" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>

    <h2>Your Laboratory Results</h2>

    <table>
        <thead>
            <tr>
                <th>Test Name</th>
                <th>Date of Exam</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($realResults)): ?>
                <tr>
                    <td colspan="4" style="text-align: center; padding: 30px; color: #666;">
                        <i class="fa-solid fa-folder-open" style="font-size: 24px; color: #ccc; margin-bottom: 10px;"></i><br>
                        No laboratory results found for this reference number yet.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($realResults as $result): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($result['test_name']); ?></strong></td>
                    <td><?php echo htmlspecialchars($result['formatted_date']); ?></td>
                    <td>
                        <?php if ($result['result_status'] == 'Available'): ?>
                            <span class="status-badge status-completed"><i class="fa-solid fa-check"></i> Available</span>
                        <?php else: ?>
                            <span class="status-badge status-pending"><i class="fa-solid fa-clock"></i> Pending</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!empty($result['result_pdf_key'])): ?>
                            <a href="../backend/get_result.php?file=<?php echo urlencode($result['result_pdf_key']); ?>" class="view-btn" target="_blank">
                                <i class="fa-solid fa-file-pdf"></i> View PDF
                            </a>
                        <?php else: ?>
                            <span style="color: #999;"><i>Pending</i></span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
