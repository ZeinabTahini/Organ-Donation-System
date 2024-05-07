<?php
session_start();
include_once 'conx.php';
$pid=$_SESSION['pid'];
$sql = "DELETE FROM appointment WHERE pid='" . $_GET["pid"] . "'";
mysqli_query($con, $sql);

header("location:appointment.php");
?>