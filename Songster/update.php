<?php
session_start();
// Create connection
$conn = mysqli_connect("localhost", "root", "root", "project");

// Check the connection
if (!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
    echo "Database Connection Failed";
}

if (isset($_POST['trackid']) || isset($_POST['title']) || isset($_POST['artist']) || isset($_POST['genre']) || isset($_POST['albumName']) || isset($_POST['year']) || isset($_POST['imageExt']) || isset($_POST['duration']))
{
    $trackid = $_POST['trackid'];
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $genre = $_POST['genre'];
    $albumName = $_POST['albumName'];
    $year = $_POST['year'];
    $imageExt = $_POST['imageExt'];
    $duration = $_POST['duration'];

    $target_file = 'img/' . $_FILES["fileToUpload"]["name"];
    $uploadOk = 1;
    
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif")
    {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    if ($uploadOk != 0)
    {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], 'img/' . $_FILES["fileToUpload"]["name"]))
        {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        }
        else
        {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $insertion = "UPDATE TRACK SET TITLE = '$title', ARTIST = '$artist', GENRE = '$genre', ALBUM = '$albumName', YEAR = '$year', PIC = '$imageExt', DURATION = '$duration', ISDELETE = 0 where TRACKID='$trackid'";

    $result = $conn->query($insertion);

    header('Refresh:1; url=homepage.php');

    echo "<h2>Song Details updated!</h2>";

    $conn->close();
}

?>
