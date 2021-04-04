<?php
    session_start();

    $currentPage = 'user.php';

    include "navigation.php";
    $conn= connect();

    if(isset($_GET['id'])){
        $id= $_GET['id'];

        $sql= "SELECT * from users_info WHERE id=$id limit 1";
        $res= mysqli_fetch_assoc($conn->query($sql));

        $img= $res['avatar'];
    }

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
        <link rel="stylesheet" type="text/css" href="../css/navigation.css">
        <title> Users </title>
    </head>

    <body>
        <div class="row" style="padding: 50px;">
            <div class="leftcolumn">
                <?php include('product_cards.php')?>
                <div class="pt-20 pl-20">
                    <div class="col-sm-12" style="background-color: white; border: solid rgb(0, 162, 255);">
                        <div class="text-center">
                            <h1 style="color:#130553;"> User Details</h1>
                        </div>
                        <div class="row p-20" >
                            <div class="row col-sm-6">
                                <div class="col-sm-6 p-20 pull-left" >
                                    <img src="<?php echo $img; ?>" height="250" width="250">
                                </div>
                            </div>
                            <div class="row col-sm-6">
                                <h4 class="pull-left col-sm-6">Name:</h4>
                                <div class="col-sm-6">
                                    <h4  class="pull-left" style="color: black;"><?php echo ucwords($res['name']) ?></h4>
                                </div>
                            </div>
                            <div class="row col-sm-6">
                                <h4 class="pull-left col-sm-6">Email:</h4>
                                <div class="col-sm-6">
                                    <h4  class="pull-left" style="color: black;"><?php echo $res['email']?></h4>
                                </div>
                            </div>
                            <div class="row col-sm-6">
                                <h4 class="pull-left col-sm-6">Status:</h4>
                                <div class="col-sm-6">
                                    <h4  class="pull-left" style="color: black;">
                                        <?php 
                                            if($res['is_active']=='1'){
                                                $active= "Active";
                                            } else{
                                                $active= "Inactive";
                                            }
                                            echo $active;
                                        ?>
                                    </h4>
                                </div>
                            </div>
                            <div class="row col-sm-6">
                                <h4 class="pull-left col-sm-6">Position:</h4>
                                <div class="col-sm-6">
                                    <h4  class="pull-left" style="color: black;">
                                        <?php 
                                            if($res['is_admin']=='1'){
                                                $postion= "Admin";
                                            } else{
                                                $postion= "Manager";
                                            }
                                            echo $postion;
                                        ?>
                                    </h4>
                                </div>
                            </div>
                            <div class="row  col-sm-6">
                                <h4 class="pull-left col-sm-6">Work since:</h4>
                                <div class="col-sm-6">
                                    <h4  class="pull-left" style="color: black;"><?php echo date("F j, Y",strtotime(str_replace('-','/', $res['created_at'])))?></h4>
                                </div>
                            </div>
                            <div class="row col-sm-6">
                                <h4 class="pull-left col-sm-6">Last Login:</h4>
                                <div class="col-sm-6">
                                    <h4  class="pull-left" style="color: black;"><?php echo date("Y-m-d h:i:sa",strtotime($res['last_login_time']))?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('side_info.php')?>
        </div>
        <?php include('footer.php')?>
    </body>
</html>