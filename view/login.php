<?php
    session_start();
    $_SESSION['user']='';
    $_SESSION['userid']='';
    include "../controller/connection.php";
    $conn= connect();
    $m= '';
    if(isset($_POST['submit'])){
        // $uname= $_POST['uname'];
        // $pass= $_POST['password'];

        // to prevent SQL injection by checking the input
        $uname= mysqli_real_escape_string($conn, $_POST['uname']);
        $pass= mysqli_real_escape_string($conn, $_POST['pass']);
        // $sql= "SELECT * FROM users_info WHERE u_name='$uname' and password='$pass'";
        // $res= $conn->query($sql);

        // if(mysqli_num_rows($res)==1){
        //     $user= mysqli_fetch_assoc($res);

        // $sql= "SELECT * FROM users_info WHERE u_name='$uname'";
        // $res= mysqli_fetch_assoc($conn->query($sql));

        // // password_verify is used to check the hashed password
        // if($res && password_verify($pass, $res['password'])){
        //     $user= $res;

        // encryption to match with the db password
        $pass= md5($pass);

        $sql= "SELECT * FROM users_info WHERE u_name='$uname' and password='$pass'";
        
        // SQL imjection
        // if someone insert this into the user name space: '; DROP TABLE users_info;--
        // it will become like this: 
        // $sql= "SELECT * FROM users_info WHERE u_name=''; DROP TABLE users_info;--' and password='$pass'";
        // for that the users_info table will be deleted!!!
        $res= $conn->query($sql);

        if(mysqli_num_rows($res)==1){
            $user= mysqli_fetch_assoc($res);
            $id= $user['id'];
            $sq= "UPDATE users_info SET last_login_time=current_timestamp() WHERE id='$id'";
            $conn->query($sq);
            $_SESSION['user']= $user['name'];
            $_SESSION['userid']= $user['id'];
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
        <form method="POST" enctype="multipart/form-data">
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