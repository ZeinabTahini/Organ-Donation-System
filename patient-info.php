<?php
include_once 'conx.php';

// Retrieve the pid from the URL parameter
$pid = isset($_GET['pid']) ? $_GET['pid'] : '';

$sql0 = "SELECT * FROM patient WHERE pid='$pid'";
$result0 = mysqli_query($con, $sql0);
$row0 = mysqli_fetch_array($result0);

?>

<!DOCTYPE html>
<!-- Designed by Vipul Kumar -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
     <title> Organ Donor | Patient-Info</title>
	  <!-- Favicon -->
    

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<div class="container">
    <div class="sidebar">
        <div class="header">
            <i class="bx bx-menu icon"></i>
            <span class="title">Patient</span>
        </div>
        <div class="menu-bar">
            <div class="menu">
                <li class="menu-link">
                    <a href="patient-info.php?pid=<?php echo $pid; ?>" class="active">
                      <i class="fa-solid fa-person-circle-plus"></i>
                        <span class="text">Add Patient Details</span>
                    </a>
                </li>
                
            </div>
            <div class="bottom-menu">
                <li class="menu-link">
                    <a href="../index.php">
                        <i class="bx bx-log-out icons"></i>
                        <span class="text">logout</span>
                    </a>
                </li>
            </div>
        </div>
    </div>
    <div class="container1">
        <div class="title">Add Patient Details</div>
        <div class="content">
            <form action="add-patient.php" method="POST" enctype="multipart/form-data">
                <div class="user-details">
                    <input type="hidden" name="pid" value="<?php echo isset($_GET['pid']) ? $_GET['pid'] : ''; ?>">
                    <div class="input-box">
                        <span class="details">Patient Name</span>
                        <input type="text" name="patient_name" placeholder="Enter your name" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Age</span>
                        <input type="text" name="age" placeholder="Enter your age" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Address</span>
                        <input type="text" name="address" placeholder="Enter your address" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Blood Group</span>
                        <select name="blood_group" class="styled-select">
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input type="text" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Contact Number</span>
                        <input type="text" name="phone" placeholder="Enter your phone" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Needed Organ</span>
                        <select name="needed_organ" class="styled-select">
                            <option value="Heart">Heart</option>
                            <option value="Kidney">Kidney</option>
                            <option value="Liver">Liver</option>
                            <option value="Lung">Lung</option>
                            <option value="Pancreas">Pancreas</option>
                            <option value="Small intestine">Small intestine</option>
                            <option value="Stomach">Stomach</option>
                            <option value="Tissue">Tissue</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Time Required</span>
                        <input type="date" name="timeRequired" required>
                    </div>
                </div>
                <div class="gender-details">
                    <span class="gender-title">Gender</span>
                    <div class="category">
                        <label>
                            <input type="radio" name="gender" value="Male">
                            <span class="dot"></span>
                            <span class="gender">Male</span>
                        </label>
                        <label>
                            <input type="radio" name="gender" value="Female">
                            <span class="dot"></span>
                            <span class="gender">Female</span>
                        </label>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" name="signup" value="Submit">
                </div>
            </form>
        </div>

        
    </div>
</div>


</body>
</html>
