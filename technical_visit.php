<?php
    session_start();
    if(!isset($_SESSION["role2"])){
        header("location:registration_login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Insurance.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Responsive Dashboard</title>
</head>
<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="./images/check.png" alt="">
                    <h2>EGA<span class="danger">TOR</span></h2>
                </div>
                <div class="close" id="close-btn">
                <span class="material-symbols-sharp">close</span>
                </div>
            </div>
            <div class="sidebar">
				<a href="technical_visit.php" class="side__link  active">
					<span class="material-symbols-sharp">grid_view</span>
					<h3>Dashboard</h3> 
				</a><a href="technicalVisit.php" class="side__link">
                    <span class="material-symbols-sharp">insights</span>
                    <h3>Technical Visit Registration</h3>
                </a>
                <a href="technicalVisit_Display.php" class="side__link">
                    <span class="material-symbols-sharp">mail_outline</span>
                    <h3>All Technical Visit Entries</h3>
                </a>
                <a href="mytechnicalVisit_Display.php">
                    <span class="material-symbols-sharp">inventory</span>
                    <h3>My Technical Visit Entries</h3>
                </a>
                <a href="#" class="side__link">
                    <span class="material-symbols-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
		<main>
			<h1>Technical Visit</h1>
			<div class="date">
				<input type="date">
			</div>
			<div class="insights">
				<div class="sales">
					<span class="material-symbols-sharp">analytics</span>
					<div class="middle">
						<div class="left">
							<h3>Total Sales</h3>
							<h1>$25,024</h1>
						</div>
						<div class="progress">
							<svg>
								<circle cx='38' cy='38' r='36'></circle>
							</svg>
							<div class="number">
								<p>81%</p>
							</div>
						</div>
					</div>
					<small class="text-muted">Last 24 hours</small>
				</div>

				<div class="expenses">
					<span class="material-symbols-sharp">bar_chart</span>
					<div class="middle">
						<div class="left">
							<h3>Total Expenses</h3>
							<h1>$14,160</h1>
						</div>
						<div class="progress">
							<svg>
								<circle cx='38' cy='38' r='36'></circle>
							</svg>
							<div class="number">
								<p>62%</p>
							</div>
						</div>
					</div>
					<small class="text-muted">Last 24 hours</small>
				</div>

				<div class="income">
					<span class="material-symbols-sharp">stacked_line_chart</span>
					<div class="middle">
						<div class="left">
							<h3>Total Income</h3>
							<h1>$10,864</h1>
						</div>
						<div class="progress">
							<svg>
								<circle cx='38' cy='38' r='36'></circle>
							</svg>
							<div class="number">
								<p>44%</p>
							</div>
						</div>
					</div>
					<small class="text-muted">Last 24 hours</small>
				</div>
			</div>
			<div class="recent-orders">
				<h2>Recent Orders</h2>
				<table>
					<thead>
						<tr>
							<th>Product Name</th>
							<th>Product Number</th>
							<th>Payment</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Foldable Mini Drone</td>
							<td>85631</td>
							<td>Due</td>
							<td class="warning">Pending</td>
							<td class="primary">Details</td>
						</tr>
						<tr>
							<td>Foldable Mini Drone</td>
							<td>85631</td>
							<td>Due</td>
							<td class="warning">Pending</td>
							<td class="primary">Details</td>
						</tr>
						<tr>
							<td>Foldable Mini Drone</td>
							<td>85631</td>
							<td>Due</td>
							<td class="warning">Pending</td>
							<td class="primary">Details</td>
						</tr>
						<tr>
							<td>Foldable Mini Drone</td>
							<td>85631</td>
							<td>Due</td>
							<td class="warning">Pending</td>
							<td class="primary">Details</td>
						</tr>
						<tr>
							<td>Foldable Mini Drone</td>
							<td>85631</td>
							<td>Due</td>
							<td class="warning">Pending</td>
							<td class="primary">Details</td>
						</tr>
					</tbody>
				</table>
				<a href="">Show All</a>
			</div>
		</main>
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
						<?php
							require_once("admin_connect.php");
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
			</div>
		</div>
    </div>
	<script src="Insurance.js"></script>
	<!--<script src="vehicleInsurancehtml2.js"></script>-->
</body>
</html>