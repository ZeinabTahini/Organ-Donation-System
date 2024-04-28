<?php
include_once 'conx.php';
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta name="viewport" content="width=device-width, user-scalable ="no"> -->
         <title> Organ Donor | Admin-Hospital-apps</title>
	  <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/images/fav.png" />
        <!---Boxicons CSS-->
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="../assets/css/admin-style.css">
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
				<a href="hospital-apps.php" class="menu-item is-active">
    <i class="fa-regular fa-bell"></i> Hospital Applications 
    <?php
    if (mysqli_num_rows($result1) > 0) {
        $newRequest = mysqli_num_rows($result1);
        echo '<span class="badge me-1" style="background-color:#07960c;color:#fff;">' . $newRequest . ' new hospital</span>';
    }
    ?>
</a>
<a href="hospital.php" class="menu-item"><i class="fa-regular fa-hospital"></i> All Saved Hospitals </a>

				<a href="../index.php" class="menu-item">
  <i class="bx bx-log-out icons"></i> Logout
</a>
			</nav>

		</aside>
		<div class="container">
			 <h4>Donor Details </h4>
    <table class="table table-hover responsiveTable" id="example1">
      <thead>
        <tr>
          <th>Id</th>
          <th>Hospital Name</th>
          <th>Info</th>
		  <th>E-Mail</th>
          <th>Accept Hospital</th>
          <th>Reject Hospital</th>
        </tr>
      </thead>
      <tbody>
                            <?php 
                            $result = mysqli_query($con,"SELECT * FROM hospital where status = '0'");
                            if(mysqli_num_rows($result)>0){
                              $i=1;
                                while($row = mysqli_fetch_array($result)){ 
                            ?>
                                <tr>
                                    <td> <?php echo $row['hid']; ?> </td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><a href="Info/<?php echo $row['info']; ?>"><?php echo $row['info']; ?></a></td>
                                    <td> <?php echo $row['email']; ?> </td>
									<td><a href="accept-hospital.php?hid=<?php echo $row['hid']; ?>" class="btn btn-primary">Accept</a></td>
									<td><a href="reject-hospital.php?hid=<?php echo $row['hid']; ?>" class="btn btn-primary">Reject</a></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="7">NO UPCOMING APPLICATIONS!</td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
            </div>
        </div>
    </body>
    <script src="../assets/js/admin-script.js"></script>

    </html>