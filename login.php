<?php
    include 'includes/db.php';

    $all_error = "";

	if($_SERVER['REQUEST_METHOD'] === "POST"){
        $username = htmlspecialchars($_POST['username']);
    	$password = htmlspecialchars($_POST['password']);

        $username = $conn->real_escape_string($username);


        $sql = "SELECT * FROM Users WHERE UserName='$username'";
        $query = $conn->query($sql);

        $user = $query->fetch_assoc();

		if($user){
            if(password_verify($password, $user['Password'])){
                session_start();

                session_regenerate_id();

                $_SESSION['user_id'] = $user['UserId'];
                header("Location: dashboard.php");
                exit;
            }
		}

        $all_error = "invalid Name or password";
	}

 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>form</title>
 	<style type="text/css">
 		* {
 			margin: 0px;
 			padding: 0px;
 			box-sizing: border-box;
 		}

 		body {
 			font-family: sans-serif;
 			width: 100vw;
 			height: 100vh;
 		}

 		.container {
 			display: grid;
 			grid-template-columns:  2fr 1fr;
 			text-align: center;
 			height: 100%;
 		}

 		.login_info {
 			background: linear-gradient(to right, #759FBC, #1F5673) no-repeat 0 0 / cover;
 			color: #fff;
 			height: 100%;
 			display: flex;
 			flex-direction: column;
 			justify-content: center;
 			line-height: 1.3rem;
 			border-top-left-radius: 50%;
 			border-bottom-left-radius: 50%;

 		}

 		input[type='text'],input[type='password'],input[type="email"] {
 			border: none;
 			background-color: #f4f4f4;
 			width: 300px;
 			padding: 15px;
 			margin-bottom: 10px;
 			outline: none;
 		}

 		input[type='submit'], .signup {
 			background-color: #1F5673;
 			color: #fff;
 			border: 1px solid #1F5673;
 			padding: 10px 0px;
 			border-radius: 20px;
 			cursor: pointer;
 			margin-top: 20px;
 			width: 180px;
 		}

 		.forget {
 			border: none;
 			background-color: #fff;
 			color: #666;
 			box-shadow: 2px 2px 10px 0.01px #666;
 			padding: 3px 5px;
 			margin: 10px 0px;
 			cursor: pointer;
 		}

 		.signup {
 			background: none;
 			border: 2px solid #fff;
 			/*margin: 20px auto;*/

 		}

 		.title {
 			margin: 20px 0px;
 			font-weight: 700;
 			color: #1F5673;
 		}

 		form {
 			margin: auto 0px;
 		}

 		.circle_container img{

 			border: 2px solid #666;
 			padding: 10px;
 			margin: 20px 5px 30px 10px;
 			border-radius: 50%;
 			width: 45px;
 			height: 45px;
 		}

        small {
            color: red;
        }
 	</style>

 </head>
 <body>
 	<div class="container">
 		<form action="" method="POST">
 			<h1 class="title">Sign In To BEAUTY WAREHOUSE</h1>
 			<div class="circle_container">
 				<img src="./images/facebook.svg">
 				<img src="./images/google.svg">
 				<img src="./images/linkedin.svg">
 			</div>
 			<p style="color: #666;margin-bottom: 20px;">or use you're UserName account:</p>
            <?php echo $all_error ? "<small>" . $all_error . "</small><br>" : null; ?>
            <!-- <input type="text" name="username" placeholder="Name" required><br> -->
 			<input type="text" name="username" placeholder="Name" value="<?= htmlspecialchars($_POST['username'] ?? null) ?>" required><br>
 			<input type="password" name="password" placeholder="Password" required><br>
 			<button class="forget">Forget Your password?</button><br>
 			<input type="submit" name="signIn" value="SIGN IN">
 		</form>
 		<div class="login_info">
 			<h1 style="margin-bottom: 15px;">Hello, Freind!</h1>
 			<p>Enter your personal details and start journey<br> with us</p>
 			<a href="register.php"><button class="signup" >SIGN UP</button></a>
 		</div>
 	</div>
 </body>
 <script type="text/javascript">
 	
 </script>
 </html>