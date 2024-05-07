<?php
include_once 'conx.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file upload is successful
    if(isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
        $username = $_POST['username'];
        $email = $_POST['email']; 
        $password = $_POST['password'];
        $hospital = $_POST['hid'];
		$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $cv = $_FILES['cv']['name'];
        $cvTmp = $_FILES['cv']['tmp_name'];
        move_uploaded_file($cvTmp,"../admin/CV/".$cv);

        $stts = 0;

        // Insert data into database
        $sql_add_query = "INSERT INTO doctor (username, email, password, hospital, cv, status) 
                          VALUES ('$username', '$email', '$hashedPassword', '$hospital', '$cv', $stts)";

        $result = mysqli_query($con, $sql_add_query);

        if ($result) {
            header("location:../doctor/registration-alert.php");
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
