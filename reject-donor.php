<?php
session_start();
include_once 'conx.php';

// Check if the donor ID is provided in the URL parameter
if(isset($_GET["did"])) {
    // Get the donor ID from the URL parameter
    $did = $_GET["did"];

    // Update the status of the donor in the donor table
    $update_sql = "UPDATE donor_details SET status = 0 WHERE did='$did'";
    if(mysqli_query($con, $update_sql)) {
        // If status update is successful, proceed to delete the record from the send table
        $delete_sql = "DELETE FROM send WHERE did='$did'";
        if(mysqli_query($con, $delete_sql)) {
            // If deletion is successful, show an alert
            echo "<script>alert('Record successfully rejected.');</script>";
            // Redirect back to matching-donor.php with the same URL parameters
            $pid = isset($_GET['pid']) ? $_GET['pid'] : '';
            echo "<script>window.location='matching-donor.php?pid=$pid&success=1';</script>";
            exit();
        } else {
            // If deletion fails, display an error message or handle the error as per your requirement
            echo "Error deleting record: " . mysqli_error($con);
        }
    } else {
        // If status update fails, display an error message or handle the error as per your requirement
        echo "Error updating status: " . mysqli_error($con);
    }
} else {
    // If the donor ID is not provided in the URL parameter, handle the situation accordingly
    echo "Donor ID not provided.";
}
?>
