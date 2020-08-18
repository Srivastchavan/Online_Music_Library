<?php
   session_start();
   	$Admin = $_SESSION["sess_admin"];
   	$UserID = $_SESSION['sess_ID'];
   $conn = mysqli_connect("localhost", "root", "root", "project");
   if(!$conn){
   
   		echo "Database connection failed!";
   	}
   	else{
   
   		if(isset($_GET['TrackID'])) {
   
   			$trackid = mysqli_real_escape_string($conn,$_GET['TrackID']);
   			
   			$sql ="SELECT T.TRACKID,T.TITLE,T.ARTIST,T.GENRE,T.ALBUM,T.YEAR,T.PIC,T.Duration,F.ISREMOVE,F.USERID FROM Track T LEFT OUTER JOIN favourites F ON T.TrackID = F.TrackID and F.USERID='$UserID' WHERE  T.TrackID='$trackid' Limit 1";
   			
   			$result = mysqli_query($conn, $sql);
   			
   			if (mysqli_num_rows($result) == 0){
   
   			echo "Incorrect TrackId! Please correct TrackID and refresh";
   
   			}
   			else{
   
   				$track = mysqli_fetch_assoc($result);
   			}
   			mysqli_free_result($result);
   			
   		}
   		
   		if( isset( $_POST['delete'] ) ) {
   		$track = $_POST['trackid'];
   		$delsql = "Update TRACK set ISDELETE=1 where TRACKID='$track'";
   		$result = $conn->query($delsql);
   		echo "<h4>Track Deleted Sucessfully!</h4>";
   		header('Refresh:1; url=homepage.php');
   		
   }
   
   if( isset( $_POST['addFav'] ) ) {
   		$track = $_POST['trackid'];
   		$isremove = $_POST['isremove'];
   		
   		if($isremove==""){
   		$addFavsql = "Insert Into Favourites (USERID,TRACKID,ISREMOVE) values($UserID,$track,0)";
   		}
   		else if($isremove==1){
   		$addFavsql = "Update Favourites set ISREMOVE=0 where TRACKID='$track' and USERID=$UserID";
   		}
   		$result = $conn->query($addFavsql);
   		echo "<h4>Track added to Favorites Sucessfully!</h4>";
   		header('Refresh:1; url=trackdetails.php?TrackID='.$track);
   		
   }
   
   
   if( isset( $_POST['removeFav'] ) ) {
   		$track = $_POST['trackid'];
   		$delFavsql = "Update Favourites set ISREMOVE=1 where TRACKID='$track' and USERID=$UserID";
   		$result = $conn->query($delFavsql);
   		echo "<h4>Track removed from favourites Sucessfully!</h4>";
   		header('Refresh:1; url=trackdetails.php?TrackID='.$track);
   		
   }
   
   if( isset( $_POST['cancel'] ) ) {
   		header('Refresh:1; url=homepage.php#bottom');
   		
   }
   
   
   
   	}
   	mysqli_close($conn);
   ?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Online Music App</title>
      
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      
      <link href="trackdetails.css" rel="stylesheet">
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
                  <a class="nav-link " href="homepage.php#top">Home <span class="sr-only">(current)</span></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="homepage.php#bottom">All Tracks</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="Favourites.php?UserID=<?php echo $UserID?>">Favorites</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="Pricing.php">Pricing</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="Account.php">My Account</a>
               </li>
            </ul>
         </div>
      </nav>
      <div class="row ">
         <div class="col-sm-6 col-md-3 vertical-center ">
            <form method="post" action="#" >
               <input type="hidden" id="sessionus" name=trackid style="display:none" value="<?= $trackid ?>">
               <input type="hidden" id="sessionus" name=isremove style="display:none" value="<?= $track['ISREMOVE'] ?>">
               <?php if (!!$Admin) { ?>
               <div class="container ml-5 pl-5">
                  <a href="updateTrack.php?TrackID=<?php echo $trackid?>" class="btn btn-primary my-2 btn-block">Update Track Info</a>
               </div>
               <div class="container ml-5 pl-5">
                  <input type=submit  class="btn btn-danger my-2 btn-block" value="Delete Track" name=delete >
               </div>
               <?php } ?>
               <? if ($track['ISREMOVE']==1 or $track['ISREMOVE']===NULL): ?>
               <div class="container ml-5 pl-5">
                  <input type=submit  class="btn btn-warning my-2  btn-block" value="Add to Favorites" name=addFav >
               </div>
               <? elseif ($track['ISREMOVE']==0): ?>
               <div class="container ml-5 pl-5">
                  <input type=submit  class="btn btn-danger my-2  btn-block" value="Remove from favourites" name=removeFav >
               </div>
               <? endif; ?>
			   <div class="container ml-5 pl-5">
					<input type=submit  class="btn btn-info my-2 btn-block" value="Go Back" name=cancel >
			   </div>
            </form>
         </div>
         <div class="col-sm-6 col-md-6">
            <section>
               <img src="img/<?php echo $track['PIC'] ?>" style="width:600px; height:600px;">
               <header>
                  <div class='left'>
                     <h1>Title: <?php echo $track['TITLE'] ?></h1>
                     <h2>Artist: <?php echo $track['ARTIST'] ?></h2>
                     <h2>Album: <?php echo $track['ALBUM']."(".$track['YEAR'].")" ?></h2>
                  </div>
                  <div class='right'>
                     <audio id="demo" src=""></audio>
                     <button id='play'></button>
                     <button id='pause'></button>
                     <h5><?php echo $track['Duration'] ?></h5>
                     <? if ($track['ISREMOVE']==1 or $track['ISREMOVE']===NULL): ?>
                     <button id='msxheart'></button>
                     <? elseif ($track['ISREMOVE']==0): ?>
                     <button id='brkheart'></button>
                     <? endif; ?>
                  </div>
               </header>
            </section>
         </div>
         <div class="col-sm-6 col-md-3">
         </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="trackdetails.js"></script>
   </body>
</html>