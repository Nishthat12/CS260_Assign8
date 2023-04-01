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
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        $id = $row['id'];
        $_SESSION['id'] = $id;
        echo "<h1> Welcome $firstName $lastName</h1>";

        ?>
    </div>
    <p><a href="profile.php">View Profile</a></p>
    <p><a href="updateProfile.php">Update Profile</a></p>
    <p><a href="deleteProfile.php">Delete Account</a></p>
    <p><a href="logOut.php">Log Out</a></p>
</body>

</html>