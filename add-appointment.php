<?php
include_once 'conx.php';

$h_name = $_POST['h_name'];
$h_email = $_POST['h_email'];
$id = $_POST['id']; // Corrected to retrieve doctor's name
$pid = $_POST['pid'];
$did = $_POST['did'];
$time = $_POST['time'];
$date = $_POST['date']; 
$message = $_POST['message']; 
$hid = $_POST['hid'];

// Check if the selected date is before the current date
$currentDate = date('Y-m-d');
if ($date < $currentDate) {
    echo "<script>
            alert('Error: Please select a date after the current date.');
            window.location.href = 'appointment.php';
          </script>";
    exit; // Stop further execution
}

// Check if the selected date is already saved in the database
$sql_check_query = "SELECT * FROM appointment WHERE date = '$date'";
$result_check = mysqli_query($con, $sql_check_query);
if (mysqli_num_rows($result_check) > 0) {
    echo "<script>
            alert('Error: This date is already scheduled for an appointment.');
            window.location.href = 'appointment.php';
          </script>";
    exit; // Stop further execution
}

// Insert into appointment table
$sql_add_query = "INSERT INTO appointment (hid, h_name, h_email, id, pid, did, time, date, message, status) 
VALUES ('$hid', '$h_name','$h_email', '$id', '$pid','$did','$time','$date', '$message', 1)";

$result= mysqli_query($con, $sql_add_query);

// Delete from the send table
$sql_delete_query = "DELETE FROM send WHERE pid='$pid' AND did='$did'";
$result_delete = mysqli_query($con, $sql_delete_query);

// Check if insertion and deletion were successful
if ($result && $result_delete) {
   echo "<script>
        alert('Appointment Submitted');
        window.open('saved-appointment.php','_self');
      </script>";
} else {
    echo "Error: " . mysqli_error($con);
}
?>
