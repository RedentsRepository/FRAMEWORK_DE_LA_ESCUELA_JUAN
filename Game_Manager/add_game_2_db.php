<?php
    include "db_conection_modull.php";
    
    $name = explode(" ", $_GET['dev_name']);
    $totalTime = $_GET['played_time_seconds'] + ($_GET['played_time_days'] * 86400) + ($_GET['played_time_hours'] * 3600) + ($_GET['played_time_minutes'] * 60);
    addGame($_GET['game_name'], $_GET['category'], $_GET['release_date'], $name[0], $name[1], $totalTime);
    redirect("main_site.php");
?> 