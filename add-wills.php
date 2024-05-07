<?php
include_once 'conx.php';

$hid = $_POST['hid'];     
$did = $_POST['did'];
$donor_name = $_POST['donor_name'];
$age = $_POST['age']; 
$consent = isset($_POST['consent']) ? $_POST['consent'] : '';
$address = $_POST['address']; 
$email = $_POST['email'];
$phone = $_POST['phone']; 
// Retrieve checkbox values
$donate_organ = isset($_POST['donate']) ? implode(', ', $_POST['donate']) : ''; 
$signature = $_POST['signature'];
$id = $_FILES['id']['name'];
$idTmp = $_FILES['id']['tmp_name'];
move_uploaded_file($idTmp,"../admin/ID/".$id);

// Retrieve DID from the database
$result0 = mysqli_query($con, "SELECT * FROM donor WHERE did='$did'");
$row0 = mysqli_fetch_array($result0);
$did = $row0['did'];

$sql_add_query = "INSERT INTO wills (did, hid, donor_name, age, address, email, phone, id, donate_organ, signature, consent) 
VALUES ('$did', '$hid', '$donor_name','$age', '$address', '$email','$phone', '$id', '$donate_organ','$signature','$consent')";

$result = mysqli_query($con, $sql_add_query);

if ($result) {
    echo "<script>alert('Wills details added successfully'); window.location.href = 'saved-wills.php?did=$did';</script>";
} else {
    echo "<script>alert('Failed to add wills details'); window.location.href = 'saved-wills.php?did=$did';</script>";
}
?>
