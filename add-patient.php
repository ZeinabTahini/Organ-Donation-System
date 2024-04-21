<?php
include_once 'conx.php';

$pid = $_POST['pid'];
$patient_name = $_POST['patient_name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$blood_group = $_POST['blood_group'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$needed_organ = $_POST['needed_organ'];
$timeRequired = $_POST['timeRequired'];
$status = 0;

$currentDateTimestamp = time();
$timeRequiredTimestamp = strtotime($timeRequired);

if ($timeRequiredTimestamp < $currentDateTimestamp) {
    // Time required is before current date
    echo "<script>alert('Please select a future date for time required.'); history.back();</script>";
    exit; // Stop further execution
}

$sql_add_query = "INSERT INTO patient_details (pid, patient_name, age, gender, address, blood_group, email, phone, needed_organ, timeRequired, status)
VALUES ('$pid','$patient_name','$age','$gender','$address', '$blood_group', '$email','$phone','$needed_organ','$timeRequired','$status')";

$result = mysqli_query($con, $sql_add_query);

if ($result) {
    echo "<script>alert('Patient details added successfully'); window.location.href = 'patient-info.php?pid=$pid';</script>";
} else {
    echo "<script>alert('Failed to add patient details'); window.location.href = 'patient-info.php?pid=$pid';</script>";
}
?>
