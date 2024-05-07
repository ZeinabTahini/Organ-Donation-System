<?php
require_once "conx.php";

if(isset($_GET["did"])) {
    $did = $_GET["did"];
    $status = 1;
    
    $sql = "UPDATE wills SET status='$status' WHERE did='$did'";
    $result = mysqli_query($con, $sql);
    
    if($result) {
        // Redirect back to Donor-wills.php after updating the status
        header("Location: Donor-wills.php");
        exit();
    } else {
        echo "<script>
            alert('Failed to update status');
            window.open('Donor-wills.php','_self');
        </script>";
    }
}
?>
