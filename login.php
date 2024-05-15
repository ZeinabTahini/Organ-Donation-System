<?php
session_start();
require_once 'conx.php';

if (isset($_POST['email']) && isset($_POST['password'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    // Fetch user data from the database
    $query="select * from patient where email='".$email."'";
    $result= mysqli_query($con,$query);
    
    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_array($result);
        $hashedPassword = $row['password'];
        // Verify the hashed password
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['is_logged_in'] = 1;
            $pid = $row['pid'];
            header("location:patient-info.php?pid=$pid");
            echo '<script>alert("Welcome to DonateHope!")</script>';
            exit(); // Exit after redirection
        } else {
            // Incorrect password
            $_SESSION['is_logged_in'] = 0;
            header("location:login-error-alert.php");
            echo '<script>alert("Incorrect email or password.")</script>';
            exit(); // Exit after redirection
        }
    } else {
        // User not found in the database
        $_SESSION['is_logged_in'] = 0;
        header("location:login-error-alert.php");
        echo '<script>alert("Incorrect email or password.")</script>';
        exit(); // Exit after redirection
    }
} else {
    // Redirect if email or password not provided
    header("location:login-error-alert.php");
    exit(); // Exit after redirection
}
?>
