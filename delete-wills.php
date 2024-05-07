<?php
session_start();
include_once 'conx.php';
$did=$_SESSION['did'];
$sql = "DELETE FROM wills WHERE did='" . $_GET["did"] . "'";
mysqli_query($con, $sql);

header("location:Donor-wills.php");
?>