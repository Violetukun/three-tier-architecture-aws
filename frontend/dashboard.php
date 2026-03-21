<?php
// PHP SECURITY AND DATABASE FETCHING LOGIC
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['patient_ref'])) {
    header("Location: index.php");
    exit();
}

require_once '../backend/db_connection.php';
$pdo = getDatabaseConnection();

$patientName = $_SESSION['patient_name'] ?? 'Patient';
$patientRef = $_SESSION['patient_ref'];

$stmt = $pdo->prepare("
    SELECT test_name, DATE_FORMAT(exam_date, '%b %d, %Y') AS formatted_date, result_status, result_pdf_key
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
    <title>My Results - Diagnostic Center</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* INHERITING YOUR BEAUTIFUL YELLOW THEME */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f4f7f6; color: #333; display: flex; flex-direction: column; min-height: 100vh; }
        a { text-decoration: none; color: inherit; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        
        :root {
            --primary-yellow: #FFC107;
            --primary-hover: #e0a800;
            --dark-gray: #333;
        }

        .btn { padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; transition: 0.2s; text-decoration: none; display: inline-block;}
        .btn-yellow { background-color: var(--primary-yellow); color: var(--dark-gray); }
        .btn-yellow:hover { background-color: var(--primary-hover); }
        .btn-dark { background-color: var(--dark-gray); color: white; }
        .btn-dark:hover { background-color: #111; }

        header { background-color: white; padding: 20px 0; border-bottom: 4px solid var(--primary-yellow); }
        .header-content { display: flex; justify-content: space-between; align-items: center; }
        .logo img { height: 60px; }

        /* DASHBOARD SPECIFIC STYLES */
        .dashboard-header { display: flex; justify-content: space-between; align-items: flex-end; margin-top: 40px; margin-bottom: 30px; }
        .dashboard-header h1 { color: var(--dark-gray); font-size: 32px; }
        .dashboard-header p { color: #666; font-size: 16px; margin-top: 5px; }
        
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        th, td { padding: 20px; text-align: left; border-bottom: 1px solid #eee; }
        th { background-color: var(--dark-gray); color: var(--primary-yellow); font-size: 16px; letter-spacing: 1px; }
        tr:hover { background-color: #fbfbfb; }
        
        .status-badge { padding: 6px 12px; border-radius: 20px; font-size: 0.85em; font-weight: bold; }
        .status-completed { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb;}
        .status-pending { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba;}

        footer { border-top: 1px solid #ccc; padding: 20px 0; margin-top: auto; font-size: 14px; color: #666; background: white; text-align: center; }
    </style>
</head>
<body>

    <header>
        <div class="container header-content">
            <div class="logo">
                <img src="images/logo.png" onerror="this.src='https://placehold.co/300x80/ffffff/FFC107?text=Diagnostic+Logo'" alt="Company Logo">
            </div>
            <div class="header-buttons">
                <a href="logout.php" class="btn btn-dark"><i class="fa-solid fa-right-from-bracket"></i> Secure Logout</a>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="dashboard-header">
            <div>
                <h1>Welcome, <?php echo htmlspecialchars($patientName); ?></h1>
                <p>Reference Number: <strong><?php echo htmlspecialchars($patientRef); ?></strong></p>
            </div>
        </div>

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
                        <td colspan="4" style="text-align: center; padding: 50px; color: #888;">
                            <i class="fa-solid fa-folder-open" style="font-size: 40px; color: #ccc; margin-bottom: 15px;"></i><br>
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
                                <a href="../backend/get_result.php?file=<?php echo urlencode($result['result_pdf_key']); ?>" class="btn btn-yellow" target="_blank">
                                    <i class="fa-solid fa-file-pdf"></i> View Result
                                </a>
                            <?php else: ?>
                                <span style="color: #999; font-style: italic;">Processing...</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2026 Diagnostic Center. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>
