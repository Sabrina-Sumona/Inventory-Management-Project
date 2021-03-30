<?php
    session_start();
    $user= $_SESSION['user'];
    $userid= $_SESSION['userid'];

    $currentPage = 'user.php';
    include "../controller/connection.php";
    include "navigation.php";
?>

<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=10" >

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/user.css">
        <link rel="stylesheet" type="text/css" href="../css/navigation.css">
        <title>Users</title>
    </head>
<body>
</body>
</html>