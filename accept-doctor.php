<?php
require_once "conx.php";
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$status = 1;
	
	$sql = "UPDATE doctor SET status='$status' WHERE id='$id'";

    $result= mysqli_query($con,$sql);
   
     
	
	echo "<script>
		alert('Doctor Accepted and Saved');
		window.open('doctors.php','_self');
	</script>";
	
}
?>