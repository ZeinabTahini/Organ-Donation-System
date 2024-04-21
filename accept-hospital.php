<?php
require_once "conx.php";
if(isset($_GET["hid"]))
{
	$hid=$_GET["hid"];
	$status = 1;
	
	$sql = "UPDATE hospital SET status='$status' WHERE hid='$hid'";

    $result= mysqli_query($con,$sql);
   
     
	
	echo "<script>
		alert('Hospital Accepted and Saved');
		window.open('hospital.php','_self');
	</script>";
	
}
?>