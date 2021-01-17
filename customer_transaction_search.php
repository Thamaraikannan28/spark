<?php
include("config1.php");
$cname=$_REQUEST['customername'];
if($cname!==""){
	$query =mysqli_query($connection,"SELECT * FROM customers WHERE name = '$cname'");
	$row = mysqli_fetch_array($query);
	$amount = $row["balance"];
}
$result = array("$amount","$cname");
$myJSON = json_encode($result);
echo $myJSON;
?>