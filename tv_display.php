<?php
    session_start();
    if(!isset($_SESSION["role3"])){
        header("location:registration_login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href="tv_display.css" rel="stylesheet">
    <link rel="stylesheet" href="tv_display2.css">
    <title>TV Register</title>
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
                <a href="tv_display.php">View Register</a>
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

	<div class="wrapper">
		<div class="container">
        <button class="btn btn-primary my-5">
            <a href="technicalVisit.php" class="text-light">Add user</a>
        </button>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Owner</th>
                <th scope="col">Dealer</th>
                <th scope="col">Email</th>
				<th scope="col">R\N</th>
                <th scope="col">Details</th>
				<th scope="col">Issuedate</th>
				<th scope="col">Expirydate</th>
                </tr>
            </thead>
            <tbody>
            <?php
                require_once "admin_connect.php";
                $query = "select * from technicalvisit";
                $result = mysqli_query($conn,$query);
                if($result){
                    while($row=mysqli_fetch_assoc($result)){
                        $id = $row['id'];
                        $Owner = $row['Owner'];
						$Dealer = $row['Dealer'];
                        $Email = $row['Email'];
                        $carReg = $row['carReg'];
                        $details = $row['Details'];
						$Issuedate = $row['Issuedate'];
						$Expirydate = $row['Expirydate'];
                        echo '
                        <tr>
                            <th scope="row">'.$id.'</th>
                            <td>'.$Owner.'</td>
                            <td>'.$Dealer.'</td>
                            <td>'.$Email.'</td>
							<td>'.$carReg.'</td>
                            <td>'.$details.'</td>
                            <td>'.$Issuedate.'</td>
                            <td>'.$Expirydate.'</td>
                            <td>
                                <button class="btn btn-primary"><a href="tv_update.php?updateid='.$id.'" class="text-light">Update</a></button>
                                <button class="btn btn-danger" id="btnDanger"><a href="tv_delete.php?deleteid='.$id.'" class="text-light">Delete</a></button>
                            </td>
                        </tr>
                        ';
                    }
                }
            ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript" src="technicalVisit.js"></script>
</body>

</html>



