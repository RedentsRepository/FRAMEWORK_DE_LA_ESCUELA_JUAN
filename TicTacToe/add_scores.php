<?php
$servername = "localhost";
$username = "tictactoe";
$password = "tictactoe";

$playersData = explode(":", $_GET['p1data'].":".$_GET['p2data']);


// Create connection
$conn = new mysqli($servername, $username,$password,'test');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
#echo "Connected successfully<br>";

for($i = 0; $i <=2; $i+=2)
{
    $sql = "update score set scores = (SELECT s.scores from player p, score s WHERE s.player_id = p.player_id AND p.name LIKE '".$playersData[0+$i]."') + ".$playersData[1+$i].", last_game = sysdate() WHERE player_id = (SELECT player_id from player where name = '".$playersData[0+$i]."');";
    
    $result = mysqli_query($conn, $sql);
}
$conn->close();


function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}
?>

<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
  </head>
    <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
    </style>
    <body>
      <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
        <i class="checkmark">✓</i>
      </div>
        <h1>New player added </h1> 
        <p>Go to the game to select your player<br/><a href="tictactoe.php">Click me to go back!</a></p>
      </div>
    </body>
</html>
<?php redirect("tictactoe.php")?>