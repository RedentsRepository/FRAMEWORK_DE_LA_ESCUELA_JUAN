<?php
echo '
<h1>Tabelle</h1>
<p>Erstellt mit PHP</p>
';
include 'config.php';

$query = 'select * from receta';

/*$query = 'select per_id id, concat(per_vname," ",per_nname)name from person
where per_vortragender = 2';*/

/*$query = 'select per_id as "ID", concat_ws(\' \', per_vname, per_nname) as "Person"
            from person';*/

try
{

//    $stmt = $con->prepare($query);
//    $stmt->execute();
//    $columnCount = $stmt->columnCount();
//    $meta = array();
//    for ($i = 0; $i < $columnCount; $i++)
//    {
//        $meta[] = $stmt->getColumnMeta($i);
//    }
//    echo '<select>';
//    while ($row = $stmt->fetch(PDO::FETCH_NUM))
//    {
//
//            echo '<option value="'.$row[0].'"">'. $row[1].'</option>';
//
//    }
//    echo '</select>';


    $stmt = $con->prepare($query);
    $stmt->execute();
    $columnCount = $stmt->columnCount();
    $meta = array();
    echo '<table border="1"><tr>';

    for ($i = 0; $i < $columnCount; $i++)
    {
        $meta[] = $stmt->getColumnMeta($i);
        echo '<th>'.$meta[$i]['name'].'</th>';
    }
    echo '</tr>';
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
} catch (Exception $e)
{
    echo $e->getMessage();
}
?>