<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   <title> Organ Donor | Donor-Register </title>
	  <!-- Favicon -->
    
</head>

<body>

    <div class="container">
        <div class="login-left">
            <div class="login-header">
                    <h1>Welcome to <a href="../index.php" style="background: linear-gradient(45deg, #131086, #b621f3); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-family: 'Roboto', sans-serif; text-decoration: none;">Organ Donor</a></h1>
                <p>Register Your Account!</p>
            </div>
            <form class="login-form" autocomplete="off" action="add.php" method="POST">
                <div class="login-form-content">
				<input type="hidden" name="did" value="1">
				<div class="form-item" >
                        <label for="emailForm">Enter Name</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-item">
                        <label for="emailForm">Enter Email</label>
                        <input type="email" id="email" name="email" required pattern="[^@\s]+@[^@\s]+\.[^@\s]+">
                    </div>
                    <div class="form-item">
                        <label for="passwordForm">Enter Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit">Register</button>
                </div>
            </form>
			<div class="text-center pt-12 pb-12">
                    <p>Already have an account? <a href="../donor/donor-index.php" class="underline font-semibold">Sign in instead.</a></p>
                </div>
        </div>
        <div class="login-right">
           
        </div>
    </div>
</body>

</html>