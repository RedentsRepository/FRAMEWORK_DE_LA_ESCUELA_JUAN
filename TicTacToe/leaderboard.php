<!DOCTYPE html>
<html lang="en">
<head>
  <title>Laderboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php 
 $servername = "localhost";
 $username = "tictactoe";
 $password = "tictactoe";

 // Create connection
 $conn = new mysqli($servername, $username, $password, 'test');

 // Check connection
 if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }
 #echo "Connected successfully<br>";
 $sql = "select p.name, s.scores, s.last_game from player p, score s where p.player_id = s.player_id order by s.scores DESC, s.last_game asc;";
 $result = mysqli_query($conn, $sql);
?>
<div class="container">
  <h2>Leaderboard</h2>
  <p></p>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>Place</th>
        <th>Name</th>
        <th>Points</th>
        <th>Lastgame</th>
      </tr>
    </thead>
    <tbody>
    <?php
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>".$i."</td><td>". $row["name"]."</td><td>". $row["scores"]."</td><td>". $row["last_game"]."</td></tr>";
            $i++;
            }
        } else {
            echo "0 results";
        }
    ?>
    </tbody>
  </table>
  <div><a href="tictactoe.php">Click me to go back!</a></div>
</div>

</body>
</html>