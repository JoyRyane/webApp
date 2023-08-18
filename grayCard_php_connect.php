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
                
				require_once("admin_connect.php");
				if(!empty($Owner) AND !empty($Dealer) AND !empty($Email) AND !empty($carReg) AND !empty($Issuedate) AND !empty($Expirydate)){
					$sql = "SELECT * FROM ministryoftransport WHERE carReg = '$carReg'";
					$result = mysqli_query($conn, $sql);
					$rowCount = mysqli_num_rows($result);
					if($rowCount > 0){
						$countErr = "Car registration number already inputted";
					}
				}
				
				/*if(count($errors)>0){
                    foreach ($errors as $error){
                        echo "<div class='input'>$error</div>";
                    }
                }if{*/
					if(!empty($Owner) AND !empty($Dealer) AND !empty($Email) AND !empty($carReg) AND !empty($Issuedate) AND !empty($Expirydate)){
							$sql = "INSERT INTO ministryoftransport (Owner,Dealer,Email,carReg,Issuedate,Expirydate) values(?,?,?,?,?,?)";
							$stmt = mysqli_stmt_init($conn);
							$prepare = mysqli_stmt_prepare($stmt,$sql);
							if($prepare){
								mysqli_stmt_bind_param($stmt,"ssssss",$Owner,$Dealer,$Email,$carReg,$Issuedate,$Expirydate);
								mysqli_stmt_execute($stmt);
								//echo "<div class = 'alert alert-success'>You have registered successfully</div>";
								$success = "You have registered successfully";
							}else{
								die("Something went wrong");
							}
					}
                }
           // }
		}
    ?>