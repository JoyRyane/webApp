<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta bane="viewport" content="width=device-width,initial-scale=1.0">
    <link href="registrationLogin.css" rel="stylesheet">
	<link rel="stylesheet" href="css/gray_card.css">
	<title>Register/Login</title>
</head>
<body>
	<div class="color-overlay"></div>
    <header>
            <h2 class="logo">Logo</h2>
            <nav class="navigation">
                <a href="#">Home</a>
                <a href="#">About</a>
                <a href="#">Services</a>
                <a href="#">Contact</a>
                <button class="btnLogin-popup">Login</button>
            </nav>
	</header>
	
	
	<?php
        if(isset($_POST["login"])){
            $Email = $_POST["Email"];
            $Password = $_POST["Password"];

            require_once "admin_connect.php";
            $sql = "SELECT * FROM admin WHERE Email = '$Email'";
			$result = mysqli_query($conn, $sql);
			$user = mysqli_fetch_array($result , MYSQLI_ASSOC);
            if($user){
                if(password_verify($Password, $user["Password"])){
					session_start();
					$_SESSION['Email'] = $Email;
					$_SESSION["role1"]="IC";
                    $_SESSION["role2"]="MOT";
					$_SESSION["role3"]="TV";					
                    if($user["Role"] == 'Insurance Company'){
                        if(isset($_SESSION["role1"])){
                            header("location:Insurance.php");
                            die();
                        }
                    }elseif($user["Role"] == 'Ministry of Transport'){
                        if(isset($_SESSION["role2"])){
                            header("location:ministry_of_transport.php");
                            die();
                        }
                    }elseif($user["Role"] == 'Technical Visit'){
                        if(isset($_SESSION["role3"])){
                            header("location:technical_visit.php");
                            die();
                        }                       
                    }
                }else{
                    echo "Incorrect Password";
                }
            }else{
                echo "Email not found!";
            }
			if(empty($Email)){
				echo "Email Required!";
			}
        }
    ?>

<?php 
	include 'registration_php_connect.php'
?>

	
    <div class="wrapper">
	<div class="image-overlay"></div>
    <span class="icon-close"><img src="pictures/wCross.png" style="width: 15px;"/></span>
        <div class="form-box login">
            <h2>Login</h2>
            <form action="registration_login.php" method="post" autocomplete="off">
                <div class="input-box">
                    <span class="icon"><img src="pictures/email.png"/></span>
                    <input type="email" name="Email">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><img src="pictures/password.png"/></span>
                    <input type="password" name="Password">
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox">Remind me</label>
                    <a href="#">Forgot password?</a>
                </div>
                <input type="submit" name="login" class="btn" value="Login">
                <div class="login-register">
                    <p>Don't have an account?<a href="#" class="register-link" style="font-weight:bold;font-size:20px;color:#87CEEB;"> Register</a></p>
                </div>
            </form>
        </div>

        <div class="form-box register">
				<h2>Registration</h2>
				<form action="registration_login.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<div class="input-box">
						<span class="icon"><img src="pictures/user.png" style="width:30px;"/></span>
						<input type="text" name="Name">
						<span class="input_error">
                            <?php 
								echo $nameErr; 
							?>
                        </span>
						<label>Username</label>
					</div>
					<div class="input-box">
						<span class="icon"><img src="pictures/email.png"/></span>
						<input type="email" name="Email">
						<label>Email</label>
					</div>
                    <div class="input-box">
						<span class="icon"><img src="pictures/user.png" style="width:30px;"></span>
						<select name="Role">
						<!--disabled selected-->
							<option value="Pending">Role</option>
							<option value="Insurance Company">Insurance Company</option>
							<option value="Ministry of Transport">Ministry of Transport</option>
							<option value="Technical Visit">Technical Visit</option>
						</select>
					</div>
					<div class="input-box">
						<span class="icon"><img src="pictures/password.png"/></span>
						<input type="password" name="Password">
						<label>Password</label>
					</div>
                    <div class="input-box">
						<span class="icon"><img src="pictures/password.png"/></span>
						<input type="password" name="Repeat_Password">	
						<label>Confirm Password</label>
					</div>
					<div class="input-box">
						<input type="file" name="image">	
						<label>Image</label>
					</div>
					<div class="remember-forgot">
						<label><input type="checkbox" name="check" >Agree to terms and conditions</label>
					</div>
					<input type="submit" name="register" class="btn" value="Register">
					<div class="login-register">
						<p>Already have an account?<a href="#" class="login-link" style="font-weight:bold;font-size:20px;color:#87CEEB;"> Login</a></p>
					</div>
				</form>
		</div>
    </div>

    <script src="registration_login.js"></script>
</body>

</html>
