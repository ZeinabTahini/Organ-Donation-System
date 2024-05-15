<?php
session_start();
include_once 'conx.php';

// Check if 'did' parameter is set in the URL
if(isset($_GET["did"])) {
    // Sanitize input to prevent SQL injection
    $did = mysqli_real_escape_string($con, $_GET["did"]);
    
    // Construct the SQL query
    $sql = "DELETE FROM wills WHERE did='$did'";
    
    // Execute the query
    if(mysqli_query($con, $sql)) {
        // If deletion is successful, redirect back to saved-wills.php
        $_SESSION['success_message'] = "Record deleted successfully";
        header("location:saved-wills.php?did=$did");
        exit(); // Terminate the script after redirection
    } else {
        // If deletion fails, handle the error accordingly
        $_SESSION['error_message'] = "Error deleting record: " . mysqli_error($con);
        header("location:saved-wills.php?did=$did");
        exit(); // Terminate the script after redirection
    }
} else {
    // If 'did' parameter is not set in the URL, redirect back to saved-wills.php
    $_SESSION['error_message'] = "Invalid request";
    header("location:saved-wills.php");
    exit(); // Terminate the script after redirection
}

?>