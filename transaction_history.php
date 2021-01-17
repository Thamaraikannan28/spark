<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Transaction History</title>
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

	<!-- #################################################################################################### -->
	
  <div class="container">
   <div class="jumbotron">
	<div class="card">
	  <div class="card-body">
	    <h1>Transaction History</h1>
		</div>
	  </div>
    </div>
  </div>
  <div class="form-inline pb-3">
  &nbsp&nbsp&nbsp&nbsp&nbsp;<label for="search" class="font-weight-bold lead text-dark">
  Search Transactions</label>&nbsp&nbsp&nbsp&nbsp&nbsp;
  <input type="text" class="form-control form-control-lg rounded-0 border-primary" name="search" id="search_text" placeholder="Search">
  </div>
  <?php
     include('config1.php');
	 $stmt =$connection->prepare("SELECT * FROM transfer");
	 $stmt->execute();
	 $result=$stmt->get_result();
	?>
  <div class="card">
	  <div class="card-body">
	  <?php
     require_once('config1.php');
	 $query = "SELECT * FROM transfer";
     $query_run = mysqli_query($connection, $query);
	?>
          <table id="table-data" class="table table-dark">
  <thead class="bg-primary">
    <tr>
	 <th scope="col">ID</th>
      <th scope="col">NAME</th>
      <th scope="col">EMAIL</th>
	  <th scope="col">TRANSFER TO</th>
	  <th scope="col">TRANSFER AMOUNT</th>
	  <th scope="col">DATE</th>
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
                            <td> <?php echo $row['transferto']; ?> </td> 
							<td> <?php echo $row['amount']; ?> </td> 
							<td> <?php echo $row['datetime']; ?> </td> 				
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
		url:'transaction_search.php',
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

 </body>
 </html>