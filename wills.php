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
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta name="viewport" content="width=device-width, user-scalable ="no"> -->
         <title> Organ Donor | Donor-Wills </title>
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
				<a href="donor-info.php?did=<?php echo $did; ?>" class="menu-item"><i class="fa-solid fa-person-circle-plus"></i> Add Donor Details</a>
<a href="wills.php?did=<?php echo $did; ?>" class="menu-item is-active"><i class="fa-regular fa-pen-to-square"></i> Donor Wills</a>
<a href="saved-wills.php?did=<?php echo $did; ?>" class="menu-item"><i class="fa-regular fa-pen-to-square"></i> Saved Wills</a>

				<a href="../index.php" class="menu-item">
  <i class="bx bx-log-out icons"></i> Logout
</a>
			</nav>

		</aside>
    <div class="container1">
    <div class="title">Add Donor Wills</div>
    <div class="content">
        <form action="add-wills.php?did=<?php echo $did; ?>" method="POST" enctype="multipart/form-data">
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
                        <span class="details">Email</span>
                        <input type="text" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Contact Number</span>
                        <input type="text" name="phone" placeholder="Enter your phone" required>
                    </div>
					<div class="input-box">
    <span class="details">ID</span>
    <input type="file" name="id" id="id" required style="border: 1px solid #ccc; padding: 10px; border-radius: 4px; background-color: #f8f8f8;">
</div>
                    <div class="input-box gender-box" style="position: relative; top: 4px;">
    <span class="details">Donate Organ</span>
    <div class="category">
        <div>
            <label>
                <input type="checkbox" name="donate[]" value="heart">
                <span class="checkmark"></span>
                <span class="gender">Heart</span>
            </label>
            <label>
                <input type="checkbox" name="donate[]" value="pancreas">
                <span class="checkmark"></span>
                <span class="gender">Pancreas</span>
            </label>
        </div>
        <div>
            <label>
                <input type="checkbox" name="donate[]" value="lung">
                <span class="checkmark"></span>
                <span class="gender">Lung</span>
            </label>
            <label>
                <input type="checkbox" name="donate[]" value="kidney">
                <span class="checkmark"></span>
                <span class="gender">Kidney</span>
            </label>
        </div>
    </div>
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
				<div class="input-box">
                    <span class="details">Signature</span>
                    <input type="text" name="signature" placeholder="Enter the signature" required>
                </div>
                  <div class="input-box gender-box" style="position: relative; top: 4px;">
    <span class="details">Organ Donation Consent</span>
    <div class="category">
        <label>
            <input type="radio" name="consent" value="Yes">
            <span class="dot"></span>
            <span class="gender">Yes</span>
        </label>
        <label>
            <input type="radio" name="consent" value="No">
            <span class="dot"></span>
            <span class="gender">No</span>
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
