<?php
    include('../controller/connection.php');
    $conn= connect();

    $user= $_SESSION['user'];
    $userid= $_SESSION['userid'];
    if(!$_SESSION['userid']){
        header("Location: ../view/login.php");
    }
    
    $sq= "SELECT * FROM users_info WHERE id='$userid'";
    $thisUser= mysqli_fetch_assoc($conn->query($sq));

    $sql= "UPDATE users_info SET last_login_time=current_timestamp() WHERE id='$userid'";
    $conn->query($sql);
    $conn->close();
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=10" >

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/navigation.css">
    </head>
    <body>
         <nav class="navbar navbar-inverse navbar-fixed-top" id="navbar-inverse">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav" style="color: white;">
                    <li><a class="<?php if($currentPage =='dashboard.php'){echo 'active';}?>" href="dashboard.php">MyInventory</a></li>
                    <li><a class="<?php if($currentPage =='product.php'){echo 'active';}?>" href="product.php">Products</a></li>
                    <li><a class="<?php if($currentPage =='user.php'){echo 'active';}?>" href="user.php">Users</a></li>
                    <?php
                    if($thisUser['is_admin']==1){
                        if($currentPage =='customer.php'){
                                 echo '<li><a class= "active" href="customer.php">Customers</a></li>';
                            }else{
                                echo '<li><a href="customer.php">Customers</a></li>';
                            }
                    }
                    ?>
                    <li style="float: right;"><a href="logout.php" style="padding: 0px 20px 0px 0px;"><button class="btn btn-danger navbar-btn pull-right">Logout</button></a></li>
                    <li class="pull-right"><a href="#">Logged in as <b class="user"><?php echo $user; ?></b></a></li>

                </ul>
            </div>
        </nav>
    </body>
</html>
