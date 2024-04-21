<?php
include_once 'conx.php';
$result0 = mysqli_query($con,"SELECT * FROM donor WHERE did='" . $_GET['did'] . "'");
$row0= mysqli_fetch_array($result0);
$did = $row0['did'];

        ?>

<!DOCTYPE html>
<!-- Designed by Vipul Kumar -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
      
	 <title> Organ Donor | Donor-Info </title>
	  <!-- Favicon -->
  
	
    
</head>

<body>
<div class="container">
            <div class="sidebar">
                <div class="header">
                    <i class="bx bx-menu icon"></i>
                    <span class="title">Donor</span>
                </div>
                <div class="menu-bar">
                    <div class="menu">
                        <li class="menu-link">
                            <a href="donor-info.php?did=<?php echo $did; ?>" class="active">
                                <i class="fa-solid fa-person-circle-plus"></i>
                                <span class="text">Add Donor Details</span>
                            </a>
                        </li>
					
						</div>
                    <div class="bottom-menu">
                        <li class="menu-link">
                            <a href="../index.php">
                                <i class="bx bx-log-out icons"></i>
                                <span class="text">logout</span>
                            </a>
                    </div>

                </div>

            </div>
			
    <div class="container1">
    <div class="title">Add Donor Details</div>
    <div class="content">
        <form action="add-donor.php?did=<?php echo $did; ?>" method="POST" enctype="multipart/form-data">
            <div class="user-details">
                                   <input type="hidden" name="did" value="<?php echo isset($_GET['did']) ? $_GET['did'] : ''; ?>">

                    <div class="input-box">
                        <span class="details">Donor Name</span>
                        <input type="text" name="donor_name" placeholder="Enter your name" required>
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
                        <span class="details">Donate Organ</span>
                        <select name="donate_organ" class="styled-select">
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
                    <span class="details">Causes of Death</span>
                    <input type="text" name="causesofDeath" placeholder="Enter causes of death" required>
                </div>
                <div class="input-box">
                    <span class="details">Hospital</span>
                    <select name="hid" class="styled-select">
                        <?php
                        $result = mysqli_query($con,"SELECT * FROM hospital");
                        while($row = mysqli_fetch_array($result)){
                        ?>
                        <option value="<?php echo $row['hid'] ?>"><?php echo $row['username'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-box gender-box" style="position: relative; top: 4px;">
    <span class="details">Gender</span>
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
