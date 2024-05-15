<?php
include_once 'conx.php';
$result0 = mysqli_query($con,"SELECT * FROM donor WHERE did='" . $_GET['did'] . "'");
$row0= mysqli_fetch_array($result0);
$did = $row0['did'];
$result1 = mysqli_query($con, "SELECT * FROM appointment WHERE did='$did' and status='1'");
$result2 = mysqli_query($con, "SELECT * FROM messages WHERE status='0'");

        ?>

<!DOCTYPE html>
<!-- Designed by Vipul Kumar -->
<html lang="en" dir="ltr">

 <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta name="viewport" content="width=device-width, user-scalable ="no"> -->
         <title> Organ Donor | Donor-Info </title>
	  <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/images/fav.png" />
        <!---Boxicons CSS-->
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="../assets/css/donor.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"
        />
		<!-- Bootstrap core CSS-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    </head>

<body>
<div class="app">
<div class="menu-toggle">
			<div class="organ">
				<span></span>
			</div>
		</div>
		<aside class="sidebar">
			<h3>Donor</h3>
			
			<nav class="menu">
				<a href="donor-info.php?did=<?php echo $did; ?>" class="menu-item is-active"><i class="fa-solid fa-person-circle-plus"></i> Add Donor Details</a>
				<a href="message.php?did=<?php echo $did; ?>" class="menu-item">
    <i class="fa-regular fa-message"></i> Inbox Message
    <?php
        if (mysqli_num_rows($result2) > 0) {
            $newRequest = mysqli_num_rows($result2);
            echo '<span class="badge me-1" style="background-color:#07960c;color:#fff;">' . $newRequest . ' new message</span>';
        }
    ?>
</a>
<a href="wills.php?did=<?php echo $did; ?>" class="menu-item "><i class="fa-regular fa-pen-to-square"></i> Donor Wills</a>
<a href="saved-wills.php?did=<?php echo $did; ?>" class="menu-item "><i class="fa-regular fa-pen-to-square"></i> Saved Wills</a>
<a href="appointment.php?did=<?php echo $did; ?>" class="menu-item">
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

 <script>
		const menu_toggle = document.querySelector('.menu-toggle');
		const sidebar = document.querySelector('.sidebar');

		menu_toggle.addEventListener('click', () => {
			menu_toggle.classList.toggle('is-active');
			sidebar.classList.toggle('is-active');
		});
	</script>

</html>
