<?php
    session_start();

    $currentPage = 'user.php';
    
    include "navigation.php";

    $m='';
    $conn=connect();

    $id= $_SESSION['userid'];
    if(isset($_POST['submit'])){
        // if($thisUser['password']==$_POST['pass']){
        //     $sq= "UPDATE users_info SET ";
        //     if(isset($_POST['uname'])){
        //         $uName= $_POST['uname'];
        $uname= mysqli_real_escape_string($conn, $_POST['uname']);
        $pass= mysqli_real_escape_string($conn, $_POST['pass']);
        $pass= md5($pass);
        if($thisUser['password']==$pass){
            $sq= "UPDATE users_info SET ";
            if(isset($uname)){
                $uName= $uname;
                if($uName!= $thisUser['name']){
                    $sq .= "name = '$uName',";
                }
            }
            if(isset($_POST['email'])){
                $uEmail= $_POST['email'];
                if($uName!= $thisUser['email']){
                    $sq .= "email = '$uEmail',";
                }
            }
            if(isset($_FILES['uavtr'])){
                $tmpName= $_FILES['uavtr']['tmp_name'];
                $uAvtr= $_FILES['uavtr']['name'];
                $size= $_FILES['uavtr']['size'];
                if(isset($uAvtr) &&  $uAvtr!=''){
                    if($size<5000000){
                        $format= explode('.', $uAvtr);
                        $actualName= strtolower($format[0]);
                        $actualFormat= strtolower($format[1]);
                        $allowedFormat= ['jpeg', 'jpg', 'png', 'gif'];
                        $location = 'Users/'.$actualName.'.'.$actualFormat;
                        if($actualFormat=='jpg'||$actualFormat=='jpeg'){
                            $img= imagecreatefromjpeg($tmpName);
                            $resizedImage= imagescale($img, 300,200);
                            imagejpeg($resizedImage,$location,-1);
                        } elseif($actualFormat=='png'){
                            $img= imagecreatefrompng($tmpName);
                            $resizedImage= imagescale($img, 300,200);
                            imagepng($resizedImage,$location,-1);
                        } elseif($actualFormat=='gif'){
                            $img= imagecreatefromgif($tmpName);
                            $resizedImage= imagescale($img, 300,200);
                            imagegif($resizedImage,$location,-1);
                        }
                        $sq .="avatar='$location',";
                    } else{
                    $m= "Image size should be less than 5MB";
                    }
                }
            }
            if(isset($_POST['npass'])&& $_POST['npass']!=''&& isset($_POST['cpass'])&& $_POST['cpass']!=''){
                if($_POST['npass']==$_POST['cpass']){
                    $pass= $_POST['npass'];
                    if($pass!=$thisUser['password']){
                        $sq .="password= '$pass',";
                    }
                }
            }
            $sq= substr($sq, 0,-1);
            $sq .=" WHERE id='$id'";
            $conn->query($sq);
            $m= 'Users Information Successfully Updated!';
        } else{
            $m= "Credentials mismatch!";
        }
    }
    $sql= "SELECT * from users_info";
    $res= $conn->query($sql);
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
        <div class="row" style="padding: 40px;">
            <div class="leftcolumn">
                <?php include('product_cards.php')?>
                <div class="card">
                    <div class="text-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateInfo">
                            Update Your Info
                        </button>
                        <h4 style="color: green"><?php echo $m; ?></h4>
                        <div class="modal fade" id="updateInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button style="background-color: white;"type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h2 class="modal-title" id="exampleModalScrollableTitle" style="color: white;"><?php echo $thisUser['name']; ?></h2>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="user.php" enctype="multipart/form-data">
                                            <div class="form-group pt-20">
                                                <div class="col-sm-4">
                                                    <label for="uname" class="pr-10"> User Name</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input name="uname" type="text" class="login-input" placeholder="User Name" id="uname" value="<?php echo $thisUser['name']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group pt-20">
                                                <div class="col-sm-4">
                                                    <label for="email" class="pr-10"> Email </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input name="email" type="email" class="login-input" placeholder="Email Address" value="<?php echo $thisUser['email']; ?>" id="email" required>
                                                </div>
                                            </div>
                                            <div class="form-group pt-20">
                                                <div class="col-sm-4">
                                                    <label for="uavtr" class="pr-10"> User Avatar</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="pl-20 pull-left">
                                                        <input style="color: black;border-radius: 2px;width: 230px;height: 44px;border: none;padding: 15px 20px;margin-bottom: 24px;" name="uavtr" type="file" id="uavtr">
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="form-group pt-20">
                                                <div class="col-sm-4">
                                                    <label for="pass" class="pr-10"> Password</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input name="pass" class="login-input" type="password" id="pass" required>
                                                </div>
                                            </div>
                                            <div class="form-group pt-20">
                                                <div class="col-sm-4">
                                                    <label for="npass" class="pr-10">New Password</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input name="npass" class="login-input" type="text" id="npass" >
                                                </div>
                                            </div>
                                            <div class="form-group pt-20">
                                                <div class="col-sm-4">
                                                    <label for="cpass" class="pr-10">Confirm New Password</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input name="cpass" class="login-input" type="text" id="cpass" >
                                                </div>
                                            </div>
                                            <div class="form-group" style="text-align: center;">
                                                <button type="submit" value="submit" name="submit" class="btn btn-success">Change</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table_container">
                        <h1 style="text-align: center; color:white;">Users Table</h1>
                        <div class="table-responsive">
                            <table class="table table-dark" id="table" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead class="thead-light">
                                    <tr>
                                        <th data-field="date" data-filter-control="select" data-sortable="true">User</th>
                                        <th data-field="examen" data-filter-control="select" data-sortable="true"> Email</th>
                                        <th data-field="note" data-sortable="true">Is Active</th>
                                        <?php
                                            if($thisUser['is_admin']==1){
                                                echo '<th data-field="note" data-sortable="true">Last Login Time</th>';
                                                echo '<th data-field="note" data-sortable="true">Action</th>';
                                            }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(mysqli_num_rows($res)>0) {
                                        while ($row = mysqli_fetch_assoc($res)) {

                                            echo '<tr>';
                                            echo '<td>'. $row['name'].'</td>';
                                            echo '<td>'. $row['email'].'</td>';
                                            if($row['is_active']=='1'){
                                                $active= "Active";
                                            } else{
                                                $active= "Inactive";
                                            }
                                            echo '<td>' . $active . '</td>';
                                            if($thisUser['is_admin']==1) {
                                                echo '<td>'. date("Y-m-d h:i:sa",strtotime($row['last_login_time'])).'</td>';
                                                echo "<td><a href='viewUser.php?id=".$row['id']."' class='btn btn-success btn-sm'>".
                                                    "<span class='glyphicon glyphicon-eye-open'></span> </a>";
                                            }
                                            echo '</tr>';
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