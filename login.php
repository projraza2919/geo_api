  <?php
  session_start();  
  if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
  echo '<script>alert("'.$_SESSION['msg'].'")</script>';
  unset($_SESSION['msg']);
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
  <div class="row justify-content-center">
  <div class="col-6">
  	<form action="login_request.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
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