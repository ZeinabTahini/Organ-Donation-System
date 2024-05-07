<?php
session_start();
include_once 'conx.php';

if(isset($_POST['pid']) && isset($_POST['did'])) {
    $pid = $_POST['pid'];
    $did = $_POST['did'];

    // Fetch other details from the database, including hospital_name
  // Fetch other details from the database, including hospital_name and hid
$sql_fetch_details = "SELECT d.*, ah.username AS hospital_name, ah.hid 
                        FROM donor_details d 
                        INNER JOIN hospital ah ON d.hid = ah.hid
                        WHERE d.did = '$did'";

    $result_fetch_details = mysqli_query($con, $sql_fetch_details);

    if ($result_fetch_details && mysqli_num_rows($result_fetch_details) > 0) {
        $row = mysqli_fetch_assoc($result_fetch_details);

        // Extract details from $row
        $donor_name = $row['donor_name'];
        $hospital_name = $row['hospital_name']; // Fetching hospital_name from the query
        $age = $row['age'];
        $gender = $row['gender'];
        $address = $row['address'];
        $blood_group = $row['blood_group'];
        $email = $row['email'];
        $phone = $row['phone'];
        $donate_organ = $row['donate_organ'];
        $causesofDeath = $row['causesofDeath'];

        // Perform the insertion into send table
       $sql_add_query = "INSERT INTO send (pid, did, donor_name, hospital_name, hid, age, gender, address, blood_group, email, phone, donate_organ, causesofDeath, status) 
                    VALUES ('$pid','$did','$donor_name', '$hospital_name', '{$row['hid']}','$age','$gender','$address','$blood_group','$email','$phone','$donate_organ','$causesofDeath', 0)";

        $result = mysqli_query($con, $sql_add_query);

        // Update the status in donor table
        $status = 1;
        $sql_update_query = "UPDATE donor_details SET status='$status' WHERE did='$did'";
        $result_update = mysqli_query($con, $sql_update_query);

        // Redirect to donor details page
        if ($result && $result_update) {
            header("location:Donor-Details.php");
            exit(); // Ensure script termination after redirection
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Error: Unable to fetch donor details.";
    }
}
?>
