<?php
		require_once 'admin_connect.php';
			$id=$_GET['showid'];
			$sql="select * from vehicleinsurance where id=$id";
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($result);
			$Owner		=$row['Owner'];
			$Dealer		=$row['Dealer'];
			$Email  	=$row['Email'];
			$carReg 	=$row['carReg'];
			$Notice  	=$row['Notice'];
			$Issuedate	=$row['Issuedate'];
			$Expirydate	=$row['Expirydate'];
	?>