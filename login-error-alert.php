<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Organ Donor | Login-Error</title>
	  <!-- image-->
    
	<style>
	.three {
            background-color: red;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 10px 16px;
            cursor: pointer;
            text-decoration: none;
			margin-left: 190px; /* Adjust this value as needed */

        }

        .three:hover {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .center {
        }
	 .message {
            background-color: #ffe6e6;
            padding: 10px;
            border-radius: 5px;
			margin-top: 40px;
            margin-bottom: 40px; /* Added margin-bottom to create space */
        }
	</style>
</head>

<body>

    <div class="container">
        <div class="login-left">
            <div class="login-header" >
                   <h1>Welcome to <a href="../index.php" style="background: linear-gradient(45deg, #131086, #b621f3); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-family: 'Roboto', sans-serif; text-decoration: none;">Organ Donor</a></h1>
            </div>
			<div class="message login-form" autocomplete="off">
                <p>Wrong email or password! </br>
Please enter your email and password correctly.</p>
            </div>
			<div class="center">
               <a class="three" href="javascript:history.go(-1);">
    <i class="fa-solid fa-arrow-left"></i>
    Back
</a>
            </div>
        </div>
        <div class="login-right">
            <!-- image -->
        </div>
    </div>
</body>

</html>