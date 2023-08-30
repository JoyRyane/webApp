<?php
    require_once 'admin_connect.php';
    if(!isset($_POST['submit']))
    {
        $query = "select * from vehicleinsurance where Dealer = '$name'";
        if($query != null)
        {
            $result = mysqli_query($conn,$query);
            if($result){
                if(mysqli_num_rows($result)>0){
                    echo '
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Owner</th>
                        <th scope="col">R\N</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>';

                    while($record=mysqli_fetch_assoc($result))
                    {
                        $id = $record['id'];
                        $Owner = $record['Owner'];
                        $carReg = $record['carReg'];
                        echo '
                            <tr>
                                <th scope="row">'.$id.'</th>
                                <td>'.$Owner.'</td>
                                <td>'.$carReg.'</td>
                                <td>
                                    <button class="btn-success"><a href="vehicleInsurance_show.php?showid='.$id.'" class="text-light">Details</a></button>
                                    <button class="btn-primary"><a href="vehicleInsurance_update.php?updateid='.$id.'">Update</a></button>
                                    <button class="btn-danger"><a href="vehicleInsurance_delete.php?deleteid='.$id.'" class="text-light">Delete</a></button>
                                </td>
                            </tr>
                        ';
                    }
                }
            }
            else{
                echo "NO DATA FOUND!";
            }
        }

    }

    if(isset($_POST['submit'])){
        $search = $_POST['searchRequest'];

        $sql = "SELECT * FROM vehicleinsurance WHERE Dealer = '$name' AND carReg LIKE '%$search%' or Owner LIKE '%$search%'";
        $query = mysqli_query($conn,$sql);
        if($query){
            if(mysqli_num_rows($query)>0){
                echo '
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Owner</th>
                    <th scope="col">R\N</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>';
                while($field = mysqli_fetch_assoc($query)){
                    $id 	= $field['id'];
                    $Owner  = $field['Owner'];
                    $carReg = $field['carReg'];
                    echo '
                    <tbody>
                        <tr>
                            <th scope="row">'.$id.'</th>
                            <td>'.$Owner.'</td>
                            <td>'.$carReg.'</td>
                            <td>
                                <button class="btn-success"><a href="vehicleInsurance_show.php?showid='.$id.'" class="text-light">Details</a></button>
                                <button class="btn-primary"><a href="vehicleInsurance_update.php?updateid='.$id.'">Update</a></button>
                                <button class="btn-danger"><a href="vehicleInsurance_delete.php?deleteid='.$id.'" class="text-light">Delete</a></button>
                            </td>
                        </tr>
                    </tbody>';
                }
            }else{
                echo "DATA NOT FOUND!";
            }
        }
    }
    
?>
