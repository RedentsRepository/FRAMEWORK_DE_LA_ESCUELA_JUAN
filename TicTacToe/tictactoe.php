<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="desing.css" />
  <meta charset="UTF-8" />
  <title>TicTacToe</title>
</head>

<body>
  <!-- PHP CODE BEGIN -->
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
  $sql = "SELECT name from player;";
  $result = mysqli_query($conn, $sql);
  ?>
  <!-- PHP CODE END -->

  <div>
    <svg id="svg" height="130" width="500">
      <defs>
        <linearGradient id="grad1" x1="0%" y1="100%" x2="0%" y2="0%">
          <stop offset="15%" style="stop-color:rgb(196, 13, 13);stop-opacity:1" />
          <stop offset="100%" style="stop-color:rgb(0, 0, 0);stop-opacity:1" />
        </linearGradient>
      </defs>
      <ellipse cx="250" cy="70" rx="200" ry="55" fill="url(#grad1)" />
      <text fill="#ffffff" font-size="50" font-family="Verdana" x="150" y="86">TicTacToe</text>
      Sorry, your browser does not support inline SVG.
    </svg>
  </div>

  <button id="hide" class="hide" onclick="changeVisibility()">Close Players Names</button><br><br>
  <button id="swichScreen" onclick="switchScreen();">Open Fullscreen</button><br><br>

  <form id="pNames" method="POST">
    <a href="add_player.php">Click me for add new Player</a><br><br>
    <label for="name">Player 1:</label>
    <select name="P1" id="P1">
      <?php
      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<option value=" . $row["name"] . ">" . $row["name"] . "</option>";
        }
      } else {
        echo "0 results";
      }
      ?>
    </select><br><br>
    <label for="name">Player 2:</label>
    <select name="P2" id="P2">
      <?php
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<option value=" . $row["name"] . ">" . $row["name"] . "</option>";
        }
      } else {
        echo "0 results";
      }
      ?>
    </select><br><br>
  </form>

  <div class="result_info">
    <p id="pointCounterP1">P1 : 0</p>
    <p id="pointCounterP2">P2 : 0</p>
    <p id="result">Turn:X</p>
    <button id="restart">Restart</button>
    <form action="add_scores.php">
    <input class="collapse" type="text" id="p1data" name="p1data" value="">
    <button id="safe-reload">Safe and play a new Round</button>
    <input class="collapse" type="text" id="p2data" name="p2data" value="">
    </form> 
  </div>

  <div class="container">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>
  <br><br>
  <form action="leaderboard.php">
    <button >Leaderboard</button>
  </form>

  <script>
    let pointP1 = 0;
    let pointP2 = 0;
    let p1 = document.getElementById("pointCounterP1");
    let p2 = document.getElementById("pointCounterP2");
    let player = "";
    let dbPLayer1Data = document.getElementById("p1data");
    let dbPLayer2Data = document.getElementById("p2data");
    let screenFull = false;
    var elem = document.documentElement;


    window.onload = () => {
      //tic tac toe logic here

      const boxes = document.querySelectorAll(".container div");
      const info_box = document.getElementById("result");
      const restart = document.getElementById("restart");

      game_over = false;
      let board = [...Array(9)].fill("x");

      boxes.forEach((ele, index) => {
        ele.onclick = () => {
          if (board[index] == "x" && !game_over) {
            player = player == "X" ? "O" : "X";

            console.log("Player: " + player);

            info_box.innerHTML = `Turn:${player == "X" ? "O" : "X"}`; // == "X" ? "O" : "X

            board[index] = ele.innerHTML = player.fontcolor("red");

            gameOver();
          }
        };
      });
      // PHP CODE BEGIN -
      <?php
      function updateScores($playerName){
        $sql = "update score set scores = (SELECT s.scores from player p, score s WHERE s.player_id = p.player_id AND p.name LIKE '".$playerName."') + 1, last_game = sysdate() WHERE player_id = (SELECT player_id from player where name = '".$playerName."');";

        $servername = "localhost";
        $username = "tictactoe";
        $password = "tictactoe";

        // Create connection
        $conn = new mysqli($servername, $username, $password, 'test');

        mysqli_query($conn, $sql);
      }
      ?>
      //PHP CODE END


      const gameOver = () => {
        for (let i = 0; i < 9; i += 3) {
          if (board[i] !== "x" && board[i] == board[i + 1] && board[i] == board[i + 2]) { // 123 456 789
            info_box.innerHTML = `Winner:${player}`;
            if (player == "X") {
              pointP1++;
              <?php #updateScores($_POST['P1']);?>
              console.log(pointP1 + " jugador 1 " + "<?php echo 'Hi';#echo $_POST['P1']; ?>");
            } else {
              pointP2++;
              console.log(pointP2 + " jugador 2");
            }
            game_over = true;
            return;
          }
        }
        for (let i = 0; i < 3; i++) {
          if (board[i] !== "x" && board[i] == board[i + 3] && board[i] == board[i + 6]) { // 147 258 369
            info_box.innerHTML = `Winner:${(player == "X" ? document.getElementById("P1").value : document.getElementById("P2").value)}`;
            if (player == "X") {
              pointP1++;
              <?php #updateScores($_POST['P1']);?>
              console.log(pointP1 + " jugador 1 " + "<?php echo 'Hi';#echo $_POST['P1']; ?>");
            } else {
              pointP2++;
              console.log(pointP2 + " jugador 2");
            }
            game_over = true;
            return;
          }
        }
        if (board[0] !== "x" && board[0] == board[4] && board[0] == board[8]) //159
        {
          info_box.innerHTML = `Winner:${(player == "X" ? document.getElementById("P1").value : document.getElementById("P2").value)}`;
          if (player == "X") {
            pointP1++;
            <?php #updateScores($_POST['P1']);?>
            console.log(pointP1 + " jugador 1 " + "<?php echo 'Hi';#echo $_POST['P1']; ?>");
          } else {
            pointP2++;
            console.log(pointP2 + " jugador 2");
          }
          game_over = true;
          return;
        } else if (board[2] !== "x" && board[2] == board[4] && board[2] == board[6]) // 357
        {
          info_box.innerHTML = `Winner:${(player == "X" ? document.getElementById("P1").value : document.getElementById("P2").value)}`;
          if (player == "X") {
            pointP1++;
            <?php #updateScores($_POST['P1']);?>
            console.log(pointP1 + " jugador 1 " + "<?php echo 'Hi';#echo $_POST['P1']; ?>");
          } else {
            pointP2++;
            console.log(pointP2 + " jugador 2");
          }
          game_over = true;
          return;
        } else if (board.every((ele) => ele !== "x")) { // Not macht
          info_box.innerHTML = "Draw!!";
          game_over = true;
          return;
        }
      };


      function restartGame() {
        game_over = false;
        console.log("restar game player: " + player)
        board = [...Array(9)].fill("x");

        boxes.forEach((ele) => {
          ele.innerHTML = "";
        });
        p1.innerHTML = `${document.getElementById("P1").value} : ${pointP1}`;
        p2.innerHTML = `${document.getElementById("P2").value} : ${pointP2}`;

        dbPLayer1Data.value = `${document.getElementById("P1").value}:${pointP1}`;
        dbPLayer2Data.value = `${document.getElementById("P2").value}:${pointP2}`;

      };

      restart.addEventListener("click", restartGame);
    };


    function changeVisibility() {
      var x = document.getElementById("pNames");
      var elem = document.getElementById("hide");
      if (x.style.display === "none") {
        x.style.display = "block";
        elem.innerHTML = "Close Players Names"
      } else {
        x.style.display = "none";
        elem.innerHTML = "Show Players Names";
      }
    }

    function switchScreen(){
      var elem = document.getElementById("swichScreen");

      if (screenFull)
      {
        closeFullscreen();
        elem.innerHTML = "Open Fullscreen";
      }
      else
      {
        openFullscreen();
        elem.innerHTML = "Close Fullscreen";
      }
    }

    function openFullscreen() {
      if (elem.requestFullscreen) {
        elem.requestFullscreen();
      } else if (elem.webkitRequestFullscreen) { /* Safari */
        elem.webkitRequestFullscreen();
      } else if (elem.msRequestFullscreen) { /* IE11 */
        elem.msRequestFullscreen();
      }
      screenFull = true;
    }

    function closeFullscreen() {
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.webkitExitFullscreen) { /* Safari */
        document.webkitExitFullscreen();
      } else if (document.msExitFullscreen) { /* IE11 */
        document.msExitFullscreen();
      }
      screenFull = false;
    }


  </script>
</body>
</html>