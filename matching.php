<?php
include_once 'conx.php';
$result = mysqli_query($con,"SELECT * FROM patient_details");
$result1 = mysqli_query($con, "SELECT * FROM hospital WHERE status='0'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, user-scalable ="no"> -->
    <title> Organ Donor | Admin-Matching</title>
	  <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/images/fav.png" />
    <!---Boxicons CSS-->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../assets/css/admin.css">
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
			<h3>Admin</h3>
			
			<nav class="menu">
				<a href="Donor-Details.php" class="menu-item "><i class="fa-solid fa-hand-holding-medical"></i> Donor Details</a>
				<a href="Patient-Details.php" class="menu-item"><i class="fa-solid fa-hospital-user"></i> Patient Details</a>
				<a href="hospital-apps.php" class="menu-item ">
    <i class="fa-regular fa-bell"></i> Hospital Applications 
    <?php
    if (mysqli_num_rows($result1) > 0) {
        $newRequest = mysqli_num_rows($result1);
        echo '<span class="badge me-1" style="background-color:#07960c;color:#fff;">' . $newRequest . ' new hospital</span>';
    }
    ?>
</a>
<a href="hospital.php" class="menu-item"><i class="fa-regular fa-hospital"></i> All Saved Hospitals </a>
<a href="Organ-Donate-Process.php" class="menu-item is-active"><i class="fa-regular fa-hourglass"></i> Organ Donate Process</a>
<a href="Donated-Patient.php" class="menu-item"><i class="bx bx-heart icons"></i> Donated Patient</a>
				<a  href="Donor-wills.php" class="menu-item"><i class="fa-regular fa-pen-to-square"></i> Donor Wills</a>
				<a href="../index.php" class="menu-item">
  <i class="bx bx-log-out icons"></i> Logout
</a>
</nav>

		</aside>
        <div class="container">
		<form method="POST" enctype="multipart/form-data">
			 <h4>Matching Organ</h4>
    <table class="table table-hover responsiveTable" id="example1">
      <thead>
        <tr>
                                <th>Id</th>
                                <th>Patient Name</th>
                                <th> Age</th>
                                <th> Gender</th>
                                <th> Address </th>
                                <th> Blood Group </th>
                                <th> E-Mail </th>
                                <th> Contact No </th>
                                <th> Needed Organ </th>
                                <th> Time Required </th>
                                <th> Status </th>
                                <th> Send </th>
        </tr>
      </thead>
      <tbody>
                           <?php
// Retrieve the blood group and donate organ from the URL parameter
$bloodGroup = isset($_GET['blood_group']) ? $_GET['blood_group'] : '';
$donateOrgan = isset($_GET['donate_organ']) ? $_GET['donate_organ'] : '';

// Build the SQL query with the blood group and donate organ filters if they're provided
$sql = "SELECT * FROM patient_details WHERE status = '0'";

// Add conditions for blood group and donate organ if they're provided
if (!empty($bloodGroup)) {
    $sql .= " AND blood_group = '$bloodGroup'";
}

if (!empty($donateOrgan)) {
    $sql .= " AND needed_organ = '$donateOrgan'";
}

$result = mysqli_query($con, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Display the results
    while ($row = mysqli_fetch_array($result)) {
        // Display the patient information
?>

                                    <tr>
                                        <td> <?php echo $row['pid']; ?> </td>
                                        <td><?php echo $row['patient_name']; ?></td>
                                        <td> <?php echo $row['age']; ?> </td>
                                        <td> <?php echo $row['gender']; ?> </td>
                                        <td> <?php echo $row['address']; ?> </td>
                                        <td> <?php echo $row['blood_group']; ?> </td>
                                        <td> <?php echo $row['email']; ?> </td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td> <?php echo $row['needed_organ']; ?> </td>
                                        <td> <?php echo $row['timeRequired']; ?> </td>
                                        <td>
                                            <?php
                                            $statusClass = '';
                                            switch ($row['status']) {
                                                case 0:
                                                    $status = 'Pending';
                                                    $statusClass = 'pending';
                                                    break;
                                                case 1:
                                                    $status = 'Completed';
                                                    $statusClass = 'completed';
                                                    break;
                                                default:
                                                    $status = $row['status'];
                                            }
                                            ?>
                                            <p class="status <?php echo $statusClass; ?>"><?php echo $status; ?></p>
                                        </td>
                                        <td>
										<a href="send.php?pid=<?php echo $row['pid']; ?>&did=<?php echo $_GET['did']; ?>" onclick="openMatchingDonor(event, '<?php echo $row['pid']; ?>')" style="color: #07960c; text-decoration: none;">
    <i class="fa-solid fa-share"></i>
</a>

                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="13">NO MATCHING RESULTS FOUND</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
					</form>
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
        let headers1 = ['Id', 'Patient Name', 'Age', 'Gender', 'Address', 'Blood Group', 'E-Mail', 'Contact No', 'Needed Organ', 'Time Required', 'Status', 'Send'];
        toResponsive('example1', headers1, headerStyle);
    })();
</script>
</html>
