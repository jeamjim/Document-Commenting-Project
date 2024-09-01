
<?php

session_start();

include("php/config.php");
if (!isset($_SESSION['valid'])) { 
    header("Location: home.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <img src="../Database-summer-practice/images/color-filter-fill.svg" alt="">
        </div>

        <div class="profile">

            <?php
            
            $id = $_SESSION['id'];
            $query = mysqli_query($con, "SELECT*FROM users WHERE id = $id");

            while ($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result ['username'];
                $res_email = $result ['email'];
                $res_age = $result ['age'];
                $res_password = $result ['password'];
                $res_id = $result ['id'];
            }

            echo "<a href= 'changeProfile.php?id=$res_Uname'>Change profile</a>"
            
            ?>

            <a href="changeProfile.php">Change Profile</a>
            <a href="php/logout.php"><button class="btn">Logout</button></a>
        </div>
    </div>


    <main>

        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Hello <b><?php echo $res_Uname?></b>, Welcome</p>
                </div>
                <div class="box">
                    <p>Your Email is <b><?php echo $res_email?></b></p>
                </div>
            </div>

            <div class="bottom">
                <div class="box">
                    <p>Your are <b><?php echo $res_age?></b> years old</p>
                </div>

                <div class="box">
                    <p>Your password is <b><?php echo $res_password?></b></p>
                </div>
            </div>
        </div>

    </main>
</body>
</html>