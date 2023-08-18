<?php
    session_start();
    if(!isset($_SESSION["role1"])){
        header("location:registration_login.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta bane="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="technicalVisit.css" >
	<title>Vehicle Insurance</title>
</head>
<body>
    <header>
            <h2 class="logo">Logo</h2>
            <nav class="navigation">
                <a href="#">Home</a>
                <a href="#">About</a>
                <a href="vi_display.php">View Register</a>
                <a href="#">Contact</a>
            </nav>
	</header>

        <?php
            if(isset($_POST["register"])){
                $Owner = $_POST["Owner"];
				$Dealer = $_POST["Dealer"];
				$Email = $_POST["Email"];
                $carReg = $_POST["carReg"];
                $Notice = $_POST["Notice"];
				$Issuedate = $_POST["Issuedate"];
				$Expirydate = $_POST["Expirydate"];

                $errors = array();
				
					if(empty($Owner)){
						array_push($errors, "<b>Owner required</b>");
					}
					else if(empty($Dealer)){
						array_push($errors, "<b>Dealer required</b>");
					}
					else if(empty($Email)){
						array_push($errors, "<b>Email required</b>");
					}
					else if(empty($carReg)){
						array_push($errors, "<b>Car registration number required</b>");
					}
					else if(empty($Issuedate)){
						array_push($errors, "<b>Issued date required</b>");
					}
					else if(empty($Expirydate)){
						array_push($errors, "<b>Expiry date required</b>"); 
					}
				
					else if(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
						array_push($errors,"Invalid email");
					}
					else if(!preg_match("/\b((AD)|(CE)|(EN)|(ES)|(LT)|(NO)|(NW)|(OU)|(SU)|(SW))[0-9]{3}[A-Z]{2}\b/",$carReg)){
						array_push($errors,"Invalid Registration Number");
					}
					else if($Issuedate >= $Expirydate){
						array_push($errors,"Invalid date");
					}
				
				require_once("admin_connect.php");
				if(!empty($Owner) AND !empty($Dealer) AND !empty($Email) AND !empty($carReg) AND !empty($Issuedate) AND !empty($Expirydate)){
					$sql = "SELECT * FROM vehicleinsurance WHERE carReg = '$carReg'";
					$result = mysqli_query($conn, $sql);
					$rowCount = mysqli_num_rows($result);
					if($rowCount > 0){
						array_push($errors, "<b>Car registration number already inputted</b>");
					}
				}
				
                if(count($errors)>0){
                    foreach ($errors as $error){
                        echo "$error";
                    }
                }else{
					if(!empty($Owner) AND !empty($Dealer) AND !empty($Email) AND !empty($carReg) AND !empty($Issuedate) AND !empty($Expirydate))
					{
						$sql = "INSERT INTO vehicleinsurance(Owner,Dealer,Email,carReg,Notice,Issuedate,Expirydate) values(?,?,?,?,?,?,?)";
						$stmt = mysqli_stmt_init($conn);
						$prepare = mysqli_stmt_prepare($stmt,$sql);
						if($prepare){
							mysqli_stmt_bind_param($stmt,"sssssss",$Owner,$Dealer,$Email,$carReg,$Notice,$Issuedate,$Expirydate);
							mysqli_stmt_execute($stmt);
							echo "<div class = 'alert alert-success'>You have registered successfully</div>";
						}else{
							die("Something went wrong");
						}
					}
                    
                    
                }
            }
        ?>
	<div class="wrapper">
        <div class="form-box register">
				<h2>Vehicle Insurance</h2>
				<form action="vehicleinsurance.php" method="post">
					<div class="input-box">
						<span class="icon"><img src="pictures/user.png" style="width:30px;"/></span>
						<input type="text" name="Owner">
						<label>Name of car owner</label>
					</div>
                    <div class="input-box">
						<span class="icon"><img src="pictures/user.png" style="width:30px;"/></span>
						<input type="text" name="Dealer">
						<label>Name of Dealer</label>
					</div>
					<div class="input-box">
						<span class="icon"><img src="pictures/email.png"/></span>
						<input type="email" name="Email">
						<label>Car owner's Email</label>
					</div>
                    <div class="input-box"> 
						<span class="icon"><img src="pictures/registration.png" style="width:30px;height:30px;"/></span>
						<input type="text" name="carReg">
						<label>Car Registration Number</label>
					</div>
                    <div class="input-box">
						<span class="icon"><img src="pictures/notice.jpg" style="width:30px;height:30px;"/></span>
						<textarea rows="3" columns="45" name="Notice" class="detail" placeholder="Notice"></textarea>
                        <!--<label>Details</label>-->
					</div>
					<div class="input-box">
						<input type="date" name="Issuedate">
                        <label>Issued Date</label>
					</div>
                    <div class="input-box">
						<input type="date" name="Expirydate">
                        <label>Expiry Date</label>	
					</div>
					<input type="submit" name="register" class="btn" value="Register">
                    <div class="logout" style="text-align:end;margin-top:15px;">
					    <a href="admin_logout.php" class="logout-link">Done</a>
				    </div>
				</form>
		</div>
    </div>

    <script src="registration_login.js"></script>
</body>

</html>