<?php
include_once 'conx.php';

// Retrieve the did and pid from the URL parameters
$pid = isset($_GET['pid']) ? $_GET['pid'] : '';
$did = isset($_GET['did']) ? $_GET['did'] : '';

// Check if the message is submitted
if(isset($_POST['message'])) {
    // Sanitize the input
    $msg = mysqli_real_escape_string($con, $_POST['message']);
    
    // Generate message ID
    $msg_id = uniqid(rand(1, 8));
    
    // Retrieve donor details
    $result0 = mysqli_query($con, "SELECT * FROM donor WHERE did='$did'");
    $row0 = mysqli_fetch_array($result0);
    
    // Check if donor details are found
    if ($row0) {
        $sender = $row0['username'];
        $username = $row0['username']; 
        $date = date('Y-m-d');
        $time = date("h:i:sa");
        $status = 0;
        
        // Insert message into the donor_messages table
        $sql_add_query = "INSERT INTO donor_messages (msg_id, did, username, sender, msg, date, time, status, pid) VALUES ('$msg_id', '$did', '$username', '$sender', '$msg', '$date', '$time', '$status', '$pid')";
        
        $result = mysqli_query($con, $sql_add_query);
        
        // Check if insertion was successful
        if ($result) {
            // Update the status of the message in the messages table to 1
            $update_query = "UPDATE messages SET status = 1 WHERE pid = '$pid'";
            mysqli_query($con, $update_query);
            
            // Redirect to conversation.php with the did and pid parameters
            header("location: conversation.php?did=$did&pid=$pid");
            exit();
        } else {
            // Handle insertion error
            echo "Error: " . mysqli_error($con);
        }
    } else {
        // Handle donor details not found
        echo "Donor details not found!";
    }
} else {
    // Handle message not submitted
    echo "Message not submitted!";
}
?>
