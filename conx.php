<?php
     $db_hostname='localhost';
     $db_database='organ_donor';
     $db_username='root';
     $db_password='';
     
     $con = mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
     
     if(mysqli_connect_errno()){
         echo "Failed to Connect to MySQL :" . mysqli_connect_error();
     }
?>