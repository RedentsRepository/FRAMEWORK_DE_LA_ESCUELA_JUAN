<script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script data-require="bootstrap@*" data-semver="3.1.1" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link data-require="bootstrap-css@3.1.1" data-semver="3.1.1" rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
<link rel="stylesheet" href="style.css" />
<script src="script.js"></script>
<?php
include 'config.php';

if(isset($_POST['deleteIt'])) {
    $recetaId = $_POST['recetaId'];

    $query4 = 'delete from receta where receta_id = ?';

    try {
        $stmt4 = $con->prepare($query4);
        $stmt4->execute([$recetaId]);


    }catch (Exception $e)
    {
        echo $e->getMessage();
    }

}
if(!isset($_POST['showIt'])){
    echo '<h1>Recetas</h1>
          <p>Aqui estan todas las recetas guardadas</p>';
    echo '<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                    </div>
                
                    <div class="modal-body">
                        <p>You are about to delete one track, this procedure is irreversible.</p>
                        <p>Do you want to proceed?</p>
                        <p class="debug-url"></p>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger btn-ok">Delete</a>
                    </div>
                </div>
            </div>
           </div>';
    include 'config.php';

    $query = 'select r.receta_id ID,r.name Receta, count(rein.rein_id) Ingredientes
                from receta r, receta_ingrediente rein
               where r.receta_id = rein.receta_id
               group by receta
               order by ID';

    try
    {
        $stmt = $con->prepare($query);
        $stmt->execute();
        $columnCount = $stmt->columnCount();
        $meta = array();
        echo '<table border="1" class="table"><thead><tr>';

        for ($i = 0; $i < $columnCount; $i++)
        {
            $meta[] = $stmt->getColumnMeta($i);
            echo '<th>'.$meta[$i]['name'].'</th>';
        }
        echo '</tr></thead>';
        while ($row = $stmt->fetch(PDO::FETCH_NUM))
        {
            echo '<tr>';

            foreach ($row as $r)
            {
                echo '<td>'.$r.'</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }


    ?>
    <form method="post">
        <label for="nrec">Administrar Receta:</label>
    <?php
    try {
        $stmt1 = $con->prepare($query);

        $stmt1->execute();


        $columnCount1 = $stmt1->columnCount();
        $meta = array();
        for ($i = 0; $i < $columnCount1; $i++) {
            $meta[] = $stmt1->getColumnMeta($i);
        }
        echo '<select name="recetaId">';
        while ($row = $stmt1->fetch(PDO::FETCH_NUM)) {

            echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';

        }
        echo '</select>';

    } catch (Exception $e) {
        echo $e->getMessage();
    }

    echo '<br>
          <input type="submit" class="btn btn-info" name="showIt" value="Ver">
          <input type="submit" class="btn btn-warning" name="editIt"  value="Editar">
          <input type="submit" class="btn btn-danger" name="deleteIt"  value="Borrar">
      </form>';
    //echo '<button class="btn btn-danger" name="deleteIt" data-href="/delete.php?id=54" data-toggle="modal" data-target="#confirm-delete">borrar</button>';
}
else{

    $recetaId = $_POST['recetaId'];

    $query2 = 'select i.name ingrediente, rein.cantidad, m.name medida 
  from receta r, receta_ingrediente rein, ingrediente i, medida m
 where r.receta_id = rein.receta_id
   and rein.ingrediente_id = i.ingrediente_id
   and rein.medida_id = m.medida_id
   and rein.receta_id = ?';

    $query3 = 'select distinct(r.name) receta
  from receta r, receta_ingrediente rein
 where r.receta_id = rein.receta_id
   and rein.receta_id = ?;';

    try
    {
        $stmt2 = $con->prepare($query2);
        $stmt3 = $con->prepare($query3);
        $stmt2->execute([$recetaId]);
        $stmt3->execute([$recetaId]);
        $columnCount2 = $stmt2->columnCount();
        while ($row = $stmt3->fetch(PDO::FETCH_NUM))
        {
            echo '<h1>'.$row[0].'</h1>';
        }


        $meta = array();
        echo '<table border="1" class="table"><thead><tr>';

        for ($i = 0; $i < $columnCount2; $i++)
        {
            $meta[] = $stmt2->getColumnMeta($i);
            echo '<th>'.$meta[$i]['name'].'</th>';
        }
        echo '</tr></thead>';
        while ($row = $stmt2->fetch(PDO::FETCH_NUM))
        {
            echo '<tr>';

            foreach ($row as $r)
            {
                echo '<td>'.$r.'</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }


}


?>
        <script>
            $('#confirm-delete').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

                $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
            });
        </script>
