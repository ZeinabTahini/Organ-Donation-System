<?php
include_once 'conx.php';
$result = mysqli_query($con,"SELECT * FROM hospital WHERE status=1");
$result1 = mysqli_query($con, "SELECT * FROM hospital WHERE status='0'");
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta name="viewport" content="width=device-width, user-scalable ="no"> -->
         <title> Organ Donor | Admin-Hospital</title>
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
                    <a href="hospital-apps.php">
                       <i class="fa-regular fa-bell"></i>
                        <span class="text">Hospital Applications</span>
                        <?php
                        if (mysqli_num_rows($result1) > 0) {
                            $newRequest = mysqli_num_rows($result1);
                            ?>
                           <span class="badge  me-1" style="background-color:#07960c;color:#fff;">
    <?php echo $newRequest; ?> new hospital
</span>

                        <?php
                        }
                        ?>
                    </a>
                </li>
						<li class="menu-link">
                            <a href="hospital.php" class="active">
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
                <main class="heading table" id="customers_table">
                    <section class="table__header">
                        <h1>All Hospitals</h1>
                    </section>
                    <section class="table__body">
                        <table>
                            <thead>
                            
                                <tr>
                                    <th> Id </th>
                                    <th> Hospital Name </th>
                                    <th> Email </th>
									<th> Info </th>
                                </tr>
                            </thead>
                            <tbody>
                             <?php 
                            if(mysqli_num_rows($result)>0){
                              $i=0;
                                while($row = mysqli_fetch_array($result)){
                                    
                            ?>
                                <tr>
                                    <td> <?php echo $row['hid']; ?> </td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td> <?php echo $row['email']; ?> </td>
									<td><a href="Info/<?php echo $row['info'] ?>" ?><?php echo $row['info'] ?></a></td>
									<td><a href="delete-hospital.php?hid=<?php echo $row['hid'];?>"><i class="fa-regular fa-trash-can"></i></a></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">NO SAVED HOSPITALS!</td>
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