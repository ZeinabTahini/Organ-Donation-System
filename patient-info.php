
<?php
include_once 'conx.php';

// Retrieve the pid from the URL parameter
$pid = isset($_GET['pid']) ? $_GET['pid'] : '';

$sql0 = "SELECT * FROM patient WHERE pid='$pid'";
$result0 = mysqli_query($con, $sql0);
$row0 = mysqli_fetch_array($result0);
$result = mysqli_query($con, "SELECT * FROM send WHERE pid='$pid' and status='0'");
$result1 = mysqli_query($con, "SELECT * FROM appointment WHERE pid='$pid' and status='1'");
$result2 = mysqli_query($con, "SELECT * FROM donor_messages WHERE status='0'");

?>

<!DOCTYPE html>
<!-- Designed by Vipul Kumar -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="../assets/css/patient.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <title> Organ Donor | Patient-Info </title>
	  <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/images/fav.png" />
	
    
</head>
<body>
	 <div class="app">
		<div class="menu-toggle">
			<div class="organ">
				<span></span>
			</div>
		</div>
		<aside class="sidebar">
			<h3>Patient</h3>
			
			<nav class="menu">
				<a href="patient-info.php?pid=<?php echo $pid; ?>" class="menu-item is-active"><i class="fa-solid fa-person-circle-plus"></i> Add Patient Details</a>
				<a href="matching-donor.php?pid=<?php echo $pid; ?>" class="menu-item">
				<i class='fa-solid fa-equals'></i> Matching Donor
    <?php
        if (mysqli_num_rows($result) > 0) {
            $newRequest = mysqli_num_rows($result);
            echo "<span class='badge me-1' style='background-color:#07960c;color:#fff'>" . $newRequest . " new donor</span>";
        }
    ?>
    
</a>
				<a href="message.php?pid=<?php echo $pid; ?>" class="menu-item">
    <i class="fa-regular fa-message"></i> Inbox Message
    <?php
        if (mysqli_num_rows($result2) > 0) {
            $newRequest = mysqli_num_rows($result2);
            echo '<span class="badge me-1" style="background-color:#07960c;color:#fff;">' . $newRequest . ' new message</span>';
        }
    ?>
</a>
<a href="appointment.php?pid=<?php echo $pid; ?>" class="menu-item">
    <i class="fa-regular fa-calendar-check"></i> Appointment Date
    <?php
    if (mysqli_num_rows($result1) > 0) {
        $newRequest = mysqli_num_rows($result1);
    ?>
        <span class="badge me-1" style="background-color:#07960c;color:#fff">
            <?php echo $newRequest; ?> new appointment
        </span>
    <?php
    }
    ?>
</a>
				<a href="../index.php" class="menu-item">
  <i class="bx bx-log-out icons"></i> Logout
</a>
			</nav>

		</aside>

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

	<script>
		const menu_toggle = document.querySelector('.menu-toggle');
		const sidebar = document.querySelector('.sidebar');

		menu_toggle.addEventListener('click', () => {
			menu_toggle.classList.toggle('is-active');
			sidebar.classList.toggle('is-active');
		});
	</script>
</body>
</html>