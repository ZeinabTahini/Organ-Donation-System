<?php
session_start();
include_once 'conx.php';
$did=$_SESSION['did'];
if(isset($_POST['msg'])){
$msg=$_POST['msg']; 


$msg_id = uniqid (rand(1,8));

$result0 = mysqli_query($con,"SELECT * FROM patient_details WHERE pid='" . $_GET['pid'] . "'");
$row0= mysqli_fetch_array($result0);
$pid = $row0['pid'];
$username = $row0['username'];
$email = $row0['email'];
$sender= "Donor";

$date= date('y-m-d');
$time = date("h:i:sa");

$status=0;

$sql_add_query = "INSERT INTO messages VALUES ('$msg_id','$pid', '$did', '$username',
'$sender','$msg','$date','$time','$status')";
$result= mysqli_query($con,$sql_add_query);
header("location:message.php?did=$did");
}
        ?>