<?php
?>
<html>
    <head>
        <title>Registration Form</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link type="text/css" rel="stylesheet" href="css/registration.css">
    </head>

    
    <body>
        <form method="POST" action="register.php" enctype="multiport/form-data">
            <div class="container">
                <!-- <span><?php if($m!='') echo $m; ?></span> -->
                <h1>Registration Form</h1>
                <hr>
                <div>
                    <label for="name">Your Name<span>*</span></label>
                    <input name="name" id="name" type="text" placeholder="Enter Your Name" required>
                </div>
                <div>
                    <label for="uname">Your Username<span>*</span></label>
                    <input name="uname" id="uname" type="text" placeholder="Enter Your Username" required>
                </div>
                <div>
                    <label for="email">Your Email</label>
                    <input name="email" id="email" type="text" placeholder="Enter Your Email">
                </div>
                <div>   
                    <label for="password">Password<span>*</span></label>
                    <input name="password" id="password" type="password" placeholder="Enter A Password" required>
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
</html>