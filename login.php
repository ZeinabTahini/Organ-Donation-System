<?php
session_start();
require_once 'conx.php';

if (isset($_POST['email']) && isset($_POST['password'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $query="select * from add_donor where email='".$email."' AND password='".$password."'";
    
    $result= mysqli_query($con,$query);
    
    if(mysqli_num_rows($result)===1){
       $_SESSION['is_logged_in']=1;
        $email=$_POST['email'];
        $row= mysqli_fetch_array($result);
        $did = $row['did'];
        header("location:donor-info.php?did=$did");
        echo '<script>alert("Welcome to DonateHope!")</script>';
    }
    else{
        $_SESSION['is_logged_in']=0;
        header("location:login-error-alert.php") ;
        echo '<script>alert("You Are Not Logged in.")</script>';
    }
}
    else{
         echo '<script>alert("You Are Not Logged in.")</script>';
        header("location:login-error-alert.php");
    }
?>