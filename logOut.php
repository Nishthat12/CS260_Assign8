<?php include('dbconnect.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Page</title>
</head>

<body>
    <div>
        <?php
        session_start();
        session_destroy();
        echo "You have been logged out <br>";
        ?>
    </div>
    <p><a href="logIn.php">Go to Log In Page</a></p>
</body>

</html>