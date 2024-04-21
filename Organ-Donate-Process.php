<?php
include_once 'conx.php';
$result = mysqli_query($con,"SELECT * FROM donor_details");
$result1 = mysqli_query($con, "SELECT * FROM hospital WHERE status='0'");
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta name="viewport" content="width=device-width, user-scalable ="no"> -->
         <title> Organ Donor | Admin-Organ-Process</title>
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
                            <a href="Donor-Details.php" >
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
                            <a href="Search-Donor.php">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <span class="text">Search Donor</span>
                            </a>
                        </li>
                        <li class="menu-link">
                            <a href="Search-Patient.php">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <span class="text">Search Patient</span>
                            </a>
                        </li>
                        <li class="menu-link">
                            <a href="Donated-Patient.php">
                                <i class="bx bx-heart icons"></i>
                                <span class="text">Donated Patient</span>
                            </a>
                        </li>
                        <li class="menu-link">
                            <a href="Organ-Donate-Process.php" class="active">
                                <i class="fa-regular fa-hourglass"></i>
                                <span class="text">Organ Donate Process</span>
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
                            <a href="hospital.php">
                               <i class="fa-regular fa-hospital"></i>
                                <span class="text">All Saved Hospitals</span>
                            </a>
                        </li>
						<li class="menu-link">
                            <a href="Donor-wills.php">
                               <i class="fa-regular fa-pen-to-square"></i>
                                <span class="text">Donor Wills</span>
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
                        <h1>Organ Donate Process</h1>
                    </section>
                    <section class="table__body">
                        <table>
                            <thead>
                            
                                <tr>
                                    <th> Id </th>
                                    <th> D-Name </th>
                                    <th> H-Name </th>
                                    <th> Age </th>
                                    <th> Gender </th>
                                    <th> Address </th>
                                    <th> Blood Group </th>
                                    <th> E-Mail </th>
                                    <th> Contact No </th>
                                    <th> Donate Organ </th>
                                    <th> Causes of Death </th>
                                    <th> Status </th>
									
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $result = mysqli_query($con, "SELECT d.*, ah.username AS hospital_username 
                               FROM donor_details d 
                               INNER JOIN hospital ah ON d.hid = ah.hid 
                               WHERE d.status = 0");

                            if(mysqli_num_rows($result)>0){
                              $i=1;
                                while($row = mysqli_fetch_array($result)){ 
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
            $statusClass = 'cancelled';
            break;
        case 1:
            $status = 'Completed';
            $statusClass = 'pending';
            break;
        default:
            $status = $row['status'];
    }
    ?>
    <p class="status <?php echo $statusClass; ?>"><?php echo $status; ?></p>
</td>

<td>
    <a href="matching.php?blood_group=<?php echo urlencode($row['blood_group']); ?>&donate_organ=<?php echo urlencode($row['donate_organ']); ?>&did=<?php echo $row['did']; ?>">
        <i class="fa-solid fa-check-double"></i>
    </a>
</td>




                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="13">NO ORGAN DETAILS!</td>
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