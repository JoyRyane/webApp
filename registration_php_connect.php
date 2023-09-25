<?php
	$nameErr = $emailErr = $carRegErr = $natureErr = $issueDateErr = $expiryDateErr = $dateErr = $countErr = $carRegError = $success = "";
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST["register"])){
			require_once "admin_connect.php";
			
			$Name = $_POST["Name"];
			$Email = $_POST["Email"];
			$Role = $_POST["Role"];
			$Password = $_POST["Password"];
			$Repeat_Password = $_POST["Repeat_Password"];
			$Image = $_FILES['image'];
			$img_loc = $_FILES['image']['tmp_name'];
			$img_name = $_FILES['image']['name'];
			$imageFileType = $_FILES['image']['type'];
			$img_des = "uploads/".$img_name;
			move_uploaded_file($img_loc,'uploads/'.$img_name);

            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpg", "png" => "image/png");
			$Password_hash = password_hash($Password, PASSWORD_DEFAULT);
			$errors = array();
						
						if(empty($Name)){
							$nameErr = "Name required";
							array_push($errors, "<b>Name required</b>");
						}
						else if(empty($Email)){
							array_push($errors, "<b>Email required</b>");
						}
						else if($Role == 'Pending'){
							array_push($errors, "<b>Role required</b>");
						}
						else if(empty($Password)){
							array_push($errors, "<b>Password required</b>");
						}
						else if(empty($Repeat_Password)){
							array_push($errors, "<b>Confirm your Password</b>"); 
						}
						else if(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
							array_push($errors, "<b>Invalid Email</b>");
						}
						else if(strlen($Password)<8){
							array_push($errors, "\n<b>Password must be 8 characters long</b>");
						}
						else if($Password != $Repeat_Password){
							array_push($errors, "\n<b>Password does not match</b>");
						}
						else if(!preg_match("/[A-Z]/",$Password) ||!preg_match("/[a-z]/",$Password)||!preg_match("/[0-9]/",$Password)
							||!preg_match("/[^\w]/", $Password)){
								array_push($errors,"<b>Password must include atleast one uppercase letter, one lowercase letter, one number and a special character</b>");
						}
						
			

			if(!empty($Name) AND !empty($Email) AND !empty($Password) AND !empty($Repeat_Password) AND $Role!='Pending'){
				$sql = "SELECT * FROM admin WHERE Email = '$Email'";
				$result = mysqli_query($conn, $sql);
				$rowCount = mysqli_num_rows($result);
				if($rowCount > 0){
					array_push($errors, "<b>Email already exists</b>");
				}
			}


            $ext = pathinfo($img_name, PATHINFO_EXTENSION);
            
            if(!array_key_exists($ext,$allowed)){
                array_push($errors,"Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            }

			/*if(count($errors)>0){
				foreach($errors as $error){
					echo "<div class='alert alert-danger'>$error</div>";
				}
			}*/
            if(!isset($_POST["check"])){
                array_push($errors,"You must agree to the terms and conditions to register!");
				//echo "<b>You must agree to the terms and conditions to register!</b>";
			}
			
			if(isset($_POST["check"])){
				if(!empty($Name) AND !empty($Email) AND !empty($Password) AND !empty($Repeat_Password) AND $Role != 'Pending' AND count($errors)==0){
				
				$sql = "INSERT INTO admin(Name, Email, Role, Password, image_url)values( ?, ?, ?, ?, ?)";
				$stmt = mysqli_stmt_init($conn);
				$prepare = mysqli_stmt_prepare($stmt,$sql);
				if($prepare){
					mysqli_stmt_bind_param($stmt,"sssss", $Name, $Email, $Role, $Password_hash, $img_des);
					mysqli_stmt_execute($stmt);
					
				$sql = "SELECT * FROM admin WHERE Email = '$Email'";
				$result = mysqli_query($conn, $sql);
				$user = mysqli_fetch_array($result , MYSQLI_ASSOC);
				if($user){
					session_start();
					$_SESSION['Email'] = $Email;
					$_SESSION["role"]="IC";
					$_SESSION["role"]="MOT";
					$_SESSION["role"]="TV";
					if($user["Role"] == 'Insurance Company'){
						if(isset($_SESSION["role1"])){
							header("location:Insurance.php");
							die();
						}
						}else if($user["Role"] == 'Ministry of Transport'){
							if(isset($_SESSION["role2"])){
								header("location:ministry_of_transport.php");
								die();
							}
						}else if($user["Role"] == 'Technical Visit'){
							if(isset($_SESSION["role3"])){
								header("location:technical_visit.php");
								die();
							}  
						}
				}
					}else{
						die("Something went wrong!");
					}
				}
			}
			
		}
	}
?>