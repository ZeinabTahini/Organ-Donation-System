<?php
session_start();
include_once 'conx.php';
$hid=$_SESSION['hid'];
$sql = "DELETE FROM add_hospital WHERE hid='" . $_GET["hid"] . "'";
mysqli_query($con, $sql);

header("location:hospital.php");
?>