<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title> Organ Donor | Donor-Login </title>
	  <!-- Favicon -->
 
</head>

<body>

    <div class="container">
        <div class="login-left">
            <div class="login-header">
    <h1>Welcome to <a href="../index.php" style="background: linear-gradient(45deg, #131086, #b621f3); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-family: 'Roboto', sans-serif; text-decoration: none;">Organ Donor</a></h1>
    <p>Please log in to your account and begin your donation process.</p>
</div>

            <form id="formAuthentication" class="login-form" autocomplete="off" action="../donor/login.php" method="POST">
                <div class="login-form-content">
                    <div class="form-item">
                        <label for="emailForm">Enter Email</label>
                        <input type="email" id="email" name="email" required pattern="[^@\s]+@[^@\s]+\.[^@\s]+">
                    </div>
                    <div class="form-item">
                        <label for="passwordForm">Enter Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit">Sign In</button>
                </div>
            </form>
			<div class="text-center pt-12 pb-12">
                    <p>Don't have an account? <a href="donor-register.php" class="underline font-semibold">Register here.</a></p>
                </div>
        </div>
        <div class="login-right">
            
        </div>
    </div>
</body>

</html>