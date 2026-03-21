<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1. START SESSION & SECURITY CHECK
session_start();

// If the user is NOT logged in, redirect them
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: online-results.html");
    exit();
}

// 2. CONNECT TO THE DATABASE
require_once '../backend/db_connection.php'; 
$pdo = getDatabaseConnection(); // <--- WE JUST NEED TO ADD THIS LINE!

$patientName = $_SESSION['patient_name'];
$patientRef = $_SESSION['patient_ref'];

// 3. THE MAGIC: FETCH REAL DATA FROM AWS RDS
// We format the SQL date to match your "Oct 24, 2026" UI style
$stmt = $conn->prepare("
    SELECT test_name, 
           DATE_FORMAT(exam_date, '%b %d, %Y') AS formatted_date, 
           result_status 
    FROM patient_results 
    WHERE reference_number = ?
    ORDER BY exam_date DESC
");
$stmt->execute([$patientRef]);
$realResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard - Diagnostic Center</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* --- Reuse our Global Styles --- */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f4f7f6; color: #333; }
        a { text-decoration: none; color: inherit; }
        
        :root {
            --primary-yellow: #FFC107;
            --primary-hover: #e0a800;
            --dark-gray: #333;
            --success-green: #2ab072;
        }

        /* --- Dashboard Header --- */
        header { background-color: white; padding: 15px 40px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; }
        .logo img { height: 50px; }
        
        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-info { text-align: right; }
        .user-info strong { display: block; color: var(--dark-gray); }
        .user-info span { font-size: 12px; color: #666; }
        
        .btn-logout { background-color: #dc3545; color: white; padding: 8px 15px; border-radius: 4px; font-weight: bold; transition: 0.2s; border: none; cursor: pointer;}
        .btn-logout:hover { background-color: #c82333; }

        /* --- Main Content --- */
        .container { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
        
        .welcome-banner { background-color: var(--primary-yellow); color: var(--dark-gray); padding: 30px; border-radius: 10px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 6px rgba(0,0,0,0.05);}
        .welcome-banner h1 { font-size: 28px; margin-bottom: 5px; }
        .welcome-banner p { font-size: 16px; opacity: 0.9; }
        
        /* --- Results Table --- */
        .results-card { background: white; border-radius: 10px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .results-card h2 { margin-bottom: 20px; color: var(--dark-gray); border-bottom: 2px solid #eee; padding-bottom: 10px; }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background-color: #f8f9fa; color: #555; font-weight: 600; }
        
        .status-badge { padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: bold; }
        .status-completed { background-color: #e8f5e9; color: var(--success-green); }
        .status-pending { background-color: #fff3cd; color: #856404; }
        
        /* Added display: inline-block so the <a> tag looks like a button */
        .btn-download { display: inline-block; background-color: var(--dark-gray); color: white; padding: 8px 12px; border-radius: 4px; font-size: 14px; transition: 0.2s; border: none; cursor: pointer;}
        .btn-download:hover { background-color: #111; color: white; }
        .btn-download:disabled { background-color: #ccc; cursor: not-allowed; }
    </style>
</head>
<body>

    <header>
        <div class="logo">
            <img src="https://placehold.co/300x80/ffffff/FFC107?text=Diagnostic+Logo" alt="Company Logo">
        </div>
        <div class="user-menu">
            <div class="user-info">
                <strong><?php echo htmlspecialchars($patientName); ?></strong>
                <span>Ref: <?php echo htmlspecialchars($patientRef); ?></span>
            </div>
            <a href="../backend/logout.php" class="btn-logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </header>

    <div class="container">
        
        <div class="welcome-banner">
            <div>
                <h1>Hello, <?php echo htmlspecialchars($patientName); ?>!</h1>
                <p>Welcome to your secure patient portal.</p>
            </div>
            <i class="fa-solid fa-file-medical" style="font-size: 50px; opacity: 0.8;"></i>
        </div>

        <div class="results-card">
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
                        <?php foreach($realResults as $result): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($result['test_name']); ?></strong></td>
                            <td><?php echo htmlspecialchars($result['formatted_date']); ?></td>
                            <td>
                                <?php if($result['result_status'] == 'Available'): ?>
                                    <span class="status-badge status-completed"><i class="fa-solid fa-check"></i> Available</span>
                                <?php else: ?>
                                    <span class="status-badge status-pending"><i class="fa-solid fa-clock"></i> Pending</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($result['result_status'] == 'Available'): ?>
                                    <a href="../backend/get_result.php?ref=<?php echo urlencode($patientRef); ?>" target="_blank" class="btn-download">
                                        <i class="fa-solid fa-download"></i> View PDF
                                    </a>
                                <?php else: ?>
                                    <button class="btn-download" disabled>Unavailable</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
