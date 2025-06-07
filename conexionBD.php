<?php
    $servername = "127.0.0.1";
    $username = "Onlyvan";
    $password = "IvAnFR13579";
    $dbname = "spotlife";

    try{
        $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch(PDOException $e){
        
        echo "Fallo al conectarse a la base de datos " . $e->getMessage();

    }
?>