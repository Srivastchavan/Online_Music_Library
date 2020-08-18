<?php
session_start();
$conn = mysqli_connect("localhost", "root", "root", "Project");

if (!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
    echo "Database Connection Failed";
}
if (isset($_POST['submit_form']))
{
    if (isset($_POST['email']) && isset($_POST['password']))
    {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM Users WHERE Email='$email'";

        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            $record = $result->fetch_assoc();
            $_SESSION["sess_username"] = $record['UserName'];
            $_SESSION["sess_email"] = $record['EMAIL'];
            $_SESSION["sess_ID"] = $record['UserID'];
            $_SESSION["sess_admin"] = $record['ISADMIN'];
            $hashed_password = $record['PWD'];
            if (password_verify($password, $hashed_password))
            {
                header("location: homepage.php");
            }
            else
            {
                header('Refresh:1; url=index.html');
                echo "<h1>Email/Password entered is wrong</h1>";
                echo "<br>";
                echo "<h2>Please try again</h2>";
            }
        }
        else
        {
            header('Refresh:1; url=index.html');
            echo "<h1>Email/Password entered is wrong</h1>";
            echo "<br>";
            echo "<h2>Please try again</h2>";
            
        }
        $conn->close();
    }
}

?>
