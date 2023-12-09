<?php  
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login']!=true) {
  $_SESSION['msg']='Login First';
  header("location:login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>GEOFENCE ADMIN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/1.0.3/jquery.csv.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.js"></script>
 <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

<script>
    var ExcelToJSON = function() {

      this.parseExcel = function(file) {
        var reader = new FileReader();

        reader.onload = function(e) {
          var data = e.target.result;
          var workbook = XLSX.read(data, {
            type: 'binary'
          });
          workbook.SheetNames.forEach(function(sheetName) {
            // Here is your object
            var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
            var json_object = JSON.stringify(XL_row_object);
            console.log(JSON.parse(json_object));
            var send=JSON.parse(json_object);
            for (var i=0; i < send.length; i++) {
              //console.log(send[i]['name']+' '+send[i]['email']);
              //var namo=send[i]['email'];
              var namo=send[i]['fname']+' '+send[i]['lname'];
              //var namo=send[i]['name'];
              var ema=send[i]['email'];
              query(namo,ema,i);
              //testquery(namo,ema,i);
            }
            function testquery(nd,ed,an){
              setTimeout(function() {
              console.log("SUCCESS-"+ed+"+");
          }, 1000*an);
            }
            function query(nd,ed,an){
              setTimeout(function() {
             $.ajax({
           type: "POST",
           url: 'send_smtp.php',
           data: {
            'name':nd,
            'email':ed
           }, // serializes the form's elements.
           success: function(data)
           {
               //console.log(data);
                console.log(data); // show response from the php script.
           }
         });

          }, 1000*an);
            
              
            }
            
            jQuery( '#xlx_json' ).val( json_object );
          })
        };

        reader.onerror = function(ex) {
          console.log(ex);
        };

        reader.readAsBinaryString(file);
      };
  };

  function handleFileSelect(evt) {
    
    var files = evt.target.files; // FileList object
    var xl2json = new ExcelToJSON();
    xl2json.parseExcel(files[0]);
  }
</script>
</head>
<body>
  
<div class="container">
  <div class="row">
    <div class="col-12">
 <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">userId</th>
      <th scope="col">fence Status</th>
      <th scope="col">is-Installed Update</th>
      <th scope="col">last Image</th>
    </tr>
  </thead>
  <tbody>
    
    <?php
session_start(); 
include 'api/inc/db.php'; 
if (isset($_GET['uid']) && $_GET['uid']=='gg54564hghahhgs234567hsgfshhhpps545644564') {
  $sql="SELECT * FROM users WHERE status='active' AND del=0";
  if (mysqli_query($conn,$sql)) {
    $run=mysqli_query($conn,$sql);
    if (mysqli_num_rows($run)>0) {
      
      while ($fetch=mysqli_fetch_assoc($run)) {
        $f='In';
        if ($fetch['fence']==0) {
          $f='Out';
        }
        echo '<tr>
                <th scope="row">'.$fetch['id'].'</th>
                <td>'.$fetch['name'].'</td>
                <td>'.$fetch['email'].'</td>
                <td>'.$fetch['userid'].'</td>
                <td>'.$f.'</td>
                <td>Updated Last at:'.$fetch['uninstall'].' Status: '.$fetch['status'].'<br></td>
                <td>Image Id:'.$fetch['image_id'].' Taken On: '.$fetch['image_date'].'<br></td>
            </tr>';
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
      <a class="btn btn-primary" href="account_status.php?uid=<?php echo $_GET['uid']; ?>">Users</a>
    </div>
    <div class="col-12">
      <a class="btn btn-primary" href="location_update.php?uid=<?php echo $_GET['uid']; ?>">Update Location</a>
    </div>
    <br>
    <div class="col-12">
      <a class="btn btn-danger" href="logout.php?uid=<?php echo $_GET['uid']; ?>">Log Out</a>
    </div>
  </div>          
</div>

    <script>
        document.getElementById('upload').addEventListener('change', handleFileSelect, false);

    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#summernote').summernote({
          height: 600,
        });
    });
  </script>
</body>
</html>