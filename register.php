<?php  
    include "includes/db.php";

    $password_error = $confirmation_error= $username_error = $all_error = "";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $confirmation_password = htmlspecialchars($_POST['confirmation']);

        // echo "this is password: ". $password;

        if(empty($username) || empty($password) || empty($confirmation_password)){
            $all_error = "can't submit an empty input";
        }elseif(strlen($password) < 8){
            $password_error = "password must be atleast 8 characters";
        }elseif(!preg_match("/[a-z]/i", $password)){
            $password_error = "password must contain atleast a character";
        }elseif(!preg_match("/[0-9]/", $password)){
            $password_error = "password must contain atleast a number";
        }elseif($password !== $confirmation_password){
            $confirmation_error = "passwords must match";
        }else{
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $username = $conn->real_escape_string($username);
            $password_hash = $conn->real_escape_string($password_hash);

            //check if user is already exist
            $sql = "SELECT * FROM Users WHERE Username='$username'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $username_error = "the user already exist";
            }else { 
                $sql = "INSERT INTO Users (UserName, Password) VALUES ('$username', '$password_hash')";
                if($conn->query($sql)){
                    header("Location: login.php");
                    exit;
                }else{
                    die("Signup failed" . $conn->error);
                }
            }
        }
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
            grid-template-columns:  1fr 2fr;
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
            grid-row: 1;
            grid-column: 1 / 2;
            border-top-right-radius: 50%;
            border-bottom-right-radius: 50%;
        }

        input[type='text'], input[type='password'], input[type='email'] {
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
            border: 1px solid #444;
            padding: 10px 0px;
            border-radius: 20px;
            cursor: pointer;
            margin-top: 20px;
            width: 180px;
        }

        .signup {
            background: none;
            border: 2px solid #fff;
            margin: 20px auto;

        }

        .title {
            margin: 20px 0px;
            font-weight: 700;
            color: #1F5673;
        }

        form {
            margin: auto 0px;
            grid-column: 2 / 3;
        }

        .circle_container img {
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
    <form method="POST" action="" novalidate>
        <h1 class="title">Create Account</h1>
        <div class="circle_container">
            <img src="./images/facebook.svg">
            <img src="./images/google.svg">
            <img src="./images/linkedin.svg">
        </div>
        <p style="color: #666;margin-bottom: 20px;">or use you're UserName for registration:</p>
          <?php echo $all_error ? "<small>" . $all_error . "</small><br>" : null; ?>
        <?php echo $username_error ? "<br><small>" . $username_error . "</small><br>" : null; ?>
        <input type="text" name="username" placeholder="Name" value="<?= htmlspecialchars($_POST['username'] ?? null) ?>">
        <?php echo $password_error ? "<br><small>" . $password_error . "</small>" : null; ?><br>
        <input type="password" name="password" placeholder="Password" >
        <?php echo $confirmation_error ? "<br><small>" . $confirmation_error . "</small>" : null; ?><br>
        <input type="password" name="confirmation" placeholder="Confirm Your Password" ><br>
        <input type="submit" name="signUp" value="SIGN UP">
    </form>
    <div class="login_info">
        <h1 style="margin-bottom: 15px;">Welcome Back!</h1>
        <p>To keep connect with us please<br> login with your personal info</p>
        <a href="login.php"><button class="signup" >SIGN IN</button></a>
    </div>
</div>
</body>
</html>
