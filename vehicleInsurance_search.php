<?php
    require_once "admin_connect.php";
						
    if(!isset($_POST['submit'])){
        $query = "SELECT * FROM vehicleinsurance";
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
                while($row=mysqli_fetch_assoc($result)){
                    $id = $row['id'];
                    $Owner = $row['Owner'];
                    $carReg = $row['carReg'];
                    echo '
                    <tbody>
                        <tr>
                            <th scope="row">'.$id.'</th>
                            <td>'.$Owner.'</td>
                            <td>'.$carReg.'</td>
                            <td>
                                <button class="btn-success"><a href="vehicleInsurance_show.php?showid='.$id.'" class="text-light">Details</a></button>
                            </td>
                        </tr>
                    </tbody>';

                }
            }else{
                echo 'DATA NOT FOUND!';
            }
        }
    }
    
    if(isset($_POST['submit'])){
        $search = $_POST['searchRequest'];

        $sql = "SELECT * FROM vehicleinsurance WHERE carReg LIKE '%$search%' or Owner LIKE '%$search%' or
        Dealer LIKE '%$search%' ";
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