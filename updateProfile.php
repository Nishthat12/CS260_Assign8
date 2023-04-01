<?php include('dbconnect.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Profile</title>
</head>

<body>
    <h1> Update Profile </h1><br>
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
        $password = $row['password'];
        $_SESSION['id'] = $id;

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

        if (isset($_POST['update'])) {
            $firstNameNew = $_POST['firstName'];
            $lastNameNew = $_POST['lastName'];
            $emailNew = $_POST['email'];
            $passwordNew = $_POST['password'];
            $confirmPasswordNew = $_POST['confirmPassword'];

            
            if (endsWith($email, "@iitp.ac.in")) {
                if (passStrength($password)) {
                    if ($passwordNew == $confirmPasswordNew) {
                        $sql = "UPDATE users SET first_name = '$firstNameNew', last_name = '$lastNameNew', email = '$emailNew' WHERE id = '$id'";
                        $result = mysqli_query($conn, $sql);

                    } else {
                        echo '<script> alert("Error! Passwords do not match.")</script>';
                    }
                } else {
                    echo '<script> alert("Error! Password must be atleast 8 characters long and include atleast one uppercase letter, lowercase letter, a number and a special character")</script>';
                }

            } else {
                echo '<script> alert("Use your IITP email address only!")</script>';
            }

            if ($result) {
                echo '<script> alert("Updated Successfully!"); window.location.href= "homePage.php";</script>';
            }
            else{
                echo '<script> alert("error!") </script>';
            }
        }
        ?>
    </div>
    <div class="form" id="update">
        <form method="POST">
            First Name: <input type="text" name="firstName" value="<?php echo $firstName ?>" required> <br> <br>
            Last Name: <input type="text" name="lastName" value="<?php echo $lastName ?>" reqired> <br> <br>
            Email: <input type="email" name="email" value="<?php echo $email ?>" reqired> <br> <br>
            Password: <input type="text" name="password" value="<?php echo $password ?>"  required><br><br>
            Confirm Passowrd: <input type="text" name="confirmPassword" value="<?php echo $password ?>" required><br><br>
            <input type="submit" name="update" value="Update">
        </form>
        <p><a href="homePage.php">Go back to Home</a></p>
    </div>
</body>

</html>