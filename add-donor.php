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

$result0 = mysqli_query($con,"SELECT * FROM donor WHERE did='" . $_GET['did'] . "'");
$row0= mysqli_fetch_array($result0);
$did = $row0['did'];

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
