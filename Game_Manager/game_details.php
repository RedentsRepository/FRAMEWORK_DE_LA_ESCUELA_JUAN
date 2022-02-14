<!DOCTYPE html>
<html lang="en">
    <?php
    include "db_conection_modull.php";
    $gameId = $_GET['game_id'];
    ?>
<head>
    <link rel="stylesheet" type="text/css" href="desing.css" />
    <title>Game Details</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="main_site.php"><img src="TGW_LOGO_16.png" alt="logo" style="width:80px;"></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="main_site.php">Games</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add_game.php"><img src="Add_16.png" alt="logo" style="width:18px;"> Add</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Disabled</a>
                
            </li>
        </ul>
    </nav>
    <div class="container" style="margin-top: 80px">
        <div class="team-single">
            <div class="row">
                <div class="col-lg-4 col-md-5 xs-margin-30px-bottom">
                    <div class="team-single-img">
                        <img src="https://cdn1.epicgames.com/salesEvent/salesEvent/17BR_S17_Launcher_EGS_Blade_1200x1600_1201x1600-711dd5f589b12dc04d79312bbb4ce4f3" alt="GamePicture">
                    </div>
                    <div class="bg-light-gray padding-30px-all md-padding-25px-all sm-padding-20px-all text-center">
                        <h4 class="margin-10px-bottom font-size24 md-font-size22 sm-font-size20 font-weight-600">Game Name</h4>
                        <p class="sm-width-95 sm-margin-auto">Here can be more <strong>info of the game!</strong></p>
                        <div class="margin-20px-top team-single-icons">
                            <ul class="no-margin">
                                <?php getUpdateAndDeleteLink($gameId);?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-7">
                    <div class="team-single-text padding-50px-left sm-no-padding-left">
                        <?php showGameDetailsById($gameId);?>
                    </div>
                </div>

                <div class="col-md-12">

                </div>
            </div>
        </div>
    </div>
    </body>
</html>