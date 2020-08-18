<?php
session_start();
$conn = mysqli_connect("localhost", "root", "root", "Project");

// Check the connection
if (!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
    echo "Database Connection Failed";
}

else

{

    $userID = $_POST['UserID'];
    $username = $_POST['Username'];
    $email = $_POST['Email'];
    $fullname = $_POST['Fname'];
    $Phone = $_POST['Phone'];

    $update = "UPDATE Users SET Username='$username',Email='$email',Name = '$fullname',Phone='$Phone' WHERE UserID = '$userID'";
    $result = $conn->query($update);
    echo "<h4>Account Information Updated Sucessfully!</h4>";
    header('Refresh:1; url=Account.php');
}
$conn->close();
?>
