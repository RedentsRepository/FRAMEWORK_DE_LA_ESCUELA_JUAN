<?php
echo '
<h1>Añadir Receta</h1>
<p>Esto es un texto de prueba</p>';
echo '<h2>Escriba el nombre de la receta y la cantidad de ingredientes que lleva</h2>';
include 'config.php';



if(isset($_POST['saveing']))
{
    $medida = [];
    $cantidad = [];
    $pkrec = $_POST['pkReceta'];
    $ingrediente = [];
    $catIng = $_POST['catIng'];
    //$query3 = 'insert into receta_ingrediente (receta_id, ingrediente_id, medida_id, cantidad) values(?,?,?,?)';

    for ($rep = 0; $rep <= $catIng -1; $rep++)
    {
        $medida[$rep] = $_POST['medida'.$rep+1];
        $cantidad[$rep] = $_POST['cantidad'.$rep+1];
        $ingrediente[$rep] = $_POST['ingrediente'.$rep+1];

    }


    try{
        $query3 = 'insert into receta_ingrediente (receta_id, ingrediente_id, medida_id, cantidad) values(?,?,?,?)';
        $stmt3 = $con->prepare($query3);

        for ($i = 0; $i < $catIng; $i++)
        {
            $stmt3->execute([$pkrec, $ingrediente[$i], $medida[$i], $cantidad[$i]]);
        }

        echo 'Daten wurde gespeichert - PK '.$con->lastInsertId();
    }catch (Exception $e){
        echo $e ->getCode(). ': '.$e->getMessage();
    }


}


if(!isset($_POST['saveit'])){


/*Aufgabe ertellen Sie ein formular zu erfassen con Personendaten */
?>
<form method="post">
    <label for="nrec">Nombre de la Receta:</label>
    <input type="text" id="nrec" name="nreceta" required placeholder="Ej. Arroz con Leche"><br>
    <label for="cing">Cantidad de Ingredientes:</label>
    <input type="number" id="cing" name="cingredientes" required><br>
    <input type="submit" class="btn btn-info" name="saveit" value="speichern">
</form>
<?php
}
else{
    //Daten Speicher
    if(!isset($_POST['saveing'])) {
        $nreceta = $_POST['nreceta'];
        $cingredientes = $_POST['cingredientes'];
        $pkReceta ="";
        try{
            $query = "insert into receta(name) value(?)";
            $stmt = $con->prepare($query);
            $stmt->execute([$nreceta]);
            $pkReceta = $con->lastInsertId();
            echo 'Daten wurde gespeichert - PK '.$con->lastInsertId();
        }catch (Exception $e){
            echo $e ->getCode(). ': '.$e->getMessage();
        }

        echo ' Folgenden Daten werden gespeichert ' . $nreceta . '<br>';

        echo '<form method="post">';
        for ($j = 1; $j <= $cingredientes; $j++) {
            echo '<input type="hidden" id="pk" name="pkReceta" value="'.$pkReceta.'">
                  <input type="hidden" id="ct" name="catIng" value="'.$cingredientes.'">
                  <label for="nrec">Ingrediente ' . $j . ' :</label>';
            $query1 = 'select * from ingrediente';
            $query2 = 'select * from medida';

            try {
                $stmt1 = $con->prepare($query1);
                $stmt2 = $con->prepare($query2);
                $stmt1->execute();
                $stmt2->execute();

                $columnCount1 = $stmt1->columnCount();
                $columnCount2 = $stmt2->columnCount();
                $meta = array();
                for ($i = 0; $i < $columnCount1; $i++) {
                    $meta[] = $stmt1->getColumnMeta($i);
                }
                echo '<select name="ingrediente'.$j.'">';
                while ($row = $stmt1->fetch(PDO::FETCH_NUM)) {

                    echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';

                }
                echo '</select>';
                echo '<label for="cant">Medida:</label>
                      <input type="number" id="cant" name="cantidad'.$j.'" required>';
                for ($i = 0; $i < $columnCount2; $i++) {
                    $meta[] = $stmt2->getColumnMeta($i);
                }
                echo '<select name="medida'.$j.'">';
                while ($row = $stmt2->fetch(PDO::FETCH_NUM)) {

                    echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';

                }
                echo '</select><br>';
            } catch (Exception $e) {
                echo $e->getMessage();
            }

        }
        echo '<input type="submit" class="btn btn-info" name="saveing" value="speichern">';
        echo '</form>';

    }



}