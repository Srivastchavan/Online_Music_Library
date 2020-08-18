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

if (isset($_POST['username']) || isset($_POST['email2']))
{

    $username = $_POST['username'];
    $email2 = $_POST['email2'];
    $password2 = $_POST['password2'];
    $hashed_password = password_hash($password2, PASSWORD_DEFAULT);
	
    $usersql = "SELECT * FROM Users WHERE UserName='$username'";
	
    $emailsql = "SELECT * FROM Users WHERE Email='$email2'";

    $result1 = $conn->query($usersql);
    $result2 = $conn->query($emailsql);

    if ($result1->num_rows > 0 && $result2->num_rows == 0)
    {
        echo "<h4>This Username is already taken</h4>";
    }
    elseif ($result2->num_rows > 0 && $result1->num_rows == 0)
    {
        echo "<h4>This Email is already being used</h4>";
    }
    elseif ($result1->num_rows > 0 && $result2->num_rows > 0)
    {
        echo "<h4>Username and Email already in use</h4>";
    }
    else
    {
        $insertion = "INSERT INTO Users (UserName, Email, PWD, Name, Phone, ISSUBSCRIBED, ISADMIN) VALUES ('$username', '$email2', '$hashed_password', '$username','',0,0)";
        $result = $conn->query($insertion);
        echo "<h4>Account Created!</h4>";
        header('Refresh:1; url=index.html');
    }
    $conn->close();
}
?>
