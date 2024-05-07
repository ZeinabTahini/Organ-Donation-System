<?php
session_start();
require_once 'conx.php';

if (isset($_POST['email']) && isset($_POST['password'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    // Fetch user data from the database
    $query="SELECT * FROM doctor WHERE email='".$email."' AND status=1";
    $result= mysqli_query($con,$query);
    
    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_array($result);
        $hashedPassword = $row['password'];
        
        // Verify the hashed password
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['is_logged_in'] = 1;
            $_SESSION['id'] = $row['id'];
            header("location: appointment.php");
            echo '<script>alert("Welcome to Organ Donor!")</script>';
            exit(); // Exit after redirection
        } else {
            // Incorrect password
            $_SESSION['is_logged_in'] = 0;
            header("location: login-error-alert.php");
            echo '<script>alert("Incorrect email or password.")</script>';
            exit(); // Exit after redirection
        }
    } else {
        // User not found in the database or status is not 1
        $_SESSION['is_logged_in'] = 0;
        header("location: login-error-alert.php");
        echo '<script>alert("Incorrect email or password.")</script>';
        exit(); // Exit after redirection
    }
} else {
    // Redirect if email or password not provided
    header("location: login-error-alert.php");
    exit(); // Exit after redirection
}
?>
