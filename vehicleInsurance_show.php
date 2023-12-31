<?php
    session_start();
    if(!isset($_SESSION["role1"])){
        header("location:registration_login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Insurance.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="css/vehicleInsurance.css">
    <link rel="stylesheet" href="css/vehicleInsurance_show.css">
    <title>Responsive Dashboard</title>
</head>
<body>
    <?php 
		include 'vehicleInsuranceShow_php_connect.php';
		include "top_bar.php";
	?>
    <div class="container">
        <aside>
            <div class="sidebar">
                <a href="Insurance.php">
                    <span class="material-symbols-sharp">grid_view</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="luggageInsurance.php">
                    <span class="material-symbols-sharp">insights</span>
                    <h3>Luggage Insurance Registration</h3>
                </a>
                <a href="vehicleInsurance.php">
                    <span class="material-symbols-sharp">mail_outline</span>
                    <h3>Vehicle Insurance Registration</h3>
                </a>
                <a href="vehicleInsuranceDisplay.php" >
                    <span class="material-symbols-sharp">inventory</span>
                    <h3>All Registered Vehicle Insurance</h3>
                </a>
                <a href="myVehicleInsuranceDisplay.php">
                    <span class="material-symbols-sharp">report_gmailerrorred</span>
                    <h3>Your Registered Vehicle Insurance</h3>
                </a>
                <a href="luggageInsuranceDisplay.php">
                    <span class="material-symbols-sharp">settings</span>
                    <h3>All Registered Luggage Insurance</h3>
                </a>
                <a href="myLuggageInsuranceDisplay.php">
                    <span class="material-symbols-sharp">add</span>
                    <h3>Your Registered Luggage Insurance</h3>
                </a>
                <a href="admin_logout.php">
                    <span class="material-symbols-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
		<div class="wrapper">
			<button class="btn">
                <a href="vehicleInsuranceDisplay.php" >BACK</a>
            </button>
            <h2>Customer Vehicle Insurance Details</h2>
            <p class="detail">Owner:               <br> <p class="value"><?php echo $Owner; ?></p> </p>
            <p class="detail">Dealer:              <br> <p class="value"><?php echo $Dealer; ?></p> </p>
            <p class="detail">Email:               <br> <p class="value"><?php echo $Email; ?></p> </p>
            <p class="detail">Registration Number: <br> <p class="value"><?php echo $carReg; ?></p> </p>
            <p class="detail">Issued Date:         <br> <p class="value"><?php echo $Issuedate; ?></p> </p>
            <p class="detail">Expiry Date:         <br> <p class="value"><?php echo $Expirydate; ?></p> </p>
            <p class="detail">Further Details:     <br> <p class="value"><?php echo $Notice; ?></p> </p>
        </div>
		<div class="right">
			<!--<div class="top">
				<button id="menu-btn">
				<span class="material-symbols-sharp">menu</span>
				</button>
				<div class="theme-toggler">
					<span class="material-symbols-sharp active">light_mode</span>
					<span class="material-symbols-sharp">dark_mode</span>
				</div>
				<div class="profile">
					<div class="info">
						<?php
							require_once "admin_connect.php";
							$Email 	= $_SESSION['Email'];
							$sql 	= "SELECT * FROM admin WHERE Email = '$Email' ";
							$query 	= mysqli_query($conn,$sql);
							$row 	= mysqli_fetch_assoc($query) ;
						?>
						<p>Hey <b><?=$row['Name']?></b> </p>
						<small class="text-muted">Admin</small>
					</div>
					<div class="profile-photo">
						<?php
							$id 	= $row['id'];
							$name 	= $row['Name'];
							$email 	= $row['Email'];
							$role 	= $row['Role'];
						?>
						<button type="submit" class="button" onclick="openPopup()" >
							<img class="profile" src="<?=$row['image_url']?>" alt="" >
						</button>
						<div class="popup" id="popup" >
							<img class="profile-detail" src="<?=$row['image_url']?>" alt="">
							<p>Name:<?php echo $name; ?></p>
							<p>Email:<?php echo $email; ?></p>
							<p>Role:<?php echo $role; ?></p>
						</div>
					</div>
				</div>
			</div>
			<div class="recent-updates">
				<h2>Recent Updates</h2>
				<div class="updates">
					<div class="update">
						<div class="profile-photo">
							<img src="./pictures/profile1.jpg" alt="">
						</div>
						<div class="message">
							<p> <b>Mike Tyson</b> received his order of Night lion tech GPS Drone </p>
							<small class="text-muted">2 Minutes Ago</small>
						</div>
					</div>

					<div class="update">
						<div class="profile-photo">
							<img src="./pictures/profile2.jpg" alt="">
						</div>
						<div class="message">
							<p> <b>Mike Tyson</b> received his order of Night lion tech GPS Drone </p>
							<small class="text-muted">2 Minutes Ago</small>
						</div>
					</div>

					<div class="update">
						<div class="profile-photo">
							<img src="./pictures/profile3.jpg" alt="">
						</div>
						<div class="message">
							<p> <b>Mike Tyson</b> received his order of Night lion tech GPS Drone </p>
							<small class="text-muted">2 Minutes Ago</small>
						</div>
					</div>
				</div>
			</div>
			<div class="sales-analytics">
				<h2>Sales Analytics</h2>
				<div class="item online">
					<div class="icon">
						<span class="material-symbols-sharp">shopping_cart</span>
					</div>
					<div class="right">
						<div class="info">
							<h3>ONLINE ORDERS</h3>
							<small class="text-muted">Last 24 Hours</small>
						</div>
						<h5 class="success">+39%</h5>
						<h3>3849</h3>
					</div>
				</div>
				<div class="item offline">
					<div class="icon">
						<span class="material-symbols-sharp">local_mall</span>
					</div>
					<div class="right">
						<div class="info">
							<h3>OFFLINE ORDERS</h3>
							<small class="text-muted">Last 24 Hours</small>
						</div>
						<h5 class="danger">-17%</h5>
						<h3>1100</h3>
					</div>
				</div>
				<div class="item customers">
					<div class="icon">
						<span class="material-symbols-sharp">person</span>
					</div>
					<div class="right">
						<div class="info">
							<h3>NEW CUSTOMERS</h3>
							<small class="text-muted">Last 24 Hours</small>
						</div>
						<h5 class="success">+25%</h5>
						<h3>849</h3>
					</div>
				</div>
				<div class="item add-product">
					<div>
						<span class="material-symbols-sharp">add</span>
						<h3>Add Product</h3>
					</div>
				</div>
			</div>-->
		</div>
    </div>
   <!-- <script src="merchandiseInsurance.js"></script>-->
</body>
</html>