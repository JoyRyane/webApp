<?php
	$ownerErr = $dealerErr = $emailErr = $carRegErr = $issueDateErr = $expiryDateErr = $dateErr = $countErr = $carRegError = $success = "";
	
		if($_SERVER["REQUEST_METHOD"] == "POST"){

			if(isset($_POST["register"])){
                $Owner = $_POST["Owner"];
				$Dealer = $_POST["Dealer"];
				$Email = $_POST["Email"];
                $carReg = $_POST["carReg"];
				$Issuedate = $_POST["Issuedate"];
				$Expirydate = $_POST["Expirydate"];

				$errors = array();
				if(empty($Owner)){
					$ownerErr = "Owner required";
					array_push($errors, "Owner required");
				}
				if(empty($Email)){
					$emailErr = "Email required";
					array_push($errors, "Email required");
				}
				
                if(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
                    $emailErr = "Invalid Email";
					array_push($errors, "Invalid Email");
                }
				if(empty($carReg)){
					$carRegErr = "Car registration number required";
					array_push($errors, "Car registration number required");
				}
				if(!preg_match("/(\b((AD)|(CE)|(EN)|(ES)|(LT)|(NO)|(NW)|(OU)|(SU)|(SW))[0-9]{3}[A-Z]{2}\b)|(\b((AD)|(CE)|(EN)|(ES)|(LT)|(NO)|(NW)|(OU)|(SU)|(SW))[0-9]{4}[A-Z]{1}\b)/",$carReg)){
					$carRegErr = "Invalid Registration Number";
					array_push($errors, "Invalid Car registration Number");
                }
				if(empty($Issuedate)){
					$issueDateErr = "Date issued required";
					array_push($errors, "Date issued required");
				}
				if(empty($Expirydate)){
					$expiryDateErr = "Expiry date required";
					array_push($errors, "Expiry date required");
				}
                if($Issuedate >= $Expirydate){
                    $dateErr = "Invalid dates";
					array_push($errors, "Invalid dates");
                }
                
				require_once("admin_connect.php");
				if(!empty($Owner) AND !empty($Dealer) AND !empty($Email) AND !empty($carReg) AND !empty($Issuedate) AND !empty($Expirydate)){
					$sql = "SELECT * FROM ministryoftransport WHERE carReg = '$carReg'";
					$result = mysqli_query($conn, $sql);
					$rowCount = mysqli_num_rows($result);
					if($rowCount > 0){
						$countErr = "Car registration number already inputted";
						array_push($errors, "Car registration number already inputted");
					}
				}
				if(!empty($Owner) AND !empty($Dealer) AND !empty($Email) AND !empty($carReg) AND !empty($Issuedate) AND !empty($Expirydate) AND count($errors)==0){
					$sql = "INSERT INTO ministryoftransport (Owner,Dealer,Email,carReg,Issuedate,Expirydate) values(?,?,?,?,?,?)";
					$stmt = mysqli_stmt_init($conn);
					$prepare = mysqli_stmt_prepare($stmt,$sql);
				if($prepare){
					mysqli_stmt_bind_param($stmt,"ssssss",$Owner,$Dealer,$Email,$carReg,$Issuedate,$Expirydate);
					mysqli_stmt_execute($stmt);
					$success = "You have registered successfully";
				}else{
					die("Something went wrong");
				}
			}
        }
	}
?>