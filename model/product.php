<?php
    session_start();
    $user= $_SESSION['user'];
    $userid= $_SESSION['userid'];

    $currentPage = 'product.php';
    
    include "navigation.php";
    include "../controller/connection.php";

    $m='';
    $conn=connect();

    if(isset($_POST['submit'])){
        $pName= $_POST['pname'];
        $buy= $_POST['buy'];
        $img= $_FILES['pimage'];
        $iName= $img['name'];
        $tempName= $img['tmp_name'];
        $format= explode('.', $iName);
        $actualName= strtolower($format[0]);
        $actualFormat= strtolower($format[1]);
        $allowedFormats= ['jpg', 'png', 'jpeg', 'gif'];

        if(in_array($actualFormat, $allowedFormats)){
            $location= 'Uploads/'.$actualName.'.'.$actualFormat;
            $sql= "INSERT INTO products(name, bought, image, created_at) VALUES ('$pName', '$buy', '$location', current_timestamp())";
            if($conn->query($sql)===true){
                move_uploaded_file($tempName, $location);
                $m= "Product Inserted!";
            }
        }

    }

    $sql= "SELECT * from products";
    $res= $conn->query($sql);

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
                <div class="card">
                    <div class="text-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProduct">
                            Add New Product
                        </button>
                        <h4 style="color: green"><?php echo $m; ?></h4>
                        <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <button style="background-color: #ffce00;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h2 class="modal-title" id="exampleModalScrollableTitle">Add New Product</h2>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="product.php" enctype="multipart/form-data">
                                            <div class="form-group pt-20">
                                                <div class="col-sm-4">
                                                    <label for="name" class="pr-10"> Product Name</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input name="pname" type="text" class="login-input" placeholder="Product Name" id="name" required>
                                                </div>
                                            </div>
                                            <div class="form-group pt-20">
                                                <div class="col-sm-4">
                                                    <label for="buy" class="pr-10"> Buying Amount</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input name="buy" type="text" class="login-input" placeholder="Buying Amount" id="buy" required>
                                                </div>
                                            </div>
                                            <div class="form-group pt-20">
                                                <div class="col-sm-4">
                                                    <label for="pimage" class="pr-10"> Product Image</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input name="pimage" class="pl-20" type="file" id="pimage" required>
                                                </div>
                                            </div>
                                            <div class="form-group" style="text-align: center;">
                                                <button type="submit" value="submit" name="submit" class="btn btn-success">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table_container">
                        <h1 style="text-align: center; color:white;">Products Table</h1>
                        <div class="table-responsive">
                            <table class="table table-dark" id="table" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead class="thead-light">
                                <tr>
                                    <th data-field="name" data-filter-control="select" data-sortable="true">Product Name</th>
                                    <th data-field="bought" data-filter-control="select" data-sortable="true"> Bought</th>
                                    <th data-field="sold" data-sortable="true">Sold</th>
                                    <th data-field="stock" data-sortable="true">Available in Stock</th>
                                    <th data-field="actions" data-sortable="true"> Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(mysqli_num_rows($res)>0){
                                            while($row= mysqli_fetch_assoc($res)){
                                                $stock= $row['bought']-$row['sold'];
                                                echo "<tr>";
                                                echo "<td>".$row['name']."</td>";

                                                echo "<td>".$row['bought']."</td>";

                                                echo "<td>".$row['sold']."</td>";

                                                echo "<td>".$stock."</td>";

                                                echo "<td><a href='viewProduct.php?id=".$row['id']."' class='btn btn-success btn-sm'>".
                                                    "<span class='glyphicon glyphicon-eye-open'></span> </a>";
                                                echo "<a href='editProduct.php?id=".$row['id']."' class='btn btn-warning btn-sm'>".
                                                    "<span class='glyphicon glyphicon-pencil'></span> </a>";
                                                echo "<a href='deleteProduct.php?id=".$row['id']."' class='btn btn-danger btn-sm'>".
                                                    "<span class='glyphicon glyphicon-trash'></span> </a></td>";

                                            }
                                        } else{
                                            echo "No results found!";
                                        }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="rightcolumn">
                <div class="card">
                    <h2>About Us</h2>
                    <div class="fakeimg" style="height:100px;">Image</div>
                    <p>Some texts about this inventory management software.</p>
                </div>
                <div class="card">
                    <h2>Owners Info</h2>
                    <p>Some text..</p>
                </div>
            </div>
        </div>

        <?php include('footer.php')?> -->

</body>
</html>