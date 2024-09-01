<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="loginstyle.css">
    <script src="registerjs.js"></script>
</head>
<body>
    <div class="con1">
        <div class="boxform">

            <?php
            
            include("php/config.php");
            
            if (isset($_POST['submit'])){
                $username= $_POST ['username'];             //assign value sa $username sa value sa 'username' name nga naa sa form
                $email= $_POST ['email'];
                $office= $_POST ['office'];
                $password= $_POST ['password'];
            

                //verfying if email already exist in the database

                $verify_query = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");

                if (mysqli_num_rows($verify_query) !=0 ){
                    echo "<div class='messageError'>
                        <p style='color: red; border: 1px solid red; padding: 5px;'>Email laready exist. Please use a different email.</p>
                    </div> <br>";

                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go back</button></a>";
                }

                else { 
                    mysqli_query($con, "INSERT INTO users(username,email,office,password) VALUES('$username', '$email','$office','$password')") or die ("Error Occured");
                    
                    echo "<div class='message'>
                        <p>Registration Successful.</p>
                    </div> <br>";

                    echo "<a href='Login.php'><button class='btn'>Login Now</button></a>";
                }
            }

            else { 

            ?>
                     <!-- pwede rasad inani mas efficient ni -->
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  method="post" id="officeForm">  <!--//action="register.php" needed for proccessing data  -->
                <header>Sign up</header>
                <div class="inputs fullname">
                    <label for="username">Fullname</label>
                    <input type="text" name="username" id="username" required>   <!--//name="username" case sensitive dapat same sa name sa database -->
                </div>

                <div class="inputs username">
                    <label for="Email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div class="inputs username">
                    <label for="office1">Office</label>
                    <input class="office" type="text" name="office" id="office" pattern="^(VPAA|vpaa|CITL|citl)$" required>

                    <label class="office2" for="Office_passcode">Office Passcode</label>
                    <input type="text" name="Office_passcode" id="Office_passcode" pattern="^(123|321)$" required>
                </div>

                
                <div class="inputs password">
                    <label for="password">Set Password</label>
                    <input type="password" name="password" id="password" minlength="10" required>
                    <label class="atleast" for="atleast">Atleast 10 characters</label>
                </div>

                <div class="inputs">
                    <input class="btn" type="submit" value="Submit" name="submit">
                </div>

                <div class="links">
                    Already had a account? <a style="text-decoration: none;" href="Login.php">click here</a>
                </div>
            </form>
        </div>
        <?php }?>
    </div>
</body>
</html>