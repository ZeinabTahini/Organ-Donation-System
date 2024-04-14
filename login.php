<?php
session_start();
require_once 'conx.php';

if (isset($_POST['email']) && isset($_POST['password'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $query="select * from admin where email='".$email."' AND password='".$password."'";
    
    $result= mysqli_query($con,$query);
    
    if(mysqli_num_rows($result)===1){
       $_SESSION['is_logged_in']=1;
        $email=$_POST['email'];
        header("location:hospital-apps.php");
    }
    else{
        $_SESSION['is_logged_in']=0;
        header("location:login-error-alert.php") ;
}
}
    else{
        header("location:login-error-alert.php");
    }


 
?>