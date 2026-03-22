<?php
// 1. START SESSION & SECURITY CHECK
session_start();

// If the user is NOT logged in, redirect them to the login page
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: online-results.html");
    exit();
}

// 2. GRAB USER DATA FROM SESSION
$patientName = $_SESSION['patient_name'];
$patientRef = $_SESSION['patient_ref'];

// (Optional) In a real app, you would query the database here using $patientRef 
// to get their actual test results. For now, we will use some mock data.
$mockResults = [
    ['test_name' => 'Complete Blood Count (CBC)', 'date' => 'Oct 24, 2026', 'status' => 'Completed'],
    ['test_name' => 'Fasting Blood Sugar (FBS)', 'date' => 'Oct 24, 2026', 'status' => 'Completed'],
    ['test_name' => 'Urinalysis', 'date' => 'Oct 24, 2026', 'status' => 'Pending']
];
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
        
        .btn-download { background-color: var(--dark-gray); color: white; padding: 8px 12px; border-radius: 4px; font-size: 14px; transition: 0.2s; border: none; cursor: pointer;}
        .btn-download:hover { background-color: #111; }
        .btn-download:disabled { background-color: #ccc; cursor: not-allowed; }
    </style>
</head>
<body>

    <header>
        <div class="logo">
                <img src="images/logo.jpg" onerror="this.src='https://placehold.co/300x80/ffffff/FFC107?text=Diagnostic+Logo'" alt="Company Logo">
            </div>
        <div class="user-menu">
            <div class="user-info">
                <strong><?php echo htmlspecialchars($patientName); ?></strong>
                <span>Ref: <?php echo htmlspecialchars($patientRef); ?></span>
            </div>
            <a href="logout.php" class="btn-logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
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
                    <?php foreach($mockResults as $result): ?>
                    <tr>
                        <td><strong><?php echo $result['test_name']; ?></strong></td>
                        <td><?php echo $result['date']; ?></td>
                        <td>
                            <?php if($result['status'] == 'Completed'): ?>
                                <span class="status-badge status-completed"><i class="fa-solid fa-check"></i> Completed</span>
                            <?php else: ?>
                                <span class="status-badge status-pending"><i class="fa-solid fa-clock"></i> Pending</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($result['status'] == 'Completed'): ?>
                                <button class="btn-download"><i class="fa-solid fa-download"></i> View PDF</button>
                            <?php else: ?>
                                <button class="btn-download" disabled>Unavailable</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
