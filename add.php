<?php
include_once 'conx.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file upload is successful
    if(isset($_FILES['info']) && $_FILES['info']['error'] === UPLOAD_ERR_OK) {
        $username = $_POST['username'];
        $email = $_POST['email']; 
        $password = $_POST['password'];
		$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $info = $_FILES['info']['name'];
        $infoTmp = $_FILES['info']['tmp_name'];
        move_uploaded_file($infoTmp,"../admin/Info/".$info);

        $stts = 0;

        // Insert data into database
        $sql_add_query = "INSERT INTO hospital (username, email, password, info, status) 
                          VALUES ('$username', '$email', '$hashedPassword', '$info', $stts)";

        $result = mysqli_query($con, $sql_add_query);

        if ($result) {
            header("location:../hospital/registration-alert.php");
            exit(); // exit script after redirection
        } else {
            $error_message = "Error: " . $sql_add_query . "<br>" . mysqli_error($con);
            error_log($error_message); // Log the error message
            echo $error_message; // Output the error message for debugging purposes
        }
    } else {
        // File upload failed or info index not found
        echo "File upload failed or info index not found!";
        exit;
    }
} else {
    echo "Invalid request method!";
}
?>
