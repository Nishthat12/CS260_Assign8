<?php include('dbconnect.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Log In</title>
</head>

<body>
    <h1>Log In</h1>

    <div>
        <?php

        session_start();

        if (isset($_POST['logIn'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];


            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);

            if ($num == 1) {
                $sql = "SELECT password FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
                $realPassword = $row['password'];
                if ($password == $realPassword ) {
                    $_SESSION['email'] = $email;
                    header("Location: homePage.php");
                } else {
                    echo '<script> alert("Error! Incorrect password") </script>';

                }
            } else {
                echo '<script> alert("Error! Account does not exist. Please sign up first")</script>';
            }
        }
        ?>
    </div>

    <div class="container">

        <div class="form" id="logIn">
            <form method="POST">
                <input type="email" name="email" placeholder="Email" reqired> <br><br>
                <input type="password" name="password" placeholder="Password" required><br><br>
                <input type="submit" name="logIn" value="Log In">
                <p>Don't have an account? <a href="index.php">Sign Up</a></p>
            </form>
        </div>

</body>

</html>