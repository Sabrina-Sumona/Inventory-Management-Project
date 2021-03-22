<?php
    function connect(){
        // $dbHost= "localhost";
        // here mysql port is 3306
        $dbHost = "localhost:3306";
        $user= "root";
        $pass= "";
        $dbname="inventory_project";

        $conn= new mysqli($dbHost, $user, $pass, $dbname);
        //echo "connected";
        return $conn;
    }

    function closeConnect($cn){
        $cn->close();
    }
?>