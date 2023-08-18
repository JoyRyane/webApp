<?php
            if(isset($_POST["register"])){
                $Owner      = $_POST["Owner"];
				$Dealer     = $_POST["Dealer"];
				$Email      = $_POST["Email"];
                $carReg     = $_POST["carReg"];
				$Issuedate  = $_POST["Issuedate"];
				$Expirydate = $_POST["Expirydate"];
                $Notice     = $_POST["Notice"];

                $errors = array();
				if(empty($Owner)){
					array_push($errors,"Owner required!");
				}
				else if(empty($Dealer)){
					array_push($errors,"Dealer required!");
				}
				else if(empty($Email)){
					array_push($errors,"Email required!");
				}
                else if(empty($carReg)){
					array_push($errors, "<b>Car registration number required</b>");
				}
				else if(empty($Issuedate)){
					array_push($errors,"Issuedate required!");
				}
				else if(empty($Expirydate)){
					array_push($errors,"Expirydate required!");
				}
                else if(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
                    array_push($errors,"Invalid email");
                }
                else if(!preg_match("/(\b((AD)|(CE)|(EN)|(ES)|(LT)|(NO)|(NW)|(OU)|(SU)|(SW))[0-9]{3}[A-Z]{2}\b)|(\b((AD)|(CE)|(EN)|(ES)|(LT)|(NO)|(NW)|(OU)|(SU)|(SW))[0-9]{4}[A-Z]{1}\b)/",$carReg)){
                    array_push($errors,"Invalid Registration Number");
                }
                else if($Issuedate >= $Expirydate){
                    array_push($errors,"Invalid date");
                }
                
				require_once("admin_connect.php");
				if(!empty($Owner) AND !empty($Dealer) AND !empty($Email) AND !empty($carReg) AND !empty($Issuedate) AND !empty($Expirydate)){
					$sql = "SELECT * FROM technicalvisit WHERE carReg = '$carReg'";
					$result = mysqli_query($conn, $sql);
					$rowCount = mysqli_num_rows($result);
					if($rowCount > 0){
						array_push($errors, "<b>Car registration number already inputted</b>");
					}
				}
				
				if(count($errors)>0){
                    foreach ($errors as $error){
                        echo "$error";
                    }
                }else{
					if(!empty($Owner) AND !empty($Dealer) AND !empty($Email) AND !empty($carReg) AND !empty($Issuedate) AND !empty($Expirydate)){
							$sql = "INSERT INTO technicalvisit (Owner,Dealer,Email,carReg,Details,Issuedate,Expirydate) values(?,?,?,?,?,?,?)";
							$stmt = mysqli_stmt_init($conn);
							$prepare = mysqli_stmt_prepare($stmt,$sql);
							if($prepare){
								mysqli_stmt_bind_param($stmt,"sssssss",$Owner,$Dealer,$Email,$carReg,$Notice,$Issuedate,$Expirydate);
								mysqli_stmt_execute($stmt);
								echo "<div class = 'alert alert-success'>You have registered successfully</div>";
							}else{
								die("Something went wrong");
							}
					}
                }
            }
        ?>