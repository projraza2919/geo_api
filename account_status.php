<!DOCTYPE html>
<html lang="en">
<head>
  <title>GEOFENCE ADMIN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/1.0.3/jquery.csv.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



</head>
<body>
  
<div class="container">
  <div class="row">
  	<div class="col-12">
 <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Details</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>

    
    <?php
session_start(); 
include 'api/inc/db.php'; 
if (isset($_GET['uid']) && $_GET['uid']=='gg54564hghahhgs234567hsgfshhhpps545644564') {
	$sql="SELECT * FROM users WHERE del=0";
	if (mysqli_query($conn,$sql)) {
		$run=mysqli_query($conn,$sql);
		if (mysqli_num_rows($run)>0) {
			
			while ($fetch=mysqli_fetch_assoc($run)) {
				if($fetch['userverify']==1){
					if($fetch['status']=='active'){
						echo '<tr>
      					<th scope="row">'.$fetch['id'].'</th>
      						<td>Name:'.$fetch['name'].'<br>Email:'.$fetch['email'].'<br>UserId'.$fetch['userid'].'<br>Designation: '.$fetch['designation'].'<br>Department: '.$fetch['department'].'<br>Contact:'.$fetch['contact'].'</td>
      						<td><a class="btn btn-success" href="update_status_inactive.php?device='.$fetch['device'].'">Deactivate</a></td>
    					</tr>';
					}else{
						echo '<tr>
      					<th scope="row">'.$fetch['id'].'</th>
      						<td>Name:'.$fetch['name'].'<br>Email:'.$fetch['email'].'<br>UserId'.$fetch['userid'].'<br>Designation: '.$fetch['designation'].'<br>Department: '.$fetch['department'].'<br>Contact:'.$fetch['contact'].'</td>
      						<td><a class="btn btn-danger" href="update_status_active.php?device='.$fetch['device'].'">Activate</a></td>
    					</tr>';
					}
				}
				
			}
		}else{
			echo '<h1>Sorry No Memebers are Available</h1>';
		}
	}
}else{
	echo '<h1>Sorry Admin Not recognised</h1>';
}


?>

  </tbody>
</table>




  	</div>
  	<div class="col-12">
  		
  	</div>
  </div>          
</div>

    <script>
        document.getElementById('upload').addEventListener('change', handleFileSelect, false);

    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</body>
</html>