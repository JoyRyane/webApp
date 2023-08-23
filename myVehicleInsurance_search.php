<?php
                
    $query = "select * from vehicleinsurance where Dealer = '$name'";
    $result = mysqli_query($conn,$query);
    if($result){
        while($record=mysqli_fetch_assoc($result)){
            $id = $record['id'];
            $Owner = $record['Owner'];
			$carReg = $record['carReg'];
            echo '
                <tr>
                    <th scope="row">'.$id.'</th>
                    <td>'.$Owner.'</td>
					<td>'.$carReg.'</td>
                    <td>
						<button class="btn-success"><a href="vehicleInsurance_show.php?showid='.$id.'" class="text-light">Show</a></button>
						<button class="btn-primary"><a href="vehicleInsurance_update.php?updateid='.$id.'">Update</a></button>
						<button class="btn-danger"><a href="vehicleInsurance_delete.php?deleteid='.$id.'" class="text-light">Delete</a></button>
                    </td>
                </tr>
                ';
        }
    }
?>