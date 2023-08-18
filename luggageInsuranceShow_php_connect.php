<?php
		require_once 'admin_connect.php';
		$id=$_GET['showid'];
		$sql="select * from luggageinsurance where id=$id";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($result);
		$Owner		=$row['Owner'];
		$Dealer		=$row['Dealer'];
		$Email  	=$row['Email'];
		$carReg 	=$row['carReg'];
        $Nature  	=$row['Nature'];
		$Detail 	=$row['Detail'];
		$Issuedate	=$row['Issuedate'];
		$Expirydate	=$row['Expirydate'];
	?>