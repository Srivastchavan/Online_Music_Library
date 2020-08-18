<?php
session_start();

$conn = mysqli_connect("localhost", "root", "root", "project");
if (!$conn)
{

    echo "Database connection failed!";
}
else
{
    $sql = "SELECT * FROM TRACK WHERE ISDELETE=0";
    $result = mysqli_query($conn, $sql);
    $entries = array();
    if (mysqli_num_rows($result) == 0)
    {

        echo "Incorrect gender/year1! Please select correct gender and year values and click submit";

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
    mysqli_close($conn);

}
?>
