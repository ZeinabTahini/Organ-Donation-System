<?php
include_once 'conx.php';
$did = $_GET['did']; // Fetching did from URL parameter

// Selecting distinct messages where did matches the provided did and grouping them by pid
$result = mysqli_query($con, "SELECT pid, username, sender, date, time FROM messages WHERE did='$did' GROUP BY pid");
$result1 = mysqli_query($con, "SELECT * FROM appointment WHERE did='$did' and status='1'");
$result2 = mysqli_query($con, "SELECT * FROM messages WHERE status='0'");


?>

<!DOCTYPE html>
<html lang="en">
 <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta name="viewport" content="width=device-width, user-scalable ="no"> -->
         <title> Organ Donor | Donor-Message</title>
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
				<a href="message.php?did=<?php echo $did; ?>" class="menu-item is-active">
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
        <div class="container">
            <h4>Conversations</h4>
            <table class="table table-hover responsiveTable" id="example1">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Sender</th>
                        <th>Conversation</th>
                    </tr>
                </thead>
                <tbody>
                     <?php 
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
    ?>
    <tr>
        <td><?php echo $row['username']; ?></td>
        <td><?php echo $row['sender']; ?></td>
        <td><a href="conversation.php?did=<?php echo $did; ?>&pid=<?php echo $row['pid']; ?>"><i class="fa-solid fa-message"></i></a></td>
    </tr>
    <?php
        }
    } else {
    ?>
    <tr>
        <td colspan="3">NO MESSAGES!</td>
    </tr>
    <?php
    }
    ?>
                </tbody>
            </table>
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
        let headers1 = ['Username', 'Sender', 'Conversation'];
        toResponsive('example1', headers1, headerStyle);
    })();
</script>
</html>
