<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="top-bar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Responsive Dashboard</title>
</head>
<body>
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
    <div class="container">
        <div class="top-bar">
			<div class="nav_bar">
				<div class="top_nav">
					<div class="top">
						<div class="logo">
							<img src="./images/check.png" alt="">
							<h2>EGA<span class="danger">TOR</span></h2>
						</div>
						<div class="close" id="close-btn">
						<span class="material-symbols-sharp">close</span>
						</div>
					</div>
				</div>
			</div>
			<div class="right">
				<div class="top">
					<button id="menu-btn">
						<span class="material-symbols-sharp">menu</span>
					</button>
					<div class="theme-toggler">
						<span class="material-symbols-sharp active">light_mode</span>
						<span class="material-symbols-sharp">dark_mode</span>
					</div>
					<div class="profile">
						<div class="info">
							<p>Hey <b><?=$row['Name']?></b> </p>
							<small class="text-muted">Admin</small>
						</div>
						<div class="profile-photo">
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
			</div>
    </div>
	<script src="Insurance.js"></script>
   <!-- <script src="luggageInsurance.js"></script>-->
</body>
</html>