<?php
$servername = "localhost";
$username = "tictactoe";
$password = "tictactoe";

// Create connection
$conn = new mysqli($servername, $username,$password,'test');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
#echo "Connected successfully<br>";

$sql = "INSERT INTO player (name) VALUE ('".$_POST['uname']."');";
$sql2 = "Insert into score (player_id)value ((select player_id from player where name = '".$_POST['uname']."'));";


$result = mysqli_query($conn, $sql);
$result = mysqli_query($conn, $sql2);

$conn->close();
?>

<html>
  <head>
    <title>Add new Player</title>
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
        <h1>New player added <?php echo $_POST['uname']?></h1> 
        <p>Go to the game to select your player<br/><a href="tictactoe.php">Click me to go back!</a></p>
      </div>
    </body>
</html>