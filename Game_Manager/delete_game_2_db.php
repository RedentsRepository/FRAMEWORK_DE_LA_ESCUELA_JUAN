<?php
    include "db_conection_modull.php";
    deleteGameById($_GET['game_id']);
    redirect("main_site.php");
?> 