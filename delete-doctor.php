<?php
session_start();
include_once 'conx.php';
$id=$_SESSION['id'];
$sql = "DELETE FROM doctor WHERE id='" . $_GET["id"] . "'";
mysqli_query($con, $sql);

header("location:doctors.php");
?>