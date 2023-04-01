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
        $id = $_SESSION['id'];
        if (isset($_POST['yes'])) {
            $sql = "DELETE FROM users WHERE id = '$id'";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    echo '<script> alert("Successfully deleted your account"); window.location.href= "index.php"; </script>';
                }
        }
        else if(isset($_POST['no'])){
            header("Location: homePage.php");
        }

        ?>
    </div>
    <br><br>
    Do you want to permanently delete your account? <br><br>
    <form method="POST">
        <input type="submit" name="yes" value="Yes, Delete it"></input><t>
        <input type="submit" name="no" value="No, Go back"></input> <br><br>
    </form>
    <p><a href="homePage.php">Go back to Home</a></p>
</body>

</html>