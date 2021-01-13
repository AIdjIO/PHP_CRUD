<?php error_reporting(0);
session_start(); /* Starts the session */
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy(); /* Destroy started session */
header("location:index.php");  /* Redirect to login page */
exit;
?>

