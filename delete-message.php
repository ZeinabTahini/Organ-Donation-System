<?php
include_once 'conx.php';

if(isset($_GET['pid']) && isset($_GET['did']) && isset($_GET['date']) && isset($_GET['time'])) {
    $pid = $_GET['pid'];
    $did = $_GET['did'];
    $date = $_GET['date'];
    $time = $_GET['time'];

    // Assuming you have a table named 'donor_messages' where messages are stored
    $sql = "DELETE FROM donor_messages WHERE pid='$pid' AND date='$date' AND time='$time'";
    
    if(mysqli_query($con, $sql)) {
        // Redirect back to the same page with the same pid, did, and date values
        header("Location: conversation.php?did=$did&pid=$pid&date=$date");
        exit();
    } else {
        echo "Error deleting message: " . mysqli_error($con);
    }
} else {
    echo "Invalid parameters.";
}
?>
