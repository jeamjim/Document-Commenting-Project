<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>

    <?php

    session_start();

    ?>

    <div class="con1">
        <div class="boxform">
            <?php
            
            include ("php/config.php");

            if (isset($_POST['submit'])){
                $email = mysqli_real_escape_string($con, $_POST['email']);
                $password = mysqli_real_escape_string($con, $_POST['password']);

                $result = mysqli_query($con, "SELECT * FROM users WHERE email= '$email' AND password= '$password'") or die ("Select Error");
                $row = mysqli_fetch_assoc($result);

                if (is_array($row) && !empty($row)){ 
                    $_SESSION['valid'] = $row ['email'];
                    $_SESSION['username'] = $row ['username'];
                    $_SESSION['age'] = $row ['age'];
                    $_SESSION['id'] = $row ['id'];
                }
                else { 
                    echo "<div class='messageError'>
                    <p style='color: red; border: 1px solid red; padding: 5px;'>Wrong Credentials!</p>
                </div> <br>";

                echo "<a href='Login.php'><button class='btn'>Go back</button></a>";
                } 

                if (isset($_SESSION['valid'])) {
                    header("Location: home.php");
                }
            }
            else { 

            ?>        <!-- inani ang "action" para bisag ma rename ang file direct japon sa self -->
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <header>Sign in</header>
                <div class="inputs">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div class="inputs">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" minlength="5" required>
                </div>

                <div class="sub">
                    <input class="btn" type="submit" name="submit" value="Login">
                </div>

                <div class="links">
                    Don't have an account? <a style="text-decoration: none;" href="register.php">click here</a>
                </div>
            </form>
            <?php }?>
        </div>
       
    </div>
</body>
</html>