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
         <title> Organ Donor | Admin-Patient-Details</title>
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
                            <a href="Patient-Details.php" class="active">
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
                        <h1>Patient Details</h1>
                        <div class="input-group">
                            <input type="search" placeholder="Search Data...">
                           
                        </div>
                        <div class="export__file">
                            <label for="export-file" class="export__file-btn" title="Export File"></label>
                            <input type="checkbox" id="export-file">
                            <div class="export__file-options">
                                <label>Export As &nbsp; &#10140;</label>
                               
                            </div>
                        </div>
                    </section>
                    <section class="table__body">
                        <table>
                            <thead>
                                <tr>
                                    <th> Id <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Patient Name <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Age <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Gender <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Address <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Bood Group <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> E-Mail <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Contact No <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Needed Organ <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Time Required <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Status <span class="icon-arrow">&UpArrow;</span></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $result = mysqli_query($con,"SELECT * FROM patient_details");
                            if(mysqli_num_rows($result)>0){
                              $i=1;
                                while($row = mysqli_fetch_array($result)){ 
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
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="12">NO PATIENT DETAILS!</td>
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