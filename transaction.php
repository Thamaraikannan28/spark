<?php
include("config1.php");
$cname = '';
$query = "SELECT * FROM customers";
$result = mysqli_query($connection, $query);
while($row = mysqli_fetch_array($result))
{
 $cname .= '<option value="'.$row["name"].'">'.$row["name"].'</option>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>New Transaction</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	</head>
	<body>

<!-- Edit Modal -->
<div class="modal fade" id="editmodal" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Make Transaction</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	   <form action="transfer_amount.php" method="POST">
                <div class="modal-body">
				<input type="hidden" name="update_id" id="update_id">
				<input type="hidden" name="name" id="name">
				<input type="hidden" name="email" id="email">
				<input type="hidden" name="amount" id="amount">
				<div class="form-row">
					<label for="customername">Customer Name<span class="requiredIcon">*</span></label>
					<select name="customername" id="customername" class="form-control" onchange="GetDetail(this.value)"required>
			        <option value="">Select Customer</option>
			        <?php echo $cname; ?>
			        </select>
				</div>
				<div class="form-row">
				    <div class="form-group col-md-6">
					  <label for="cusname">Transfer TO<span class="requiredIcon">*</span></label>
					  <input type="text" class="form-control"  name="cusname" id="cusname" required>
				    </div>
        		</div>
				<div class="form-row">
				    <div class="form-group col-md-6">
					  <label for="bamount">Balance Amount<span class="requiredIcon">*</span></label>
					  <input type="text" class="form-control"  name="bamount" id="bamount" required>
				    </div>
        		</div>
				<div class="form-row">
				    <div class="form-group col-md-6">
					  <label for="tamount">Transfer Amount<span class="requiredIcon">*</span></label>
					  <input type="text" class="form-control"  name="tamount" id="tamount" required>
				    </div>
        		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="transfer" id="transfer" class="btn btn-primary">Transfer</button>
      </div>
	  </form>
    </div>
  </div>
</div>
	
	<!-- #################################################################################################### -->
	
  <div class="container">
   <div class="jumbotron">
	<div class="card">
	  <div class="card-body">
	    <h1>New Transaction</h1>
		</div>
	  </div>
    </div>
  </div>
  <div class="form-inline pb-3">
  &nbsp&nbsp&nbsp&nbsp&nbsp;<label for="search" class="font-weight-bold lead text-dark">
  Search Products</label>&nbsp&nbsp&nbsp&nbsp&nbsp;
  <input type="text" class="form-control form-control-lg rounded-0 border-primary" name="search" id="search_text" placeholder="Search">
  </div>
  <?php
     include('config1.php');
	 $stmt =$connection->prepare("SELECT * FROM customers");
	 $stmt->execute();
	 $result=$stmt->get_result();
	?>
  <div class="card">
	  <div class="card-body">
	  <?php
     require_once('config1.php');
	 $query = "SELECT * FROM customers";
     $query_run = mysqli_query($connection, $query);
	?>
          <table id="table-data" class="table table-dark">
  <thead class="bg-primary">
    <tr>
	 <th scope="col">ID</th>
      <th scope="col">CUSTOMER NAME</th>
      <th scope="col">EMAIL</th>
	  <th scope="col">BALANCE</th>
	  <th scope="col">TRANSACTION</th>
    </tr>
  </thead>
  <?php

                if($query_run)
                {
                    foreach($query_run as $row)
                    {
            ?>
                    <tbody>
                        <tr>
						    <td> <?php echo $row['id']; ?> </td>      
                            <td> <?php echo $row['name']; ?> </td>                            
                            <td> <?php echo $row['email']; ?> </td>                            
                            <td> <?php echo $row['balance']; ?> </td> 
                            <td>
							<button type="button" class="btn btn-success editbtn"> TRANSACTION </button>
							</td>					
                        </tr>
                    </tbody>
  
            <?php           
                    }
                }
                else 
                {
                    echo "No Record Found";
                }
            ?>
</table>
        </div>
	  </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>


<script type="text/javascript">
$(document).ready(function () {
$("#search_text").keyup(function (){
	var search = $(this).val();
	$.ajax({
		url:'customer_search.php',
		method: 'post',
		data:{query:search},
		success:function(response){
			$("#table-data").html(response);
		}
	});
});
});
</script>

<script>
$(document).ready(function () {
    $('.editbtn').on('click', function() {
        
        $('#editmodal').modal('show');

        
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);
			
			$('#update_id').val(data[0]);
			$('#name').val(data[1]);
			$('#email').val(data[2]);
			$('#amount').val(data[3]);
    });
});
</script>

<script>
function GetDetail(str){
  if(str.length == 0){
	  document.getElementById("cusname").value = "";
	  document.getElementById("bamount").value = "";
	  return;
  }
  else{
	  var xmlhttp = new XMLHttpRequest();
	  xmlhttp.onreadystatechange = function() {
		  if(this.readyState == 4 && this.status ==  200){
			  var myObj = JSON.parse(this.responseText);
			  document.getElementById("bamount").value = myObj[0];
			  document.getElementById("cusname").value = myObj[1];
		  }
	  };
	  xmlhttp.open("GET","customer_transaction_search.php?customername=" + str, true);
	  xmlhttp.send();
  }
}
</script>

 </body>
 </html>