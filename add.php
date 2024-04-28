<?php
include_once 'conx.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email']; 
    $password = $_POST['password'];
	$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $sql_add_query = "INSERT INTO donor (username, email, password) 
                      VALUES ('$username','$email','$hashedPassword')";

    $result = mysqli_query($con, $sql_add_query);

    if ($result) {
        header("location:../donor/registration-alert.php");
        exit(); // exit script after redirection
    } else {
        $error_message = "Error: " . $sql_add_query . "<br>" . mysqli_error($con);
        error_log($error_message); // Log the error message
        echo $error_message; // Output the error message for debugging purposes
    }
} else {
    echo "Invalid request method!";
}
?>
