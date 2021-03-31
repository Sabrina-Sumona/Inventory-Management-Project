<?php
    session_start();
    $user= $_SESSION['user'];
    $userid= $_SESSION['userid'];

    $currentPage = 'dashboard.php';
    include "navigation.php";
    
    $date= date('Y-m-d', strtotime('-7 days'));
    $conn = connect();
    
    $sq= "SELECT * FROM users_info WHERE id='$userid'";
    $thisUser= mysqli_fetch_assoc($conn->query($sq));
    
    $sqa= "SELECT * FROM users_info WHERE is_admin='1'";
    $admin= mysqli_fetch_assoc($conn->query($sqa));

    $sql= "SELECT * from products WHERE updated_at>'$date'";
    $prod= $conn->query($sql);

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
        <link rel="stylesheet" type="text/css" href="../css/navigation.css">
        <title>Dashboard</title>
    </head>
<body>
<div class="row" style="padding: 40px;">
    <div class="leftcolumn">
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
        <div class="card">
            <div class="table_container">
                <h1 style="text-align: center; color: white">Products Table</h1>
                <div class="table-responsive">
                    <table class="table table-dark" id="table" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                        <thead class="thead-light">
                        <tr>
                            <th data-field="date" data-filter-control="select" data-sortable="true">Product Name</th>
                            <th data-field="examen" data-filter-control="select" data-sortable="true"> Bought</th>
                            <th data-field="note" data-sortable="true">Sold</th>
                            <th data-field="note" data-sortable="true">Available in Stock</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(mysqli_num_rows($prod)>0){
                                while($row= mysqli_fetch_assoc($prod)){
                                    $stock= $row['bought']-$row['sold'];
                                    echo "<tr>";
                                    echo "<td>".$row['name']."</td>";

                                    echo "<td>".$row['bought']."</td>";

                                    echo "<td>".$row['sold']."</td>";

                                    echo "<td>".$stock."</td>";
                                }
                            }

                        ?>
                        </tbody>
                    </table>
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
                <div style="height:100px;"><img src="<?php echo $admin['avatar']; ?>" height="100px;" width="100px;" class="img-circle" alt="Please Select your avatar"></div>
                <p><h4><?php echo $admin['name'];  ?></h4> is the owner of HAPPY SHOP</p>
            </div>
        </div>
</div>

<?php include('footer.php')?>

</body>
</html>