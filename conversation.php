<?php
include_once 'conx.php';

// Retrieve the pid and did from the URL parameters
$pid = isset($_GET['pid']) ? $_GET['pid'] : '';
$did = isset($_GET['did']) ? $_GET['did'] : '';
$result0 = mysqli_query($con,"SELECT * FROM donor_details WHERE did='" . $_GET['did'] . "'");
$row0= mysqli_fetch_array($result0);

$username = $row0['donor_name'];

$sql = "(SELECT sender, date, time, msg FROM messages WHERE pid='$pid')
        UNION
        (SELECT 'Donor' AS sender, date, time, msg FROM donor_messages WHERE pid='$pid')
        ORDER BY date ASC, time ASC";

$result = mysqli_query($con, $sql);
$result1 = mysqli_query($con, "SELECT * FROM appointment WHERE did='$did' and status='1'");

$result2 = mysqli_query($con, "SELECT * FROM messages WHERE status='0'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Organ Donor | Donor-Conversation</title>
	  <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/images/fav.png" />
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../assets/css/message.css">
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
        <div class="message-header">
            <div class="active_state">
    <h4><?php echo $username; ?></h4>
</div>

        </div>
        <div class="message-page">
            <div class="message-index">
        <div class="messages">
            <div class="msg-page">
                        <?php
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){
                                ?>
                                <?php if($row['sender'] === 'Donor'): ?>
                                    <div class="outgoing-chat">
                                        <div class="outgoing-chat-msg">
                                            <p><?php echo $row['msg']; ?></p>
                                            <small><?php echo $row['date']; ?> <?php echo $row['time']; ?></small>
											<a href="delete-message.php?pid=<?php echo $pid; ?>&did=<?php echo $did; ?>&date=<?php echo $row['date']; ?>&time=<?php echo $row['time']; ?>" class="delete-btn">
    <i class="fas fa-trash"></i>
</a>




                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="recived-chat">
                                        <div class="recived-msg">
                                            <div class="recived-msg-inbox">
                                                <p><?php echo $row['msg']; ?></p>
                                                <small><?php echo $row['date']; ?> <?php echo $row['time']; ?></small>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php
                            }
                        } else {
                            echo "NO RESULT FOUND!";
                        }
                        ?>
                    </div>
        </div>
    </div>


            <div class="msg-bottom">
    <form action="d-message.php?did=<?php echo $did ?>&pid=<?php echo $pid ?>" method="POST" enctype="multipart/form-data">
        <div class="input-group">
            <input type="text" class="form-control" name="message" placeholder="write message.....">
            <div class="input-group-append">
                <a href="#" onclick="submitForm()">
                    <span class="input-group-text">
                        <i class="fa fa-paper-plane"></i>  
                    </span>
                </a>
            </div>
        </div>
    </form>
</div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    // Toggle menu functionality
    const menu_toggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');

    menu_toggle.addEventListener('click', () => {
        menu_toggle.classList.toggle('is-active');
        sidebar.classList.toggle('is-active');
    });
	
	 function submitForm() {
        document.querySelector('form').submit();
    }
</script>
</html>