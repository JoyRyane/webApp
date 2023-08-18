<?php
	require_once("admin_connect.php");
	$ownerErr = $dealerErr = $emailErr = $carRegErr = $issueDateErr = $expiryDateErr = $dateErr = $countErr = $carRegError = $success = "";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST["update"])){
			$id         = $_POST["id"];
			$Owner      = $_POST["Owner"];
			$Dealer     = $_POST["Dealer"];
			$Email      = $_POST["Email"];
			$carReg     = $_POST["carReg"];
			$Issuedate  = $_POST["Issuedate"];
			$Expirydate = $_POST["Expirydate"];
	
			$errors = array();
				
					if(empty($Owner)){
						$ownerErr = "Owner required";
					}
					else if(empty($Email)){
						$emailErr = "Email required";
					}
					else if(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
						$emailErr = "Invalid Email";
					}
					else if(empty($carReg)){
						$carRegErr = "Car registration number required";
					}
					else if(!preg_match("/(\b((AD)|(CE)|(EN)|(ES)|(LT)|(NO)|(NW)|(OU)|(SU)|(SW))[0-9]{3}[A-Z]{2}\b)|(\b((AD)|(CE)|(EN)|(ES)|(LT)|(NO)|(NW)|(OU)|(SU)|(SW))[0-9]{4}[A-Z]{1}\b)/",$carReg)){
						$carRegErr = "Invalid Registration Number";
					}
					else if(empty($Issuedate)){
						$issueDateErr = "Date issued required";
					}
					else if(empty($Expirydate)){
						$expiryDateErr = "Date expiry required";
					}
					else if($Issuedate >= $Expirydate){
						$dateErr = "Invalid dates";
					}
	
	
					/*$sql_query = "SELECT * FROM ministryoftransport WHERE NOT id=$id";
					$query_result = mysqli_query($conn, $sql_query);
					$rowCount = mysqli_num_rows($query_result);
					echo $rowCount;
					if($rowCount > 0){
						echo "Car registration number already inputted";
					}*/
					/*if(!empty($Owner) AND !empty($Dealer) AND !empty($Email) AND !empty($carReg) AND !empty($Nature) AND !empty($Issuedate) AND !empty($Expirydate)){
					$sql = "SELECT * FROM luggageinsurance WHERE carReg = '$carReg'";
					$result = mysqli_query($conn, $sql);
					$rowCount = mysqli_num_rows($result);
					if($rowCount > 0){
						array_push($errors, "<b>Car registration number already inputted</b>");
					}
				}*/
					if(!empty($Owner) AND !empty($Dealer) AND !empty($Email) AND !empty($carReg) AND !empty($Issuedate) AND !empty($Expirydate))
					{
						$sql = "UPDATE `ministryoftransport` SET `id`= $id, Owner = '$Owner', Dealer = '$Dealer', Email = '$Email', carReg = '$carReg', Issuedate = '$Issuedate', Expirydate = '$Expirydate' WHERE id=$id";
						$query = mysqli_query($conn,$sql);
						if($query){
							$success = "Updated Successfully";
						}else{
							die("Something went wrong");
						}
					}
					
					
			}
	}
?>