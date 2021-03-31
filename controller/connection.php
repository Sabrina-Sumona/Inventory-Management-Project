<?php
    function connect(){
        // $dbHost= "localhost";
        // here mysql port is 3306
        $dbHost = "localhost:3306";
        $user= "sabrina_sumona";
        $pass= "sns963147";
        $dbname="inventory_project";

        $conn= new mysqli($dbHost, $user, $pass, $dbname);
        //echo "connected";
        return $conn;
    }

    function closeConnect($cn){
        $cn->close();
    }
?>