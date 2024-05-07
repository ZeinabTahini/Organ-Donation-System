<?php
include_once 'conx.php';

// Retrieve the pid and did from the URL parameter
$pid = isset($_GET['pid']) ? $_GET['pid'] : '';

$sql0 = "SELECT * FROM patient WHERE pid='$pid'";
$result0 = mysqli_query($con, $sql0);
$row0 = mysqli_fetch_array($result0);
$result1 = mysqli_query($con, "SELECT * FROM hospital WHERE status='0'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Organ Donor | Admin-Send</title>
	  <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/images/fav.png" />
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../assets/css/admin.css">
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
<a href="Organ-Donate-Process.php" class="menu-item "><i class="fa-regular fa-hourglass"></i> Organ Donate Process</a>
<a href="Donated-Patient.php" class="menu-item"><i class="bx bx-heart icons"></i> Donated Patient</a>
				<a  href="Donor-wills.php" class="menu-item"><i class="fa-regular fa-pen-to-square"></i> Donor Wills</a>

				<a href="../index.php" class="menu-item">
  <i class="bx bx-log-out icons"></i> Logout
</a>
			</nav>

		</aside>
        <div class="container">
		<form action="send-add.php" method="POST" enctype="multipart/form-data">
			 <h4>Donor Details </h4>
    <table class="table table-hover responsiveTable" id="example1">
      <thead>
        <tr>
          <th>Id</th>
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
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
                                <?php
                                // Retrieve the did from the URL parameter
                                $did = isset($_GET['did']) ? $_GET['did'] : '';

                                // Build the SQL query with the did filter if it's provided
                               $sql = "SELECT d.*, ah.hid, ah.username AS hospital_username 
        FROM donor_details d 
        INNER JOIN hospital ah ON d.hid = ah.hid
        WHERE d.did = '$did'";


                                $result = mysqli_query($con, $sql);

                                // Check if there are any results
                                if (mysqli_num_rows($result) > 0) {
                                    // Display the results
                                    while ($row = mysqli_fetch_array($result)) {
                                ?>
                                        <tr>
                                        <td> <?php echo $row['did']; ?> </td>
                                        <td><?php echo $row['donor_name']; ?></td>
                                        <td><?php echo $row['hospital_username']; ?></td>
                                        <td> <?php echo $row['age']; ?> </td>
                                        <td> <?php echo $row['gender']; ?> </td>
                                        <td> <?php echo $row['address']; ?> </td>
                                        <td> <?php echo $row['blood_group']; ?> </td>
                                        <td> <?php echo $row['email']; ?> </td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td> <?php echo $row['donate_organ']; ?> </td>
                                        <td> <?php echo $row['causesofDeath']; ?> </td>
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
                                    </tr>
                            <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="13">No results found for the selected donor ID.</td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    <div>
                        <!-- Hidden fields to pass pid and did -->
                        <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                        <input type="hidden" name="did" value="<?php echo $did; ?>">
                       <div style="text-align: center;">
    <button type="submit" class="btn btn-primary opacity-transition" style="background-color: #07960c; border-color: #07960c; width: 90px; margin-bottom: 15px;">Send</button>
</div>





                    </div>
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
        let headers1 = ['Id', 'Donor Name', 'Hospital Name', 'Age', 'Gender', 'Address', 'Blood Group', 'E-Mail', 'Contact No', 'Donate Organ', 'Causes of Death', 'Status'];
        toResponsive('example1', headers1, headerStyle);
    })();
</script>
</html>
