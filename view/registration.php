<?php
    include '../controller/connection.php';
    $conn= connect();
    // closeConnect($conn);
    // m is the message
    $m='';
    // _POST is a built-in global variable of php
    if(isset($_POST['submit'])){
       $name= $_POST['name'];
       $uname= $_POST['uname'];
       // if there is no email it takes an empty string as input
       $email= $_POST['email']?$_POST['email']:'';
       $pass= $_POST['password'];
       $rPass= $_POST['rpassword'];
       // === checks both value & type of both sides matches or not
       if($pass===$rPass){
            // // PASSWORD_DEFAULT is one kind of hashing method, there are several methods like this in hashing
            // $pass= password_hash($pass, PASSWORD_DEFAULT);

           // md5 is one kind of encryption method
           $pass= md5($pass);
           // difference btwn encrytion & hashing: different hashed value can be generated from a password but we can regain it
           // where one password always encrypted into same but regain it is very difficult
           $sq= "INSERT INTO users_info(name, u_name, email, password) VALUES('$name', '$uname', '$email','$pass')";
           if($conn->query($sq)===true){
               header('Location: login.php');
           }
           else{
               $m='Connection not established!';
           }
       }
       else {
           $m= "Passwords don't match!";
       }
    }
?>
<html>
    <head>
        <title>Registration Form</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link type="text/css" rel="stylesheet" href="../css/registration.css">
    </head>

    
    <body>
    <!-- The GET method is used to submit the HTML form data. This data is collected by the predefined $_GET variable for processing. -->
    <!-- The information sent from an HTML form using the GET method is visible to everyone in the browser's address bar, which means that all the variable names and their values will be displayed in the URL. Therefore, the get method is not secured to send sensitive information. -->
    <!-- Similar to the GET method, the POST method is also used to submit the HTML form data. But the data submitted by this method is collected by the predefined superglobal variable $_POST instead of $_GET. -->
    <!-- Unlike the GET method, it does not have a limit on the amount of information to be sent. The information sent from an HTML form using the POST method is not visible to anyone. -->
        <form method="POST" action="registration.php" enctype="multipart/form-data">
            <div class="container reg">
                <!-- message -->
                <span>
                    <?php 
                        if($m!='') 
                            echo $m; 
                    ?>
                </span>
                <h1>Registration Form</h1>
                <hr>
                <div>
                    <label for="name">Your Name<span>*</span></label>
                    <input name="name" id="name" type="text" placeholder="Enter Your Name" required>
                </div>
                <div>
                    <label for="uname">Your Username<span>*</span></label>
                    <input name="uname" id="uname" type="text" placeholder="Enter Your Username" onchange="checkUsername(this.value); checkUser(this.value);" required>
                    <small id="checktext"></small>
                    <small id="checkuser"></small>
                </div>
                <div>
                    <label for="email">Your Email</label>
                    <input name="email" id="email" type="text" placeholder="Enter Your Email" onchange="checkUsermail(this.value);">
                    <small id="checkmail"></small>
                </div>
                <div>   
                    <label for="password">Password<span>*</span></label>
                    <input name="password" id="password" type="password" placeholder="Enter A Password" onchange="checkUserpass(this.value);" required>
                    <small id="checkpass"></small>
                 </div>
                 <div>
                     <label for="rpassword">Password Confirmation<span>*</span></label>
                     <input name="rpassword" id="rpassword" type="password" placeholder="Repeat the Password" required>
                 </div>
                 <div style="text-align: center">
                     <p><span>***</span>By creating an account you agree to our Terms & Conditions.</p>
                 </div>
                 <div style="text-align: center; padding: 20px;">
                     <input type="submit" class="btn btn-success" value="Submit" name="submit">  
                 </div>
                 <div style="text-align: center;">
                     <p>Already have an account? 
                        <br>
                        <a href="login.php">
                            <input  type="button" class="btn btn-primary" value="signin">
                        </a>
                    </p>
                 </div>
            </div>
        </form>
    </body>
    <script type="text/javascript" src="../js/script.js"></script>
</html>

<script>
    window.onload= function(){
          document.getElementsByClassName('reg')[0].style.color='whitesmoke';
    };
</script>
<script>
    // using jquery
    $(document).ready(function(){
        $('.reg').css('color', 'whitesmoke');
        // document.getElementsByClassName('reg')[0].style.color='whitesmoke';
    });
    /*window.onload= function(){
          document.getElementsByClassName('reg')[0].style.color='whitesmoke';
    };*/
</script>