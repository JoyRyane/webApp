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
    <link rel="stylesheet" href="mi_update.css" >
	<link rel="stylesheet" href="technicalVisit2.css">
	<title>MOT</title>
</head>
<body>    
<header>
	<?php
		require_once("admin_connect.php");
		$Email 	= $_SESSION['Email'];
		$sql 	= "SELECT * FROM admin WHERE Email = '$Email' ";
		$query 	= mysqli_query($conn,$sql);
		$row 	= mysqli_fetch_assoc($query) ;
		$id 	= $row['id'];
		$name 	= $row['Name'];
		$email 	= $row['Email'];
		$role 	= $row['Role'];
	?>
    <h2 class="logo">Logo</h2>
	<nav class="navigation">
        <a href="#">Home</a>
        <a href="#">About</a>
	    <a href="mi_display.php">View Register</a>
        <a href="#">Contact</a>
		<?php echo $_SESSION['Email']; ?>
		<?php echo $id; ?>
		<button type="submit" class="button" onclick="openPopup()" >
			<img class="profile" src="<?=$row['image_url']?>" alt="" >
		</button>
		<div class="popup" id="popup" >
			<img class="profile-detail" src="<?=$row['image_url']?>" alt="">
			<p>Name:<?php echo $name; ?></p>
			<p>Email:<?php echo $email; ?></p>
			<p>Role:<?php echo $role; ?></p>
		</div>
    </nav>
</header>
	<?php
		require_once 'admin_connect.php';
		$id=$_GET['updateid'];
		$sql="select * from luggageinsurance where id=$id";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($result);
		$Owner		=$row['Owner'];
		$Dealer		=$row['Dealer'];
		$Email  	=$row['Email'];
		$carReg 	=$row['carReg'];
        $Nature  	=$row['Nature'];
		$Detail 	=$row['Detail'];
		$Issuedate	=$row['Issuedate'];
		$Expirydate	=$row['Expirydate'];

		if(isset($_POST['register'])){
			$Owner 		=$_POST['Owner'];
			$Dealer 	=$_POST['Dealer'];
			$Email 		=$_POST['Email'];
			$carReg 	=$_POST['carReg'];
            $Nature  	=$_POST['Nature'];
		    $Detail 	=$_POST['Detail'];
			$Issuedate	=$_POST['Issuedate'];
			$Expirydate	=$_POST['Expirydate'];

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
                    else if(empty($Nature)){
						array_push($errors, "<b>Nature of luggage required</b>");
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
					else if(!preg_match("/(\b((AD)|(CE)|(EN)|(ES)|(LT)|(NO)|(NW)|(OU)|(SU)|(SW))[0-9]{3}[A-Z]{2}\b)|(\b((AD)|(CE)|(EN)|(ES)|(LT)|(NO)|(NW)|(OU)|(SU)|(SW))[0-9]{4}[A-Z]{1}\b)/",$carReg)){
						array_push($errors,"Invalid Registration Number");
					}
					else if($Issuedate >= $Expirydate){
						array_push($errors,"Invalid date");
					}

					/*if(!empty($Owner) AND !empty($Dealer) AND !empty($Email) AND !empty($carReg) AND !empty($Issuedate) AND !empty($Expirydate)){
						$sql = "SELECT * FROM technicalvisit WHERE carReg = '$carReg'";
						$result = mysqli_query($conn, $sql);
						$rowCount = mysqli_num_rows($result);
						if($rowCount > 0){
							array_push($errors, "<b>Car registration number already inputted</b>");
						}
					}*/
					if(count($errors)>0){
						foreach ($errors as $error){
							echo "$error";
						}
					}else{

						$sql="update luggageinsurance set id=$id,Owner='$Owner',Dealer='$Dealer',Email='$Email',
						carReg='$carReg',Nature='$Nature',Detail='$Detail', Issuedate='$Issuedate' ,Expirydate='$Expirydate' where id=$id ";
						$result=mysqli_query($conn,$sql);
						if($result){
							header('Location:mi_display.php');
						}else{
							die(mysqli_error($conn));
						}

					}

		}
	?>
	<div class="wrapper">
        <div class="form-box register">
				<h2>Gray Card Registration</h2>
				<form action="" method="post">
					<div class="input-box">
						<span class="icon"><img src="pictures/user.png" style="width:30px;"/></span>
						<input type="text" name="Owner" value=<?php
						echo $Owner;?>
						>
						<label>Name of car owner<span style="color: red;">*</span></label>
					</div>
                    <div class="input-box">
						<span class="icon"><img src="pictures/user.png" style="width:30px;"/></span>
						<input type="text" name="Dealer" value=<?php
						echo $Dealer;?>
						>
						<label>Name of Dealer<span style="color: red;">*</span></label>
					</div>
					<div class="input-box">
						<span class="icon"><img src="pictures/email.png"/></span>
						<input type="email" name="Email" value=<?php
						echo $Email;?>
						>
						<label>Car owner's Email<span style="color: red;">*</span></label>
					</div>
                    <div class="input-box"> 
						<span class="icon"><img src="pictures/registration.png" style="width:30px;height:30px;"/></span>
						<input type="text" name="carReg" value=<?php
						echo $carReg;?>
						>
						<label>Car Registration Number<span style="color: red;">*</span></label>
					</div>
                    <div class="input-box"> 
						<span class="icon"><img src="pictures/registration.png" style="width:30px;height:30px;"/></span>
						<input type="text" name="Nature" value=<?php
						echo $Nature;?>
                        >
						<label>Nature of Luggage<span style="color: red;">*</span></label>
					</div>
                    <div class="input-box">
						<span class="icon"><img src="pictures/notice.jpg" style="width:30px;height:30px;"/></span>
						<textarea rows="3" columns="45" name="Detail" class="detail"><?php echo $Detail; ?></textarea>
                        <!--<label>Details</label>-->
					</div>
					<div class="input-box">
						<input type="date" name="Issuedate" value=<?php
						echo $Issuedate;?>
						>
                        <label>Issued Date<span style="color: red;">*</span></label>
					</div>
                    <div class="input-box">
						<input type="date" name="Expirydate" value=<?php
						echo $Expirydate;?>>
                        <label>Expiry Date<span style="color: red;">*</span></label>	
					</div>
					<input type="submit" name="register" class="btn" value="Update">
                    <div class="logout">
					    <a href="admin_logout.php" class="logout-link">Done</a>
				    </div>
				</form>
		</div>
    </div>
	<script type="text/javascript" src="technicalVisit.js"></script>
</body>

</html>