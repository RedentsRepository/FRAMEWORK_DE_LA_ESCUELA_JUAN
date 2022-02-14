<?php
echo '
<h1>Kurse</h1>
<p>Erstellt mit PHP</p>';
echo '<h2>Kursvwewaltung - Neuen Kurs</h2>';
include 'config.php';

if(!isset($_POST['saveit'])){


    /*Aufgabe ertellen Sie ein formular zu erfassen con Personendaten */
    ?>
    <form method="post">
        <label for="kn">Kurs Name:</label>
        <input type="text" id="kn" name="kname" placeholder="zb. MATHE"><br>
        <label for="kp">Kurs Preis:</label>
        <input type="number" id="kp" name="kpreis"><br>
        <br>
        <label for="sd">Start Date:</label>
        <input type="date" id="sd" name="sdate"><br>
        <label for="ed">End Date:</label>
        <input type="date" id="ed" name="edate"><br>
        <label for="vo">Vortragender:</label>
        <?php
        $query = 'select per_id id, concat(per_vname," ",per_nname)name from person
where per_vortragender = 2';

        try
        {
            $stmt = $con->prepare($query);
            $stmt->execute();
            $columnCount = $stmt->columnCount();
            $meta = array();

            for ($i = 0; $i < $columnCount; $i++)
            {
                $meta[] = $stmt->getColumnMeta($i);
            }
            echo '<select name="vor" id="vo">';

            while ($row = $stmt->fetch(PDO::FETCH_NUM))
            {

                echo '<option value="'.$row[0].'">'.$row[1].'</option>';

            }
            echo '</select><br>';

        } catch (Exception $e)
        {
            echo $e->getMessage();
        }
        ?>
        <br>
        <input type="submit" class="btn btn-info" name="saveit" value="speichern">
    </form>
    <?php
}
else{
    //Daten Speicher
    $kname = $_POST['kname'];
    $kpreis = $_POST['kpreis'];
    $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];
    $vortagender = $_POST['vor'];

    echo ' Folgenden Daten werden gespeichert '.$kname.' '.$kpreis.' '.$sdate.' '.$edate.'<br>';

    try{

        $query1 = "insert into kurs (kur_bezeichnung) value(?)";
        $stmt1 = $con->prepare($query1);
        $stmt1->execute([$kname]);
        $kursPk = $con->lastInsertId();
        $query2 = "insert into kurstermin (kute_start, kur_id, vortragender_per_id) values(?,?,?)";
        $stmt2 = $con->prepare($query2);
        $stmt2->execute([$sdate, $kursPk, $vortagender]);
        $query3 = "insert into kurspreis (kupr_wert, kupr_bis, kur_id) values(?,?,?)";
        $stmt3 = $con->prepare($query3);
        $stmt3->execute([$kpreis, $edate, $kursPk]);


        echo 'Daten wurde gespeichert - PK '.$con->lastInsertId();

        $query = 'select kp.kupr_id as "ID", k.kur_bezeichnung as "Kurs", kp.kupr_wert as "Wert" from kurs k, kurspreis kp
                where k.kur_id = kp.kur_id
                order by 1 desc';
        try
        {
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
    }catch (Exception $e){
        echo $e ->getCode(). ': '.$e->getMessage();
    }
}
