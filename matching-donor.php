<?php
include_once 'conx.php';

// Retrieve the pid from the URL parameter
$pid = isset($_GET['pid']) ? $_GET['pid'] : '';

$sql0 = "SELECT * FROM patient_details WHERE pid='$pid'";
$result0 = mysqli_query($con, $sql0);
$row0 = mysqli_fetch_array($result0);

// Query to retrieve donor details for the provided patient ID
$result = mysqli_query($con, "SELECT * FROM send WHERE pid='$pid' AND status = '0'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Organ Donor | Patient-Matching</title>
	  <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/images/fav.png" />
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../assets/css/patient.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
			<h3>Patient</h3>
			
			<nav class="menu">
				<a href="patient-info.php?pid=<?php echo $pid; ?>" class="menu-item "><i class="fa-solid fa-person-circle-plus"></i> Add Patient Details</a>
				<a href="matching-donor.php?pid=<?php echo $pid; ?>" class="menu-item is-active"><i class="fa-solid fa-equals"></i> Matching Donor</a>
				<a href="../index.php" class="menu-item">
  <i class="bx bx-log-out icons"></i> Logout
</a>
			</nav>

		</aside>
        <div class="container">
    <h4>Matching Donor</h4> 
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            // Retrieve the donor ID for each donor record
            $did = $row['did'];
            // Query to get donor details based on the donor ID
            $result1 = mysqli_query($con, "SELECT * FROM send WHERE did='$did'");
            if ($row1 = mysqli_fetch_array($result1)) {
    ?>
    <tr>
    <table class="table table-hover responsiveTable" id="example1">
        <thead>
            <tr>
                <th>Donor Name</th>
                <th>Hospital Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Blood Group</th>
                <th>E-Mail</th>
                <th>Contact No</th>
                <th>Donate Organ</th>
                <th>Causes of Death</th>
                <th>Accept Donor</th>
                <th>Reject Donor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $row1['donor_name']; ?></td>
                <td><?php echo $row1['hospital_name']; ?></td>
                <td><?php echo $row1['age']; ?></td>
                <td><?php echo $row1['gender']; ?></td>
                <td><?php echo $row1['address']; ?></td>
                <td><?php echo $row1['blood_group']; ?></td>
                <td><?php echo $row1['email']; ?></td>
                <td><?php echo $row1['phone']; ?></td>
                <td><?php echo $row1['donate_organ']; ?></td>
                <td><?php echo $row1['causesofDeath']; ?></td>
                <td><a href="accept-donor.php?did=<?php echo $row['did']; ?>&pid=<?php echo $row['pid']; ?>" class="btn btn-primary opacity-transition" style="background-color: #07960c; border-color: #07960c; width: 90px;">Accept</a></td>
<td><a href="reject-donor.php?did=<?php echo $row['did']; ?>&pid=<?php echo $row['pid']; ?>" class="btn btn-primary opacity-transition" style="background-color: #07960c; border-color: #07960c; width: 90px;">Reject</a></td>

            </tr>
        </tbody>
    </table>
    <?php
        }
    } 
    } else {
    ?>
    <tr>
        <td colspan="13">NO DONOR DETAILS!</td>
    </tr>
    <?php
    }
    ?>
</div>

        </div>
    </body>
   <!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="../assets/js/admin.js"></script> 
<script type="text/javascript">
    // Toggle menu functionality
    const menu_toggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');

    menu_toggle.addEventListener('click', () => {
        menu_toggle.classList.toggle('is-active');
        sidebar.classList.toggle('is-active');
    });

    (() => {
        // to match styling of the table when full screen
        let headerStyle = 'font-weight: 700; background-color: #ededed; color: #212529';

        // basic table
        let headers1 = ['Donor Name', 'Hospital Name', 'Age', 'Gender', 'Address', 'Blood Group', 'E-Mail', 'Contact No', 'Donate Organ', 'Causes of Death', 'Accept Donor', 'Reject Donor'];
        toResponsive('example1', headers1, headerStyle);
    })();
</script>
    </html>