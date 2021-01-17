<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>View Customers</title>
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
	

<!-- Modal -->
<div class="modal fade" id="addproductmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Add Customers</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	   <form action="add_customer.php" method="POST">
                <div class="modal-body">
							  <div class="form-row">
								  <div class="form-group col-md-6">
									<label for="name">Name<span class="requiredIcon">*</span></label>
									<input type="text" class="form-control" name="name" id="name" required>
								  </div>
							  </div>
							  <div class="form-row">
								<div class="form-group col-md-6">
									<label for="email">Email<span class="requiredIcon">*</span></label>
									<input type="text" class="form-control" name="email" id="email" required>
								  </div>
							  </div>
							   <div class="form-row">
								<div class="form-group col-md-6">
								  <label for="amount">Amount<span class="requiredIcon">*</span></label>
								  <input type="text" class="form-control"  name="amount" id="amount" required>
								</div>
							  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="addcustomer" id="addcustomer" class="btn btn-primary">Add Customer</button>
      </div>
	  </form>
    </div>
  </div>
</div>

<!-- #################################################################################################### -->

<!-- Edit Modal -->
<div class="modal fade" id="editmodal" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Edit Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	   <form action="edit_customer.php" method="POST">
                <div class="modal-body">
				<input type="hidden" name="update_id" id="update_id">
							  <div class="form-row">
								  <div class="form-group col-md-6">
									<label for="cname">Name<span class="requiredIcon">*</span></label>
									<input type="text" class="form-control" name="cname" id="cname" required>
								  </div>
							  </div>
							  <div class="form-row">
								<div class="form-group col-md-6">
									<label for="cemail">Email<span class="requiredIcon">*</span></label>
									<input type="text" class="form-control" name="cemail" id="cemail" required>
								  </div>
							  </div>
							   <div class="form-row">
								<div class="form-group col-md-6">
								  <label for="camount">Amount<span class="requiredIcon">*</span></label>
								  <input type="text" class="form-control"  name="camount" id="camount" required>
								</div>
							  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="editcustomer" id="editcustomer" class="btn btn-primary">Update</button>
      </div>
	  </form>
    </div>
  </div>
</div>
	
	<!-- #################################################################################################### -->

	
<!-- DELETE POP UP FORM (Bootstrap MODAL) -->

<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Delete Customer </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <form action="delete_customer.php" method="POST">

            <div class="modal-body">

                <input type="hidden" name="delete_id" id="delete_id">

                <h4> Do you want to Delete this Customer ??</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">  NO </button>
                <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
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
	     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addproductmodal">
          Add Customer
         </button>
		</div>
	  </div>
    </div>
  </div>
  <div class="form-inline pb-3">
  &nbsp&nbsp&nbsp&nbsp&nbsp;<label for="search" class="font-weight-bold lead text-dark">
  Search Customers</label>&nbsp&nbsp&nbsp&nbsp&nbsp;
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
	  <th scope="col">EDIT</th>
	  <th scope="col">DELETE</th>
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
							<button type="button" class="btn btn-success editbtn"> EDIT </button>
							</td>
                            <td>
                                <button type="button" class="btn btn-danger deletebtn"> DELETE </button>
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
            $('#cname').val(data[1]);
            $('#cemail').val(data[2]);
			$('#camount').val(data[3]);
    });
});

</script>

<script>

$(document).ready(function () {
    $('.deletebtn').on('click', function() {
        
        $('#deletemodal').modal('show');

        
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#delete_id').val(data[0]);
    });
});

</script>

 </body>
 </html>