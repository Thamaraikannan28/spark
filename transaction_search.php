<?php
include'config1.php';
$output='';

if(isset($_POST['query'])){
	$search=$_POST['query'];
	$stmt=$connection->prepare("SELECT * FROM transfer WHERE name LIKE CONCAT('%',?,'%') OR email LIKE CONCAT('%',?,'%') OR amount LIKE CONCAT('%',?,'%') OR datetime LIKE CONCAT('%',?,'%')");
	$stmt->bind_param("ssss",$search,$search,$search,$search);
}
	else{
		$stmt=$connection->prepare("SELECT * FROM customers");
	}
	$stmt->execute();
	$result=$stmt->get_result();
	
	if($result->num_rows>0){
		$output ="<thead class='bg-primary'>
    <tr>
      <th scope='col'>ID</th>
      <th scope='col'>NAME</th>
      <th scope='col'>EMAIL</th>
	  <th scope='col'>TRANSFER TO & BALANCE</th>
	  <th scope='col'>TRANSFER AMOUNT</th>
	  <th scope='col'>DATE</th>
    </tr>
  </thead>
  <tbody>";
  while($row=$result->fetch_assoc()){
  $output .="<tr>
                            <td>".$row['id']."</td>                            
                            <td>".$row['name']."</td>                            
                            <td>".$row['email']."</td> 
							<td>".$row['transferto']."</td>	
                            <td>".$row['amount']."</td>
                            <td>".$row['datetime']."</td>													
                        </tr>";
              }
               $output .="</tbody>";
			   echo $output;
	}else{
		echo "<h3>NO TRANSACTIONS FOUND!</h3>";
	}
?>