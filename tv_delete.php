<?php
    require_once "admin_connect.php";
    if(isset($_GET['deleteid'])){
        $id=$_GET['deleteid'];

        $sql = "delete from technicalvisit where id = $id";
        $result = mysqli_query($conn,$sql);
        if($result){
            header('location:tv_display.php');
        }
        else{
            die("mysqli_error($conn)");
        }
    }
?>