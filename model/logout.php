<?php
    session_start();
    session_destroy();
    // echo $_SESSION['user'];
    header('Location: ../view/login.php');
?>