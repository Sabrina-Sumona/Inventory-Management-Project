<?php
    session_start();

    $currentPage = 'product.php';
    
    include "navigation.php";

    $m='';
    $conn=connect();

    $id= $_SESSION['userid'];
    $sq= "SELECT * FROM users_info WHERE id='$id'";
    $thisUser= mysqli_fetch_assoc($conn->query($sq));

    $sqa= "SELECT * FROM users_info WHERE is_admin='1'";
    $admin= mysqli_fetch_assoc($conn->query($sqa));

    if(isset($_GET['id'])){
        $id= $_GET['id'];
        $sql= "SELECT * from products WHERE id='$id' limit 1";
        $res= mysqli_fetch_assoc($conn->query($sql));

        $img= $res['image'];
    }elseif(isset($_POST['id'])){
        $id =$_POST['id'];
        $pName= $_POST['pname'];
        $buy= intval($_POST['buy']);
        $sell= intval($_POST['sell']);

        if($buy>=$sell){
            if(isset($_POST['Submit'])){
                $sql= "UPDATE products SET name= '$pName', bought= '$buy', sold= '$sell' WHERE id = '$id'";
                if($conn->query($sql)===true){
                    $m= "Field Updated!";
                    header("Location: product.php");
                } else{
                    $m= "Connection Failure!";
                    header("Location: editProduct.php?id=$id");
                }
            }
        } else{
            $m= "Buy quantity should be larger than Sell quantity!";
            header("Location: editProduct.php?id=$id");
        }
    }

    $sql= "SELECT COUNT(id) as total_products from products";
    $total_product= mysqli_fetch_assoc($conn->query($sql));

    $sql= "SELECT SUM(bought) as total_buy from products";
    $total_buy= mysqli_fetch_assoc($conn->query($sql));

    $sql= "SELECT SUM(sold) as total_sell from products";
    $total_sell= mysqli_fetch_assoc($conn->query($sql));
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
        <title> Products </title>
    </head>

     <body>
        <div class="row" style="padding: 50px;">
            <div class="leftcolumn">
                <div class="row">
                    <section style="padding-left: 20px; padding-right: 20px;">
                        <div class="col-sm-3">
                            <div class="card card-green">
                                <h3>Total<br>Products</h3>
                                <h2 style="color: #282828; text-align: center;"><?php echo $total_product?$total_product['total_products']: 'No Products available in stock'; ?></h2>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card card-yellow" >
                                <h3>Products<br>Bought</h3>
                                <h2 style="color: #282828; text-align: center;"><?php echo $total_buy?$total_buy['total_buy']: 'You haven\'t bought anything yet'; ?></h2>
                            </div>
                        </div>
                        <div class="col-sm-3 " >
                            <div class="card card-blue" >
                                <h3>Products<br>Sold</h3>
                                <h2 style="color: #282828; text-align: center;"><?php echo $total_sell?$total_sell['total_sell']: 'You haven\'t sold anything yet'; ?></h2>
                            </div>
                        </div>
                        <div class="col-sm-3" >
                            <div class="card card-red" >
                                <h3>Available<br>Stock</h3>
                                <h2 style="color: #282828; text-align: center;"><?php echo $total_buy?$total_buy['total_buy']-$total_sell['total_sell']: 'You haven\'t invested anything yet'; ?></h2>
                            </div>
                        </div>
                    </section>
                </div>
            <div class="pt-20 pl-20">
                <div class="col-sm-12" style="background-color: white; border: solid rgb(0, 162, 255);">
                    <div class="text-center">
                        <h1 style="color:#130553;"> Edit Product</h1>
                        <h4 style="color: red;"> <?php echo $m; ?> </h4>
                    </div>
                    <div class="row p-20" >
                        <div class="row col-sm-6">
                            <div class="col-sm-6 p-20 pull-left" >
                                <img src="<?php echo $img; ?>" height="250" width="250">
                            </div>
                        </div>
                        <form method="POST" action="editProduct.php" class="row">
                            <div class="row col-sm-6">
                                <h4 class="pull-left col-sm-6">Name:</h4>
                                <div class="col-sm-6">
                                    <h4  class="pull-left" style="color: black;"><input type="text" class="login-input"  name="pname" value="<?php echo $res['name']; ?>" placeholder="Product Name"></h4>
                                </div>
                            </div>
                            <div class="row col-sm-6">
                                <h4 class="pull-left col-sm-6">Buy Quantity:</h4>
                                <div class="col-sm-6">
                                    <h4  class="pull-left" style="color: black;"><input type="text" class="login-input" name="buy" value="<?php echo $res['bought']; ?>" placeholder="Buy Quantity"></h4>
                                </div>
                            </div>
                            <div class="row col-sm-6">
                                <h4 class="pull-left col-sm-6">Sell Quantity:</h4>
                                <div class="col-sm-6">
                                    <h4  class="pull-left" style="color: black;"><input type="text" class="login-input" name="sell" value="<?php echo $res['sold']; ?>" placeholder="Sell Quantity"></h4>
                                </div>
                            </div>
                            <input type="hidden" value="<?php echo $id; ?>" name="id">
                            <div class="row col-sm-6 text-center" style="padding: 20px">
                                <div class="col-sm-6">
                                    <input class="btn btn-success" type="submit" name="Submit" value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>                               
                </div>
        </div>

        </div>
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
        </div>

    <?php include('footer.php')?>

    </body>
</html>