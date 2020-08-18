<?php
   session_start();
   $UserID = $_SESSION['sess_ID'];
   
   $conn = mysqli_connect("localhost", "root", "root", "project");
   if(!$conn){
   
   echo "Database connection failed!";
   }
   else{
   
   $sql ="SELECT * FROM Users WHERE UserID=$UserID";
   $result = mysqli_query($conn, $sql);
   
   if (mysqli_num_rows($result) == 0){
   
   echo "Incorrect UserID! Please correct UserID and refresh";
   
   }
   else{
   
   $User_res = mysqli_fetch_assoc($result);
   }
   mysqli_free_result($result);
   mysqli_close($conn);
   
   }
   
   ?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Songster - Account</title>
      <link rel="icon" type="image/png" href="Icons/favIcon.png">
      
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      
      <link href="musicapp.css" rel="stylesheet">
   </head>
   <body class="bg-light">
      <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
         <img src="Icons/favIcon.png" alt="Logo Icon" class="logo">
         <a class="navbar-brand" id="App" href="homepage.php">Songster</a>
         <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
         <span class="navbar-toggler-icon"></span>
         </button>
         <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
               <li class="nav-item">
                  <a class="nav-link " href="homepage.php#top" id="home">Home <span class="sr-only">(current)</span></a>
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
                  <a class="nav-link active" href="Account.php" id="acc">My Account</a>
               </li>
            </ul>
         </div>
      </nav>
      <div class="container">
         <h2>My Profile</h2>
         <br/>
         <form class="form-horizontal" name="Userupdateform" id="Userupdateform">
            <div class="form-group">
               <label class="control-label col-sm-2" for="username">User Name:</label>
               <div class="col-sm-6">
                  <input type="text" class="form-control" id="username"  name="User_name" value="<?php echo $User_res['UserName'] ?>">
               </div>
            </div>
            <div class="form-group" id="email_division">
               <label class="control-label col-sm-2" for="email">Email:</label>
               <div class="col-sm-6">
                  <input type="text" class="form-control" id="email_us"  name="email" value="<?php echo $User_res['Email'] ?>">
                  <div id="email_error"></div>
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-2" for="fullname">Full Name:</label>
               <div class="col-sm-6">
                  <input type="text" class="form-control" id="fullname"  name="Full_name" value="<?php echo $User_res['Name'] ?>">
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-2" for="Phone">Mobile:</label>
               <div class="col-sm-6">
                  <input type="text" class="form-control" id="Phone"  name="Mobile" maxlength="15" value="<?php echo $User_res['Phone'] ?>">
               </div>
            </div>
            <br/><br/>
            <div class="form-group">
               <div class="col-sm-offset-2 col-sm-10">
                  <button type="button" class="btn btn-warning" id="Edit">Edit</button>
                  <button type="button" class="btn btn-success" id="Update">Save</button>
                  <button type="button" class="btn btn-dark" id="Logout">Logout</button>
               </div>
            </div>
         </form>
      </div>
      <footer class="pt-4 my-md-5 pt-md-5 border-top">
         <div class="row">
            <div class="col-12 col-md">
               <small class="d-block mb-3 text-muted">&copy; 2020-2021</small>
            </div>
            <div class="col-6 col-md">
               <a class="text-muted" href="Favourites.php?UserID=<?php echo $UserID?>">Favourites</a>
            </div>
            <div class="col-6 col-md">
               <a class="text-muted" href="Pricing.php">Pricing</a>
            </div>
            <div class="col-6 col-md">
               <a class="text-muted" href="Account.php">Account</a>
            </div>
         </div>
      </footer>
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.7/holder.min.js"></script>
      <script src="AccountJS.php"></script>
   </body>
</html>