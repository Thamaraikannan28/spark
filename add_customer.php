<?php
require_once('config.php');
?>
<?php

if(isset($_POST['addcustomer'])){

	$name 		= $_POST['name'];
	$email 	= $_POST['email'];
	$balance 	= $_POST['amount'];

		$sql = "INSERT INTO customers (name, email, balance) VALUES(?,?,?)";
		$stmtinsert = $db->prepare($sql);
		$result = $stmtinsert->execute([$name, $email, $balance]);
		if($result){
			echo"<script>swal({
  title: 'Success',
  text: 'Customer has been added Successfully!',
  icon: 'success',
  button: 'ok',
});</script>";
 header("Location:customer.php");
/* header("Refresh:0"); 
 */		}
		else{
			echo 'There were erros while saving the data.';
		} 
}
?>