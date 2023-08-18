<?php
	require_once("admin_connect.php");
	if(isset($_POST["update"])){
		$id         = $_POST["id"];
		$Owner      = $_POST["Owner"];
		$Dealer     = $_POST["Dealer"];
		$Email      = $_POST["Email"];
		$carReg     = $_POST["carReg"];
		$Notice 	= $_POST["Notice"];
		$Issuedate  = $_POST["Issuedate"];
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
					 $emailError = "Invalid email";
					 echo $emailError;
				}
				else if(!preg_match("/(\b((AD)|(CE)|(EN)|(ES)|(LT)|(NO)|(NW)|(OU)|(SU)|(SW))[0-9]{3}[A-Z]{2}\b)|(\b((AD)|(CE)|(EN)|(ES)|(LT)|(NO)|(NW)|(OU)|(SU)|(SW))[0-9]{4}[A-Z]{1}\b)/",$carReg)){
					array_push($errors,"Invalid Registration Number");
				}
				else if($Issuedate >= $Expirydate){
					array_push($errors,"Invalid date");
				}
			
			/*if(!empty($Owner) AND !empty($Dealer) AND !empty($Email) AND !empty($carReg) AND !empty($Nature) AND !empty($Issuedate) AND !empty($Expirydate)){
				$sql = "SELECT * FROM luggageinsurance WHERE carReg = '$carReg'";
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
				if(!empty($Owner) AND !empty($Dealer) AND !empty($Email) AND !empty($carReg) AND !empty($Issuedate) AND !empty($Expirydate))
				{
					$sql = "UPDATE `technicalvisit` SET `id`= $id, Owner = '$Owner', Dealer = '$Dealer', Email = '$Email', carReg = '$carReg',Details = '$Notice', Issuedate = '$Issuedate', Expirydate = '$Expirydate' WHERE id=$id";
					$query = mysqli_query($conn,$sql);
					if($query){
						echo "Updated Successfully";
					}else{
						die("Something went wrong");
					}
				}
				
				
			}
		}
?>