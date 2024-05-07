<?php
include_once 'conx.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/stylee.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,600,0,0" />
    <title>Organ Donor | Hospital-Doctors-Apply</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/images/fav.png" />

    <style>
        label {
            font-weight: bold;
        }

        input[type="file"] {
            border: 1px solid black;
            border-radius: 50px; /* Adjust this value to make the border circle */
            padding: 15px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="file"]:focus {
            outline: none;
            border-color: #007bff;
        }
		
		.input-box {
    margin-bottom: 20px;
}

.input-box .details {
    font-weight: bold;
    display: block;
}

.input-box select {
    border: 1px solid black;
    border-radius: 50px; /* Adjust this value to make the border circle */
    padding: 15px;
    width: 100%;
    box-sizing: border-box;
    font-size: 16px;
}

.input-box select:focus {
    outline: none;
    border-color: #007bff;
}

    </style>

</head>

<body>

    <div class="container">
        <div class="login-left">
            <div class="login-header">
                <h1>Welcome to <a href="../index.php"
                        style="background: linear-gradient(45deg, #131086, #b621f3); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-family: 'Roboto', sans-serif; text-decoration: none;">Organ
                        Donor</a></h1>
                <p>Please Fill the following form to apply!</p>
            </div>
            <form class="login-form" autocomplete="off" action="add-doctor.php" method="POST"
                enctype="multipart/form-data">
                <div class="login-form-content">
                    <input type="hidden" name="id" value="1">
                    <div class="form-item">
                        <label for="emailForm">Your Name</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-item">
                        <label for="cv">CV</label>
                        <div>
                            <input type="file" id="cv" name="cv" required>
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="emailForm">Email</label>
                        <input type="email" id="email" name="email" required pattern="[^@\s]+@[^@\s]+\.[^@\s]+">
                    </div>
                    <div class="form-item">
                        <label for="passwordForm">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
					<div class="input-box form-item">
    <label for="hospital">Hospital</label>
    <select name="hid" class="styled-select">
        <?php
        $result = mysqli_query($con, "SELECT * FROM hospital where status = '1'");
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <option value="<?php echo $row['hid'] ?>"><?php echo $row['username'] ?></option>
        <?php } ?>
    </select>
</div>

                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="login-right">
            <img src="../assets/images/doctor.jpg" alt="image">
        </div>
    </div>
</body>

</html>
