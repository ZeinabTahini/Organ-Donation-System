<?php
include_once 'conx.php';

$hid = $_POST['hid'];     
$did = $_POST['did'];
$donor_name = $_POST['donor_name'];
$age = $_POST['age']; 
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$address = $_POST['address']; 
$blood_group = $_POST['blood_group']; 
$email = $_POST['email'];
$phone = $_POST['phone']; 
$donate_organ = $_POST['donate_organ']; 
$causesofDeath = $_POST['causesofDeath'];

// Check if the did already exists in the database
$sql_check_did = "SELECT * FROM donor_details WHERE did='$did'";
$result_check_did = mysqli_query($con, $sql_check_did);
if (mysqli_num_rows($result_check_did) > 0) {
    echo "<script>alert('Donor with the same ID already exists.'); window.location.href = 'donor-info.php?did=$did';</script>";
    exit; // Stop further execution
}

$status = 0;

$sql_add_query = "INSERT INTO donor_details (did, hid, donor_name, age, gender, address, blood_group, email, phone, donate_organ, causesofDeath, status) 
VALUES ('$did', '$hid', '$donor_name','$age','$gender','$address', '$blood_group', '$email','$phone','$donate_organ','$causesofDeath','$status')";

$result = mysqli_query($con, $sql_add_query);

if ($result) {
    echo "<script>alert('Donor details added successfully'); window.location.href = 'donor-info.php?did=$did';</script>";
} else {
    echo "<script>alert('Failed to add donor details'); window.location.href = 'donor-info.php?did=$did';</script>";
}
?>
