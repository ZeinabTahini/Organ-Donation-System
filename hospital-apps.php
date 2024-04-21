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
   

    </head>

    <body>
        <div class="container">
            <div class="sidebar">
                <div class="header">
                    <i class="bx bx-menu icon"></i>
                    <span class="title">Admin</span>
                </div>
                <div class="menu-bar">
                    <div class="menu">
					<li class="menu-link">
                            <a href="Donor-Details.php">
                                 <i class="fa-solid fa-hand-holding-medical"></i>
                                <span class="text">Donor Details</span>
                            </a>
                        </li>
                        <li class="menu-link">
                            <a href="Patient-Details.php">
                                <i class="fa-solid fa-hospital-user"></i>
                                <span class="text">Patient Details</span>
                            </a>
							</li>
						<li class="menu-link">
                            <a href="hospital-apps.php" class="active">
                                <i class="fa-regular fa-bell"></i>
                                <span class="text">Hospital Applications</span>
                            </a>
                        </li>
						<li class="menu-link">
                            <a href="hospital.php">
                               <i class="fa-regular fa-hospital"></i>
                                <span class="text">All Saved Hospitals</span>
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
            <div class="main">
                <main class="heading table " id="customers_table">
                    <section class="table__header">
                        <h1>Upcoming Application for Hospital</h1>
                    </section>
                    <section class="table__body">
                        <table>
                            <thead>
                            
                                <tr>
                                    <th> Id </th>
                                    <th> Hospital Name </th>
                                    <th> Info </th>
                                    <th> Email </th>
                                    <th> Accept Hospital </th>
                                    <th> Reject Hospital</th>
                                    
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
                    </section>
                </main>
            </div>
        </div>
    </body>
    

    </html>