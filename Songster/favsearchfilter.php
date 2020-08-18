<?php
$conn = mysqli_connect("localhost", "root", "root", "project");
$search = $_POST["search"];
$filter = $_POST["filter"];

$UserID = $_POST['UserID'];

if ($search == "" && $filter == "all")
{
    $sql = "SELECT T.TRACKID,T.TITLE,T.ARTIST,T.GENRE,T.ALBUM,T.YEAR,T.PIC,T.Duration FROM Favourites F JOIN TRACK T ON F.TrackID = T.TrackID WHERE F.UserID='$UserID'";

}

else if ($search != "" && $filter == "all")
{
    $sql = "SELECT T.TRACKID,T.TITLE,T.ARTIST,T.GENRE,T.ALBUM,T.YEAR,T.PIC,T.Duration FROM Favourites F JOIN TRACK T ON F.TrackID = T.TrackID WHERE F.UserID='$UserID' AND (T.TITLE like '%$search%' OR T.ALBUM like '%$search%' OR T.ARTIST like '%$search%' OR T.YEAR like '%$search%')";

}

else if ($search == "" && $filter != "all")
{
    $sql = "SELECT T.TRACKID,T.TITLE,T.ARTIST,T.GENRE,T.ALBUM,T.YEAR,T.PIC,T.Duration FROM Favourites F JOIN TRACK T ON F.TrackID = T.TrackID WHERE F.UserID='$UserID' AND T.GENRE = '$filter'";

}

else if ($search != "" && $filter != "all")
{
    $sql = "SELECT T.TRACKID,T.TITLE,T.ARTIST,T.GENRE,T.ALBUM,T.YEAR,T.PIC,T.Duration FROM Favourites F JOIN TRACK T ON F.TrackID = T.TrackID WHERE F.UserID='$UserID' AND T.GENRE = '$filter' AND (T.TITLE like '%$search%' OR T.ALBUM like '%$search%' OR T.ARTIST like '%$search%' OR T.YEAR like '%$search%')";

}

if (!$conn)
{

    echo "Database connection failed!";
}
else
{

    $result = mysqli_query($conn, $sql);
    $entries = array();
    if (mysqli_num_rows($result) == 0)
    {

        echo "Incorrect search string! Please select enter correct value and search again";

    }
    else
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            $entry = array(
                "TrackID" => $row["TRACKID"],
                "Title" => $row["TITLE"],
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
    mysqli_close();

}

?>
