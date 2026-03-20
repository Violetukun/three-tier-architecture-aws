<?php
session_start();

// 1. Bring in the connection function we just created
require_once 'db_connection.php';

try {
    // 2. Call the function to establish the secure connection
    $pdo = getDatabaseConnection();

    // Check if the form was actually submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $refNumber = trim($_POST['refNumber']);
        $lastName = trim($_POST['lastName']);

        // Prepare the SQL query
        // Note: UPPER() ensures it matches even if they typed lowercase by mistake
        $stmt = $pdo->prepare("SELECT * FROM patient_results WHERE reference_number = :ref AND UPPER(last_name) = UPPER(:lname)");
        
        // Bind the form data to the query (This prevents SQL Injection hackers!)
        $stmt->bindParam(':ref', $refNumber);
        $stmt->bindParam(':lname', $lastName);
        
        // Run the query
        $stmt->execute();
        $patient = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if a matching patient was found
        if ($patient) {
            // Success! Save their info in the session
            $_SESSION['logged_in'] = true;
            $_SESSION['patient_ref'] = $patient['reference_number'];
            $_SESSION['patient_name'] = $patient['last_name'];
            
            // Redirect them to their actual results dashboard
            header("Location: ../frontend/dashboard.php");
            exit();
        } else {
            // Failed login
            echo "<script>
                    alert('Invalid Reference Number or Last Name. Please try again.');
                    window.location.href = '../frontend/online-results.html'
                  </script>";
        }
    }
} catch(PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>
