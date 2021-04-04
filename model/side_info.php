<?php
    $sq= "SELECT * FROM users_info WHERE id='$userid'";
    $thisUser= mysqli_fetch_assoc($conn->query($sq));
    
    $sqa= "SELECT * FROM users_info WHERE is_admin='1'";
    $admin= mysqli_fetch_assoc($conn->query($sqa));
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=10" >

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/product.css">
    </head>
    <body>
         <div class="rightcolumn">
            <div class="card text-center" >
                <h2>About User</h2>
                <div style="height:100px;"><img src="<?php echo $thisUser['avatar']; ?>" height="100px;" width="100px;" class="img-circle" alt="Please Select your avatar"></div>
                <p><h4><?php echo $thisUser['name'];  ?></h4> is working in HAPPY SHOP since <h4><?php echo date('F j, Y', strtotime($thisUser['created_at'])); ?></h4></p>
            </div>
            <div class="card text-center">
                <h2>Owner's Info</h2>
                <div style="height:100px;"><img src="<?php echo $admin['avatar']; ?>" height="100px;" width="100px;" class="img-circle" alt="Owner"></div>
                <p><h4><?php echo $admin['name'];  ?></h4> is the owner of HAPPY SHOP</p>
            </div>
        </div>
    </body>
</html>