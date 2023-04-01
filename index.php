<?php include('dbconnect.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Registration</title>
</head>

<body>
    <h1>Registration</h1>

    <div>
        <?php

        session_start();

        function endsWith($string, $endstring)
        {
            $len = strlen($endstring);
            if ($len == 0) {
                return true;
            }
            return (substr($string, -$len) == $endstring);
        }
        function passStrength($pass)
        {
            if (strlen($pass) > 7) {
                if (preg_match("#[0-9]#", $pass)) {
                    if (preg_match("#[A-Z]#", $pass)) {
                        if (preg_match("#[a-z]#", $pass)) {
                            if (preg_match('@[^\w]@', $pass)) {
                                return true;
                            }
                        }
                    }
                }
            }
            return false;
        }
        if (isset($_POST['signUp'])) {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];

            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);

            if ($num == 0) {
                if (endsWith($email, "@iitp.ac.in")) {
                    if (passStrength($password)) {
                        if ($password == $confirmPassword) {
                            $sql = "INSERT INTO users(first_name,last_name,email,password) VALUES ('$firstName', '$lastName', '$email', '$password')";
                            $resultNew = mysqli_query($conn, $sql);

                            if ($resultNew) {
                                header("Location: logIn.php");
                            }

                        } else {
                            echo '<script> alert("Error! Passwords do not match.")</script>';
                        }
                    } else {
                        echo '<script> alert("Error! Password must be atleast 8 characters long and include atleast one uppercase letter, lowercase letter, a number and a special character")</script>';
                    }
                } else {
                    echo '<script> alert("Error! Use your IITP email address only.") </script>';
                }
            } else {
                echo '<script> alert("Error! User already exists.")</script>';
            }
        }
        ?>
    </div>
    <div class="container">

        <div class="form" id="signUp">
            <form method="POST">
                <input type="text" name="firstName" placeholder="First Name" required> <br> <br>
                <input type="text" name="lastName" placeholder="Last Name" required> <br> <br>
                <input type="email" name="email" placeholder="Email" reqired> <br><br>
                <input type="password" name="password" placeholder="Password" required><br><br>
                <input type="password" name="confirmPassword" placeholder="Confirm Password" required><br><br>
                <input type="submit" name="signUp" value="Sign Up">
                <p>Have an account already? <a href="logIn.php">Log In</a></p>
            </form>
        </div>

</body>

</html>