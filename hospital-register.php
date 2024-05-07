<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,600,0,0" />
    <title> Organ Donor | Hospital-Register </title>
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
</style>

</head>

<body>

    <div class="container">
        <div class="login-left">
            <div class="login-header">
                    <h1>Welcome to <a href="../index.php" style="background: linear-gradient(45deg, #131086, #b621f3); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-family: 'Roboto', sans-serif; text-decoration: none;">Organ Donor</a></h1>
                <p>Please Fill the following form to apply!</p>
            </div>
            <form class="login-form" autocomplete="off" action="add.php" method="POST" enctype="multipart/form-data">
                <div class="login-form-content">
				<input type="hidden" name="hid" value="1">
				<div class="form-item" >
                        <label for="emailForm">Hospital Name</label>
                        <input type="text" id="username" name="username" required>
                    </div>
					<div class="form-item">
                <label for="info">Hospital Info</label>
                <div>
                    <input type="file" id="info" name="info" required>

                </div>
            </div>
                    <div class="form-item">
                        <label for="emailForm">Hospital Email</label>
                        <input type="email" id="email" name="email" required pattern="[^@\s]+@[^@\s]+\.[^@\s]+">
                    </div>
                    <div class="form-item">
                        <label for="passwordForm">Hospital Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit">Submit</button>
                </div>
            </form>
			<div class="text-center pt-12 pb-12">
                    <p>Aleardy Applied as Hospital ? <a href="../hospital/hospital-index.php" class="underline font-semibold">Sign in!</a></p>
                </div>
        </div>
        <div class="login-right">
            <img src="../assets/images/hospital.jpg" alt="image">
        </div>
    </div>
</body>

</html>