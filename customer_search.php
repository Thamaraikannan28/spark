<?php
include'config1.php';
$output='';

if(isset($_POST['query'])){
	$search=$_POST['query'];
	$stmt=$connection->prepare("SELECT * FROM customers WHERE name LIKE CONCAT('%',?,'%') OR email LIKE CONCAT('%',?,'%') OR id LIKE CONCAT('%',?,'%')");
	$stmt->bind_param("sss",$search,$search,$search);
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
      <th scope='col'>CUSTOMER NAME</th>
      <th scope='col'>EMAIL</th>
	  <th scope='col'>BALANCE</th>
	  <th scope='col'>EDIT</th>
	  <th scope='col'>DELETE</th>
    </tr>
  </thead>
  <tbody>";
  while($row=$result->fetch_assoc()){
  $output .="<tr>
                            <td>".$row['id']."</td>                            
                            <td>".$row['name']."</td>                            
                            <td>".$row['email']."</td> 
							<td>".$row['balance']."</td> 
                            <td>
							<button type='button' class='btn btn-success editbtn'> EDIT </button>
							</td>
                            <td>
                                <button type='button'class='btn btn-danger deletebtn'> DELETE </button>
                            </td>							
                        </tr>";
              }
               $output .="</tbody>";
			   echo $output;
	}else{
		echo "<h3>NO PRODUCTS FOUND!</h3>";
	}
?>