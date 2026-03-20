<?php
session_start();
// Unset all session variables
$_SESSION = array();
// Destroy the session completely
session_destroy();
// Redirect them back to the login page
header("Location: ../frontend/online-results.html");
exit();
?>
