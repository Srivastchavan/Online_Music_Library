<?php
   session_start();
   $conn = mysqli_connect("localhost","root","root","online_music");
   
   if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
       echo "Database Connection Failed";
   }
   
   if(isset($_POST['title']) && isset($_POST['artist']) && isset($_POST['genre']) && isset($_POST['albumName']) && isset($_POST['year']) && isset($_POST['image']) && isset($_POST['duration'])){
   	
   	$title = $_POST['title'];
   	$artist = $_POST['artist'];
   	$genre = $_POST['genre'];
   	$albumName = $_POST['albumName'];
   	$year = $_POST['year'];
   	$image = $_POST['image'];
   	$duration = $_POST['duration'];
   	
   	
   $target_file = 'img/' . $_FILES["fileToUpload"]["name"];
   $uploadOk = 1;

   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   
   if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
   && $imageFileType != "gif" ) {
     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
     $uploadOk = 0;
   }
   if ($uploadOk != 0) {
   if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], 'img/' . $_FILES["fileToUpload"]["name"])) {
       echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
     } else {
       echo "Sorry, there was an error uploading your file.";
     }
   }
   
   
   	$insertion = "INSERT INTO TRACK (TITLE, ARTIST, GENRE, ALBUM, YEAR, PIC, DURATION, ISDELETE) VALUES ('$title', '$artist', '$genre', '$albumName', $year, '$image', '$duration', 0)";
   	
   	$result = $conn->query($insertion);
   	
   	header('Refresh:1; url=add.html');
   
   	echo "<h2>Song Added!</h2>";
   
   	$conn->close();
   }
   
   ?>