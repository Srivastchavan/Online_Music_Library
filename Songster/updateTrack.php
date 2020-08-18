<?php
   session_start();
   $UserID = $_SESSION['sess_ID'];
   
   $conn = mysqli_connect("localhost", "root", "root", "project");
   if(!$conn){
   
   echo "Database connection failed!";
   }
   else{
   if(isset($_GET['TrackID'])) {
   $trackid = mysqli_real_escape_string($conn,$_GET['TrackID']);
   $sql ="SELECT * FROM TRACK WHERE TRACKID=$trackid";
   $result = mysqli_query($conn, $sql);
   
   if (mysqli_num_rows($result) == 0){
   
   echo "Incorrect UserID! Please correct UserID and refresh";
   
   }
   else{
   
   $Track_res = mysqli_fetch_assoc($result);
   }
   mysqli_free_result($result);
   mysqli_close($conn);
   
   }
   }
   
   ?>
<!doctype html>
<html>
   <head>
      <title>Update Song</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <style>
         body {
         padding-top: 60px;
         background: #ecf0f1;
         }
         #App{
         font-size: 150%;
         color: navy;
         }
         .logo {
         height: 42px;
         width: 50px;
         display: block;
         text-indent: -9999px;
         float: left;
         }
      </style>
   </head>
   <body>
      <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
         <img src="Icons/favIcon.png" alt="Logo Icon" class="logo">
         <a class="navbar-brand" id="App" href="homepage.php">Songster</a>
         <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
         <span class="navbar-toggler-icon"></span>
         </button>
         <div class="navbar-collapse offcanvas-collapse" id="nav">
            <ul class="navbar-nav ml-auto">
               <li class="nav-item">
                  <a class="nav-link" href="homepage.php#top" id="home">Home <span class="sr-only">(current)</span></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="homepage.php#bottom" id="track">All Tracks</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="Favourites.php?UserID=<?php echo $UserID?>" id="fav">Favorites</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="Pricing.php" id="pricing">Pricing</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="Account.php" id="acc">My Account</a>
               </li>
            </ul>
         </div>
      </nav>
      <div class="container">
         <h1>Update Song Details</h1>
         <form action="update.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="trackid" value="<?php echo $trackid?>" />
            <div class="form-group">
               <h5>Title</h5>
               <input type="text" name="title" class="form-control" value="<?php echo $Track_res['TITLE'] ?>">
            </div>
            <div class="form-group">
               <h5>Artist</h5>
               <input type="text" name="artist" class="form-control" value="<?php echo $Track_res['ARTIST'] ?>">
            </div>
            <div class="form-group">
               <h5>Genre</h5>
               <input type="text" name="genre" class="form-control" value="<?php echo $Track_res['GENRE'] ?>">
            </div>
            <div class="form-group">
               <h5>Album</h5>
               <input type="text" name="albumName" class="form-control" value="<?php echo $Track_res['ALBUM'] ?>">
            </div>
            <div class="form-group">
               <h5>Year</h5>
               <input type="number" name="year" class="form-control" value="<?php echo $Track_res['YEAR'] ?>">
            </div>
            <div class="form-group">
               <h5>Image Name</h5>
               <input type="text" name="imageExt" class="form-control" value="<?php echo $Track_res['PIC'] ?>">
            </div>
            <div class="form-group">
               <h5>Duration</h5>
               <input type="text" name="duration" class="form-control" value="<?php echo $Track_res['DURATION'] ?>">
            </div>
            <div>
               Select image to upload:
               <input type="file" name="fileToUpload" id="fileToUpload">
               <img id="imgprev" src="img/<?php echo $Track_res['PIC'] ?>" alt="image preview"  style="width:200px; height:200px"/>Image Preview
            </div>
            <input type="submit" name="submit" value="Save" class="btn btn-lg btn-primary" id="btnsave" />
         </form>
         <a href="homepage.php#bottom">Cancel</a>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script>
         function readURL(input) {
              if (input.files && input.files[0]) {
                  var reader = new FileReader();
                  
                  reader.onload = function (e) {
                      $('#imgprev').attr('src', e.target.result);
                  }
                  
                  reader.readAsDataURL(input.files[0]);
              }
          }
          
          $("#fileToUpload").change(function(){
              readURL(this);
          });
      </script>	
   </body>
</html>