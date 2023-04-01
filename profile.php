<?php include('dbconnect.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile Page</title>
</head>

<body>
<h1> Profile Page </h1><br>

    <div>
        <?php
        session_start();
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        echo "<b>First Name: </b>". $firstName. "<br><br>";
        echo "<b>Last Name: </b>". $lastName ."<br><br>";
        echo "<b>Email Id: </b>".$email. "<br><br>";

        ?>
    </div>

<p><a href="homePage.php">Go back to Home Page</a></p>
</body>

</html>