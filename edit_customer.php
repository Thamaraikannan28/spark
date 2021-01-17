<?php
require_once('config1.php');
?>
<?php
    if(isset($_POST['editcustomer']))
    {   
        $id = $_POST['update_id'];
        $name = $_POST['cname'];
		$n = trim($name);
        $email = $_POST['cemail'];
		$e = trim($email);
		$balance = $_POST['camount'];
		$b = trim($balance);

        $query = "UPDATE customers SET name='$n', email='$e', balance='$b' WHERE id='$id'  ";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:customer.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>