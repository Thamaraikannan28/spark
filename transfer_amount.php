<?php
include('config1.php');
 if(isset($_POST['transfer']))
 {
    $id     = $_POST['update_id'];
	$str 		= $_POST['name'];
	$n = trim($str);
	$email 	= $_POST['email'];
	$e = trim($email);
	$cbalance = $_POST['amount'];
	$balance 	= $_POST['bamount'];
	$amount  = $_POST['tamount'];
	$transferto  = $_POST['cusname'];
	$a = $balance + $amount;
	$b = $cbalance - $amount;
	$c = $b >= 0;
	
	
    $query = "UPDATE customers SET balance='$a' WHERE name='$transferto'";
	$query1 = "UPDATE customers SET balance='$b' WHERE name='$n'";

    
	if($cbalance > 0 && $amount > 0 && $c)
        {
	    $query_run = mysqli_query($connection, $query);
		$query_run1 = mysqli_query($connection, $query1);
include('config.php');
	if($cbalance > 0 && $amount > 0 && $c){
		$sql = "INSERT INTO transfer (name, email, transferto, amount) VALUES(?,?,?,?)";
		$stmtinsert = $db->prepare($sql);
		$result = $stmtinsert->execute([$n, $e, $transferto, $amount]);
}
            echo '<script> alert("Money Transfered Successfully!!!"); </script>';
			header("Location:transaction.php");
        }
		elseif($amount < 0){
			echo '<script> alert("The Transfer Money Cannot Be 0 or less than 0!!!"); </script>';
	}
        else
        {
            echo '<script> alert("Money Not Transfered.Please Check Your Balance and try again!!!"); </script>';
        }
 }
 ?>
