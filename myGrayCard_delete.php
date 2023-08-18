<?php
    require_once "admin_connect.php";
    if(isset($_GET['deleteid'])){
        $id=$_GET['deleteid'];

        $sql = "delete from ministryoftransport where id = $id";
        $result = mysqli_query($conn,$sql);
        if($result){
            header('location:myGrayCard_Display.php');
        }
        else{
            die("mysqli_error($conn)");
        }
    }
?>