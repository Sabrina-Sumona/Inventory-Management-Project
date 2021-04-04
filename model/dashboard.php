<?php
    session_start();

    $currentPage = 'dashboard.php';
    include "navigation.php";
    
    $date= date('Y-m-d', strtotime('-7 days'));
    $conn = connect();
    
    $sql= "SELECT * from products WHERE updated_at>'$date'";
    $prod= $conn->query($sql);
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
                <?php include('product_cards.php')?>
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
            <?php include('side_info.php')?>
        </div>
        <?php include('footer.php')?>
    </body>
</html>