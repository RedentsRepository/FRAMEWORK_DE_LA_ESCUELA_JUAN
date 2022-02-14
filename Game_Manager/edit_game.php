<!DOCTYPE html>
<html lang="en">
<?php
    include "db_conection_modull.php";
    $gameId = $_GET['game_id'];
?>
<head>
    <title>Add game</title>
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
                <a class="nav-link" href="#"><img src="Add_16.png" alt="logo" style="width:18px;"> Add</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Disabled</a>
            </li>
        </ul>
    </nav>
    <div class="container mt-3 container-fluid" style="margin: top 100px;">
        <h3></h3>
        <h3>Test</h3>
        <p></p>
        <p></p>
        
        <form action="edit_game_2_db.php">
            <?php showGameDetailsInPlaceholderById($gameId);?>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text">Developer Name</span>
                </div>
                <select class="form-control" id="sel1" name="dev_name">
                <?php showDevelopersName(); ?>
                </select>
            
                <div class="input-group-prepend">
                <span class="input-group-text">Category</span>
                </div>
                <select class="form-control" id="sel1" name="category">
                <?php showCategories(); ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script>
        $('form').submit(function(){
        var valid = true;
            $('input[required]').each(function(i, el){
                if(valid && $(el).val()=='' ) valid = false; 
            })

        return valid;
        })
    </script>
</body>
</html>