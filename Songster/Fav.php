<?php
session_start();
$conn = mysqli_connect("localhost", "root", "root", "project");
if (!$conn)
{

    echo "Database connection failed!";
}
else
{

    if (isset($_GET['UserID']))
    {

        $UserID = mysqli_real_escape_string($conn, $_GET['UserID']);

        $sql = "SELECT T.TRACKID,T.TITLE,T.ARTIST,T.GENRE,T.ALBUM,T.YEAR,T.PIC,T.Duration FROM Favourites F JOIN TRACK T ON F.TrackID = T.TrackID WHERE F.ISREMOVE=0 AND F.UserID=$UserID";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0)
        {

            echo "<h3>You have not yet saved any favourites. Please go to all music and select a track to set it as favourite.<h3>";

        }
        else
        {
            while ($row = mysqli_fetch_assoc($result))
            {
                $entry = array(
                    "TrackID" => $row['TRACKID'],
                    "Title" => $row['TITLE'],
                    "Artist" => $row['ARTIST'],
                    "Genre" => $row['GENRE'],
                    "Album" => $row['ALBUM'],
                    "Year" => $row['YEAR'],
                    "Pic" => $row['PIC'],
                    "Duration" => $row['DURATION'],
                );
                $entries[] = $entry;
            }
            echo json_encode($entries);
        }
        mysqli_free_result($result);
        mysqli_close($conn);
    }
}
?>
