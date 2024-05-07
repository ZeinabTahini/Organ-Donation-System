<?php
require_once "conx.php";

if(isset($_GET["did"])) {
    $did = $_GET["did"];
    
    // Update age
    if(isset($_POST['age']) && !empty($_POST['age'])) {
        $age = $_POST['age'];
        $sql = "UPDATE wills SET age='$age' WHERE did='$did'";
        $result = mysqli_query($con, $sql); 
    }

    // Update donor name
    if(isset($_POST['donor_name']) && !empty($_POST['donor_name'])) {
        $donor_name = $_POST['donor_name'];
        $sql = "UPDATE wills SET donor_name='$donor_name' WHERE did='$did'";
        $result = mysqli_query($con, $sql); 
    }
    
    // Update email
    if(isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $_POST['email'];
        $sql = "UPDATE wills SET email='$email' WHERE did='$did'";
        $result = mysqli_query($con, $sql); 
    }
    
    // Update phone
    if(isset($_POST['phone']) && !empty($_POST['phone'])) {
        $phone = $_POST['phone'];
        $sql = "UPDATE wills SET phone='$phone' WHERE did='$did'";
        $result = mysqli_query($con, $sql); 
    }

    // Update donate_organ
    if(isset($_POST['donate'])) {
        // Convert array to comma-separated string
        $donate_organ = implode(",", $_POST['donate']);
        $sql = "UPDATE wills SET donate_organ='$donate_organ' WHERE did='$did'";
        $result = mysqli_query($con, $sql); 
    }
    
    // Update address
    if(isset($_POST['address']) && !empty($_POST['address'])) {
        $address = $_POST['address'];
        $sql = "UPDATE wills SET address='$address' WHERE did='$did'";
        $result = mysqli_query($con, $sql); 
    }

    // Update hospital
    if(isset($_POST['hid']) && !empty($_POST['hid'])) {
        $hid = $_POST['hid'];
        $sql = "UPDATE wills SET hid='$hid' WHERE did='$did'";
        $result = mysqli_query($con, $sql); 
    }

    // Update signature
    if(isset($_POST['signature']) && !empty($_POST['signature'])) {
        $signature = $_POST['signature'];
        $sql = "UPDATE wills SET signature='$signature' WHERE did='$did'";
        $result = mysqli_query($con, $sql); 
    }

    // Update consent
    if(isset($_POST['consent']) && !empty($_POST['consent'])) {
        $consent = $_POST['consent'];
        $sql = "UPDATE wills SET consent='$consent' WHERE did='$did'";
        $result = mysqli_query($con, $sql); 
    }
    
    echo "<script>
            alert('Wills Updated');
            window.open('saved-wills.php?did=$did','_self');
          </script>";
} else {
    echo "<script>
            alert('Wills Not Updated');
            window.open('saved-wills.php?did=$did','_self');
          </script>"; 
}
?>
