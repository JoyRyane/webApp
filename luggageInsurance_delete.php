<?php
    require_once "admin_connect.php";
    if(isset($_GET['deleteid'])){
        $id=$_GET['deleteid'];

        $sql = "delete from luggageinsurance where id = $id";
        $result = mysqli_query($conn,$sql);
        if($result){
            header('location:myLuggageInsuranceDisplay.php');
        }
        else{
            die("mysqli_error($conn)");
        }
    }
?>