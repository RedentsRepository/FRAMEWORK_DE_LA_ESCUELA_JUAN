<?php
    include 'db_conection_modull.php';
    #addGame("Test","Unknown","2002-1-26");
    #deleteGameById(4);

    #showGameDetailsById(1);
?>

<form action="#">
    <?php showGameDetailsInPlaceholderById(1);?>
    <input type="hidden">
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