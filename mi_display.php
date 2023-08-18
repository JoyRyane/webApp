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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href="mot_display.css" rel="stylesheet">
    <title>MI Register</title>
</head>
<body>
	<div class="wrapper">
		<div class="container">
        <button class="btn btn-primary my-5">
            <a href="merchandiseInsurance.php" class="text-light">Add user</a>
        </button>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Owner</th>
                <th scope="col">Dealer</th>
                <th scope="col">Email</th>
				<th scope="col">R\N</th>
                <th scope="col">Nature of luggage</th>
                <th scope="col">Detail</th>
				<th scope="col">Issuedate</th>
				<th scope="col">Expirydate</th>
                </tr>
            </thead>
            <tbody>
            <?php
                require_once "admin_connect.php";
                $query = "select * from luggageinsurance";
                $result = mysqli_query($conn,$query);
                if($result){
                    while($row=mysqli_fetch_assoc($result)){
                        $id = $row['id'];
                        $Owner = $row['Owner'];
						$Dealer = $row['Dealer'];
                        $Email = $row['Email'];
                        $carReg = $row['carReg'];
                        $Nature = $row['Nature'];
                        $Detail = $row['Detail'];
						$Issuedate = $row['Issuedate'];
						$Expirydate = $row['Expirydate'];
                        echo '
                        <tr>
                            <th scope="row">'.$id.'</th>
                            <td>'.$Owner.'</td>
                            <td>'.$Dealer.'</td>
                            <td>'.$Email.'</td>
							<td>'.$carReg.'</td>
                            <td>'.$Nature.'</td>
							<td>'.$Detail.'</td>
                            <td>'.$Issuedate.'</td>
                            <td>'.$Expirydate.'</td>
                            <td>
                                <button class="btn btn-primary"><a href="mi_update.php?updateid='.$id.'" class="text-light">Update</a></button>
                                <button class="btn btn-danger"><a href="mi_delete.php?deleteid='.$id.'" class="text-light">Delete</a></button>
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
</body>
</html>



