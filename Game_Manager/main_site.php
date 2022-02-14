<!DOCTYPE html>
<html lang="en">
<?php
    include "db_conection_modull.php";
?>
<head>
    <title>Game Manager</title>
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
    <div class="container-fluid table-responsive" style="margin-top:80px" >
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><img src="checkName_16.png" alt="logo" style="width:20px;"></span>
            </div>
            <input class="form-control" id="mySearch" type="text" placeholder="Write somenthing to find...">
        </div>
        <?php  
            schowGames();
        ?>
    </div>
    <script>
    $(document).ready(function(){
        $("#mySearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#dbGames tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    </script>
</body>
</html>