<?php
$search = $_POST["search"];
$filter = $_POST["filter"];

if ($search == "" && $filter == "all")
{
    $sql = "SELECT * FROM TRACK WHERE 1";
}

else if ($search != "" && $filter == "all")
{
    $sql = "SELECT * FROM TRACK WHERE TITLE like '%$search%' OR ALBUM like '%$search%' OR ARTIST like '%$search%' OR YEAR like '%$search%'";
}

else if ($search == "" && $filter != "all")
{
    $sql = "SELECT * FROM TRACK WHERE GENRE like '%$filter%'";
}

else if ($search != "" && $filter != "all")
{
    $sql = "SELECT * FROM TRACK WHERE GENRE like '%$filter%' AND (TITLE like '%$search%' OR ALBUM like '%$search%' OR ARTIST like '%$search%' OR YEAR like '%$search%')";
}

$conn = mysqli_connect("localhost", "root", "root", "project");
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
