<?php
   session_start();
   $Username = $_SESSION['sess_username'];
   $UserID = $_SESSION['sess_ID'];
   $Admin = $_SESSION["sess_admin"];
   ?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Songster - Favourites</title>
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
                  <a class="nav-link active" href="Favourites.php?UserID=<?php echo $UserID?>" id="fav">Favorites</a>
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
      <main role="main">
         <div class="container">
            
            <br/>
            <section id="bottom" class="jumbotron bottom-section flex flex-column full-width text-center my-0">
               <h2 class="justify-content-center">Favourites List</h2>
               <form class="form-inline mb-4 mb-lg-4 justify-content-center">
                  			  
				  <input class="form-control ml-sm-2 " type="text" placeholder="Search Tracks,Album,Artists,year etc." id="search" aria-label="Search">
                  &nbsp;&nbsp;
                  <button class="btn btn-outline-success my-2 my-sm-0" id="btnSearch" type="submit" >Search</button>
                  &nbsp;&nbsp;
                  <select name="filter" id="filter" class="form-control">
                     <option value="all" selected>Genre</option>
                  </select>
                  &nbsp;&nbsp;
				  
				  
               </form>
               <div class="container">
                  <div class="row gallery">
                  </div>
               </div>
               <div class="container text-center mt-5">
                  <div id="pagination-wrapper"></div>
               </div>
               
               <br/>
         </div>
         </section>
      </main>
      <input type="hidden" id="sessionus" style="display:none" value="<?= $UserID ?>">
      
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
      <script src="FavJs.php"></script>
   </body>
</html>