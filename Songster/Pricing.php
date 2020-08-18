   
<?php
    session_start();
    $Username = $_SESSION['sess_username'];
    $UserID = $_SESSION['sess_ID'];
    
$conn = mysqli_connect("localhost","root","root","Project");



// Check the connection
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
    echo "Database Connection Failed";
}
    
else
{    
if( isset( $_POST['Subscribe'] ) ) {
         $update = "UPDATE Users SET ISSUBSCRIBED =  CASE ISSUBSCRIBED WHEN 0 THEN 1 END WHERE UserID = '$userID'";
        $result = $conn->query($update);
		
		echo '<script language="javascript">';
echo 'alert("You are subscribed User!")';
echo '</script>';
        //echo "<h4>You are subscribed User!</h4>";
       $conn->close();    

header('Refresh:1; url=homepage.php');	   
}    
}
    
   ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Songster - Pricing</title>
      <link rel="icon" type="image/png" href="Icons/favIcon.png">
    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Custom styles for this template -->
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
                  <a class="nav-link active" href="Pricing.php" id="pricing">Pricing</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="Account.php" id="acc">My Account</a>
               </li>
        </ul>
        
      </div>
    </nav>


    
     <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center border-top fill">
      <h1 class="display-4">Pricing</h1>
    </div>


    <div class="container">
      <div class="card-deck mb-3 text-center">    
        <div class="card mb-6 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Regular</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Stream 1000 songs per month</li>
              <li>10 GB of cloud storage</li>
              <li>Phone and email support</li>
              <li>Help center access</li>
            </ul>
           <form method="POST" action="#"> 
               <input type=submit  class="btn btn-warning my-2  btn-block" value="Get Started" name="Subscribe" >
              </form> 
          </div>
        </div>
        <div class="card mb-6 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Premium</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Stream Unlimited songs per month</li>
              <li>Unlimited Cloud storage</li>
              <li>Priority Phone and email support</li>
              <li>Help center access</li>
            </ul>
            <form method="POST" action="#"> 
                <input type=submit  class="btn btn-warning my-2  btn-block" value="Get Started" name="Subscribe" >
              </form>    
          </div>
        </div>
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
      <script >
      $(document).on('click', '.navbar li', function() {
       $(".navbar li").removeClass("active");
       $(this).addClass("active");
   });
      </script>
 
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.7/holder.min.js"></script>
    <script src="musicapp.js"></script>
  </body>
</html>
 












