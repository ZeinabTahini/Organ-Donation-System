<?php
session_start();
include_once 'conx.php';

// Check if the donor ID and pid are provided in the URL parameters
if(isset($_GET["did"]) && isset($_GET['pid'])) {
    // Get the donor ID and pid from the URL parameters
    $did = $_GET["did"];
    $pid = $_GET['pid'];

    // Set status to 1
    $status = 1;

    // Update the status of the patient_details in the patient table
    $update_sql = "UPDATE patient_details SET status = $status WHERE pid='$pid'";
    if(mysqli_query($con, $update_sql)) {
        // If status update is successful, update the status in the send table
        $sql = "UPDATE send SET status='$status' WHERE did='$did'";
        if(mysqli_query($con, $sql)) {
            // If update is successful, display an alert and then redirect after a short delay
            echo "<script>
                    alert('Record successfully accepted.');
                    setTimeout(function() {
                        window.location.href = 'matching-donor.php?pid=$pid';
                    }, 1000); // Redirect after 1 second (1000 milliseconds)
                  </script>";
            exit();
        } else {
            // If update fails, display an error message or handle the error as per your requirement
            echo "Error updating status: " . mysqli_error($con);
        }
    } else {
        // If status update fails, display an error message or handle the error as per your requirement
        echo "Error updating status: " . mysqli_error($con);
    }
} else {
    // If the donor ID or pid is not provided in the URL parameters, handle the situation accordingly
    echo "Donor ID or PID not provided.";
}
?>
