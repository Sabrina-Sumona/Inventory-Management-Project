<?php
    include "../controller/connection.php";
    $conn= connect();
    $m= '';
    if(isset($_POST['submit'])){
        $uname= $_POST['uname'];
        $pass= $_POST['password'];
        $sql= "SELECT * FROM users_info WHERE u_name='$uname' and password='$pass'";
        $res= $conn->query($sql);

        if(mysqli_num_rows($res)==1){
            header('Location: ../model/dashboard.php');
        }
        else{
            $m= 'User name or password is not matched!';
        }
    }
?>
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="../css/login.css">
    </head>
    <body>
        <div class="logo">

        </div>
        <form method="POST">
            <div class="box bg-img">
                <div class="content">
                    <h2>Log<span> In</span></h2>
                    <hr>
                    <div class="forms">
                        <p style="color: red; padding: 20px;">
                                <?php 
                                if($m!='') 
                                    echo $m; 
                            ?>
                        </p>
                        <div class="user-input">
                            <input name="uname" type="text" class="login-input" placeholder="Username" id="name" required/>
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="pass-input">
                            <input name="password" type="password" class="login-input" placeholder="Password" id="my-password" required/ >
                            <span class="eye" onclick="myFunction()">
                              <i id="hide-1" class="fas fa-eye-slash"></i>
                              <i id="hide-2" class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <button class="login-btn" type="submit" name="submit">Sign In</button>
                    <p class="new-account">Not a user? <a href="registration.php">Sign Up now!</a></p>
                    <br>

                    <p class="f-pass">
                        <a href="#">forgot password?</a>
                    </p>

                </div>
            </div>
        </form>
        <script src="https://kit.fontawesome.com/c0078485ae.js" crossorigin="anonymous"></script>
    </body>
</html>

<script>
    function myFunction() {
        var x = document.getElementById("my-password");
        var y = document.getElementById("hide-1");
        var z = document.getElementById("hide-2");

        if (x.type === "password") {
            x.type = "text";
            y.style.display = "block";
            z.style.display = "none";
        } else {
            x.type = "password";
            y.style.display = "none";
            z.style.display = "block";
        }
    }

</script>