<?php
    /*Verbindung zur Datenbank herstellen */
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "recetas";
    $conn = "";
    try {
        $con = new PDO('mysql:host='.$server.';
            dbname='.$db.';charset=utf8', $user, $password);
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        echo 'verbindung erstellt';
        $conn = $con;
    }catch (Exception $e)
    {
        switch ($e->getCode())
        {
            case 1045:
                echo "Kein Zugriff für de Benutzer - ".$e->getMessage();
                break;
            default:
                echo $e->getCode().''.$e ->getMessage();

        }
    }

?>