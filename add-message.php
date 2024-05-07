<?php
include_once 'conx.php';

// Retrieve the did and pid from the URL parameters
$did = isset($_GET['did']) ? $_GET['did'] : '';

// Debugging output
echo "Did parameter: $did <br>";

// Check if the message is submitted
if(isset($_POST['message'])) {
    // Sanitize the input
    $msg = mysqli_real_escape_string($con, $_POST['message']);
    
    // Generate message ID
    $msg_id = uniqid(rand(1, 8));
    
    // Retrieve patient details
    $pid = isset($_GET['pid']) ? $_GET['pid'] : '';
    $result0 = mysqli_query($con, "SELECT * FROM patient WHERE pid='$pid'");
    $row0 = mysqli_fetch_array($result0);
    
    // Check if patient details are found
    if ($row0) {
        $sender = $row0['username'];
        $username = $row0['username']; 
        $date = date('Y-m-d');
        $time = date("h:i:sa");
        $status = 0;
        
        // Insert message into the database with did
        $sql_add_query = "INSERT INTO messages (msg_id, pid, username, sender, msg, date, time, status, did) VALUES ('$msg_id', '$pid', '$username', '$sender', '$msg', '$date', '$time', '$status', '$did')";
        
        // Debugging output
        echo "SQL Query: $sql_add_query <br>";
        
        $result = mysqli_query($con, $sql_add_query);
        
        // Check if insertion was successful
        if ($result) {
            // Update the status of the message in the donor_messages table to 1
            $update_query = "UPDATE donor_messages SET status = 1 WHERE pid = '$pid'";
            mysqli_query($con, $update_query);
            
            // Redirect to conversation.php with the pid and did parameters
            header("location: conversation.php?pid=$pid&did=$did");
            exit(); // Ensure script stops execution after redirection
        } else {
            // Handle insertion error
            echo "Error: " . mysqli_error($con);
        }
    } else {
        // Handle patient details not found
        echo "Patient details not found!";
    }
} else {
    // Handle message not submitted
    echo "Message not submitted!";
}
?>
