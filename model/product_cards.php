<?php
    $sql= "SELECT COUNT(*) as products FROM products";
    $total_products= mysqli_fetch_assoc($conn->query($sql));

    $sql= "SELECT SUM(bought) as total_bought FROM products";
    $total_bought= mysqli_fetch_assoc($conn->query($sql));

    $sql= "SELECT SUM(sold) as total_sold FROM products";
    $total_sold= mysqli_fetch_assoc($conn->query($sql));

    $stock_available= $total_bought['total_bought']-$total_sold['total_sold'];
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
         <div class="row">
            <section style="padding: 20px;">
                <div class="col-sm-3">
                    <div class="card card-green">
                        <h3>Total<br>Products</h3>
                        <h2 style="color: #282828; text-align: center;"><?php echo $total_products['products'] ?></h2>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-yellow" >
                        <h3>Products<br>Bought</h3>
                        <h2 style="color: #282828; text-align: center;"><?php echo $total_bought['total_bought'] ?></h2>
                    </div>
                </div>
                <div class="col-sm-3 " >
                    <div class="card card-blue" >
                        <h3>Products<br>Sold</h3>
                        <h2 style="color: #282828; text-align: center;"><?php echo $total_sold['total_sold'] ?></h2>
                    </div>
                </div>
                <div class="col-sm-3" >
                    <div class="card card-red" >
                        <h3>Available<br>Stock</h3>
                        <h2 style="color: #282828; text-align: center;"><?php echo $stock_available ?></h2>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>