
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
    <title>Change Profile</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>

    <div class="navbar">
        <div class="logo">
            <a href="home.php"><img src="../Database-summer-practice/images/color-filter-fill.svg" alt=""></a>
        </div>

        <div class="profile">
            <a href="changeProfile.php">Change Profile</a>
            <a href="Login.php"><button class="btn">Logout</button></a>
        </div>
    </div>

    <div class="con1">
        <div class="boxform">


            <?php
            
            if (isset($_POST['submit'])){
                $username = $_POST ['Name'];
                $email = $_POST ['Email'];
                $age = $_POST ['Age'];
                $id = $_SESSION ['id'];

                $edit_query = mysqli_query($con, "UPDATE users SET username='$username', email='$email', age='$age' WHERE id=$id") or die("Error occured");

                if ($edit_query){

                    echo "<div class='message'>
                    <p>Profile Updated.</p>
                </div> <br>";

                echo "<a href='home.php'><button class='btn'>Go home</button></a>";
                }
            }
            else {

                $id = $_SESSION['id'];
                $query = mysqli_query($con, "SELECT*FROM users WHERE id = $id");
    
                while ($result = mysqli_fetch_assoc($query)){
                    $res_Uname = $result ['username'];
                    $res_email = $result ['email'];
                    $res_age = $result ['age'];
                    $res_password = $result ['password'];
                    $res_id = $result ['id'];
                }
            
            ?>


            <form action="">
                <header>Change Profile</header>
                <div class="inputs username">
                    <label for="Name">Name</label>
                    <input type="text" name="Name" id="name" value="<?php echo $res_Uname?>" required>
                </div>

                <div class="inputs username">
                    <label for="Email">Email</label>
                    <input type="text" name="Email" id="Email" value="<?php echo $res_email?>" required>
                </div>

                <div class="inputs username">
                    <label for="Age">Age</label>
                    <input type="number" name="Age" id="Age" value="<?php echo $res_age?>" required>
                </div>

                <div class="inputs">
                    <input class="btn" type="submit" value="Update" name="submit">
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>