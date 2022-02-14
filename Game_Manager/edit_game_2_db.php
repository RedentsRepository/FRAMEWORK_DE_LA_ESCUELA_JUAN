<?php
    include "db_conection_modull.php";
    
    $gameId = $_GET['gameId'];
    $name = explode(" ", $_GET['dev_name']);
    $totalTime = $_GET['played_time_seconds'] + ($_GET['played_time_days'] * 86400) + ($_GET['played_time_hours'] * 3600) + ($_GET['played_time_minutes'] * 60);
    updateGameById($gameId, $_GET['game_name'], $_GET['category'], $_GET['release_date'], $name[0], $name[1], $totalTime );
    redirect("game_details.php?game_id=$gameId");
?> 