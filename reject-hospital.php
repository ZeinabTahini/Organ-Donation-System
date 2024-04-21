<?php
session_start();
include_once 'conx.php';
$hid=$_SESSION['hid'];
$sql = "DELETE FROM hospital WHERE hid='" . $_GET["hid"] . "'";
mysqli_query($con, $sql);
	
	echo "<script>
		alert('Hospital Rejected and Saved');
		window.open('hospital-apps.php','_self');
	</script>";
	
?>
