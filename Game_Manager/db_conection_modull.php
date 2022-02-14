<?php
  $servername = "localhost";
  $username = "root";
  $password = "FLJU@GM";
  $database = "kurs";

  // Create connection
  $conn = new mysqli($servername, $username, $database);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  #echo "Connected successfully<br>";

  function schowGames(){

    $sqlShowGames = "Select row_number() over(order by GAME_NAME) as row_num, game_id, game_name, time_played, release_date from game";
    $resultShowGames = mysqli_query($GLOBALS['conn'], $sqlShowGames);
      
    echo "<table class=".'table'.">
      <thead class=".'thead-dark'.">
        <tr>
          <th>Number</th>
          <th>Name</th>
          <th>Time Played</th>
          <th>Release Date</th>
        </tr>
      </thead>
      <tbody id="."dbGames".">";

    if (mysqli_num_rows($resultShowGames) > 0) {
        // output data of each row
        #$i = 1;
        while ($row = mysqli_fetch_assoc($resultShowGames)) {
        echo "<tr><td>". $row["row_num"] ."</td><td><a href=\"game_details.php?game_id=" . $row["game_id"] . "\" value=\"" . $row["game_id"] . "\">". $row["game_name"] ."</a></td><td>". convertSec2RealTime($row["time_played"]) ."</td><td>". $row["release_date"]."</td></tr>";
        #$i++;
        }
    } #http://localhost:81/game_Manager/add_game_2_db.php?game_name=Valorant&release_date=2021-09-02&played_time_days=1&played_time_hours=24&played_time_minutes=1&played_time_seconds=50&dev_name=Ed+Boon&category=Action
    else {
        echo "0 results";
    
    }
    echo "</tbody></table>";
  }

  function addGame($gameName, $categoryname, $releaseDate, $firstName="Unknown", $lastName="0", $time_played){
    $sqlAddGame = "INSERT INTO game (GAME_NAME, DEV_ID, RELEASE_DATE, CATEGORY, TIME_PLAYED) VALUES('$gameName', (SELECT dev_id from DEVELOPER where first_name = '$firstName' and last_name = '$lastName'), '$releaseDate', (select CATEGORY_ID from game_category where category_name like '%$categoryname%'), $time_played)";
    echo $sqlAddGame;
    $resultAddGame = mysqli_query($GLOBALS['conn'], $sqlAddGame);
  }

  function deleteGameById($gameId){

    $sqlDeleteGameById = "DELETE FROM game WHERE GAME_ID = $gameId";
    echo $sqlDeleteGameById;
    $resultDeleteGameById = mysqli_query($GLOBALS['conn'], $sqlDeleteGameById);

  }

  function showDevelopersName(){
    $sqlShowDevelopersName = "Select CONCAT(first_name, ' ', last_name) as name from developer";
    $resultShowDevelopersName = mysqli_query($GLOBALS['conn'], $sqlShowDevelopersName);

    if (mysqli_num_rows($resultShowDevelopersName) > 0) {
      // output data of each row
      #$i = 1;
      while ($row = mysqli_fetch_assoc($resultShowDevelopersName)) {
      echo "<option>". $row["name"] ."</option>";
      #$i++; <option>1</option>
      }
    } 
    else {
      echo "0 results";

    }
  }

  function showCategories(){
    $sqlShowCategories = "Select category_name as category from game_category";
    $resultShowCategories = mysqli_query($GLOBALS['conn'], $sqlShowCategories);

    if (mysqli_num_rows($resultShowCategories) > 0) {
      // output data of each row
      #$i = 1;
      while ($row = mysqli_fetch_assoc($resultShowCategories)) {
      echo "<option>". $row["category"] ."</option>";
      #$i++; <option>1</option>
      }
    } 
    else {
      echo "0 results";

    }
  }

  function updatePlayedTimeById($gameId, $day, $hour, $minute, $second ){

    $second = $second + ($day * 86400) + ($hour * 3600) + ($minute * 60);

    $sqlUpdatePlayedTime = "UPDATE game set TIME_PLAYED = (SELECT TIME_PLAYED from game where GAME_ID = $gameId) + $second where GAME_ID = $gameId;";
    $resultUpdatePlayedTime = mysqli_query($GLOBALS['conn'], $sqlUpdatePlayedTime);
  }

  function convertSec2RealTime($sec){
    $rest = $sec;
    $days = intval($rest / 86400);# round($rest / 86400, 0, PHP_ROUND_HALF_DOWN);
    $rest = $rest - $days * 86400;

    $hours =  intval($rest / 3600);
    $rest = $rest - $hours * 3600;

    $minute = intval($rest / 60);
    $rest = $rest - $minute * 60;

    if($days > 0)
    {
      return "$days days, $hours hours, $minute minutes, $rest seconds";
    }
    elseif($hours > 0)
    {
      return "$hours hours, $minute minutes, $rest seconds";
    }
    elseif($minute > 0)
    {
      return "$minute minutes, $rest seconds";
    }
    else{
      return "$rest seconds";
    }
  }

  function redirect($url, $statusCode = 303){
    header('Location: ' . $url, true, $statusCode);
    die();
  }

  function showGameDetailsById($gameId){
    $sqlShowGameDetailsById = "Select g.GAME_NAME, g.TIME_PLAYED, g.RELEASE_DATE, gc.CATEGORY_NAME, CONCAT(d.FIRST_NAME,\" \",d.LAST_NAME) as developer_name, corp.COMPANY_NAME, g.CREATE_DATE
    FROM game g, developer d, game_category gc, company corp
    WHERE g.DEV_ID = d.DEV_ID
    AND g.CATEGORY = gc.CATEGORY_ID
    AND d.STUDIO = corp.COMPANY_ID
    AND g.GAME_ID = $gameId";
    $resultShowGameDetailsById = mysqli_query($GLOBALS['conn'], $sqlShowGameDetailsById);
      
    if (mysqli_num_rows($resultShowGameDetailsById) > 0) {
        // output data of each row
        #$i = 1;
        while ($row = mysqli_fetch_assoc($resultShowGameDetailsById)) {
        echo "<h4 class=\"font-size38 sm-font-size32 xs-font-size30\">". $row["GAME_NAME"] ."</h4>
        <p class=\"no-margin-bottom\">A litle more info</p>
        <div class=\"contact-info-section margin-40px-tb\">
          <ul class=\"list-style9 no-margin\">
            <li>

              <div class=\"row\">
                <div class=\"col-md-5 col-5\">
                  <i class=\"fas fa-graduation-cap text-orange\"></i>
                  <strong class=\"margin-10px-left text-orange\">Category:</strong>
                </div>
                <div class=\"col-md-7 col-7\">
                  <p>". $row["CATEGORY_NAME"] ."</p>
                </div>
              </div>

            </li>
            <li>

              <div class=\"row\">
                <div class=\"col-md-5 col-5\">
                  <i class=\"far fa-gem text-yellow\"></i>
                  <strong class=\"margin-10px-left text-yellow\">Time Played:</strong>
                </div>
                <div class=\"col-md-7 col-7\">
                  <p>". convertSec2RealTime($row["TIME_PLAYED"])  ."</p>
                </div>
              </div>

            </li>
            <li>

              <div class=\"row\">
                <div class=\"col-md-5 col-5\">
                  <i class=\"far fa-file text-lightred\"></i>
                  <strong class=\"margin-10px-left text-lightred\">Realease Date:</strong>
                </div>
                <div class=\"col-md-7 col-7\">
                  <p>". $row["RELEASE_DATE"] ."</p>
                </div>
              </div>

            </li>
            <li>

              <div class=\"row\">
                <div class=\"col-md-5 col-5\">
                  <i class=\"fas fa-map-marker-alt text-green\"></i>
                  <strong class=\"margin-10px-left text-green\">Develeoper Name:</strong>
                </div>
                <div class=\"col-md-7 col-7\">
                  <p>". $row["developer_name"] ."</p>
                </div>
              </div>

            </li>
            <li>

              <div class=\"row\">
                <div class=\"col-md-5 col-5\">
                  <i class=\"fas fa-mobile-alt text-purple\"></i>
                  <strong class=\"margin-10px-left xs-margin-four-left text-purple\">Company:</strong>
                </div>
                <div class=\"col-md-7 col-7\">
                  <p>". $row["COMPANY_NAME"] ."</p>
                </div>
              </div>

            </li>
            <li>
              <div class=\"row\">
                <div class=\"col-md-5 col-5\">
                  <i class=\"fas fa-envelope text-pink\"></i>
                  <strong class=\"margin-10px-left xs-margin-four-left text-pink\">Create Date:</strong>
                </div>
                <div class=\"col-md-7 col-7\">
                  <p>". $row["CREATE_DATE"] ."</p>
                </div>
              </div>
            </li>
          </ul>
        </div>";
        #$i++;
        }
    } #http://localhost:81/game_Manager/add_game_2_db.php?game_name=Valorant&release_date=2021-09-02&played_time_days=1&played_time_hours=24&played_time_minutes=1&played_time_seconds=50&dev_name=Ed+Boon&category=Action
    else {
        echo "0 results";
    
    }
  }

  function showGameDetailsInPlaceholderById($gameId){
    $sqlShowGameDetailsById = "Select g.GAME_NAME, g.TIME_PLAYED, g.RELEASE_DATE, gc.CATEGORY_NAME, CONCAT(d.FIRST_NAME, \" \", d.LAST_NAME) as developer_name
    FROM game g, developer d, game_category gc
    WHERE g.DEV_ID = d.DEV_ID
    AND g.CATEGORY = gc.CATEGORY_ID
    AND g.GAME_ID = $gameId";
    $resultShowGameDetailsById = mysqli_query($GLOBALS['conn'], $sqlShowGameDetailsById);
      
    if (mysqli_num_rows($resultShowGameDetailsById) > 0) {
        // output data of each row
        #$i = 1;
        while ($row = mysqli_fetch_assoc($resultShowGameDetailsById)) {
          $realtime = convertSec2RealTime($row["TIME_PLAYED"]);
          echo "<input type=\"hidden\" id=\"gameId\" name=\"gameId\" value=\"$gameId\">
                <div class=\"input-group mb-3\">
                  <div class=\"input-group-prepend\">
                    <span class=\"input-group-text\">Game Name</span>
                  </div>
                  <input type=\"text\" class=\"form-control\" placeholder=\"". $row["GAME_NAME"] ."\" id=\"usr\" name=\"game_name\" required>
                  <div class=\"input-group-append\">
                    <span class=\"input-group-text\">Old Release Date: <strong> ". $row["RELEASE_DATE"] ."</strong></span>
                  </div>
                  <input type=\"date\" class=\"form-control\" id=\"release_date\" name=\"release_date\" required>
                </div>
                
                <div class=\"input-group mb-3\">
                  <div class=\"input-group-append\">
                    <span class=\"input-group-text\">Old Played Time: <strong>$realtime</strong> </span>
                  </div>
                  <input type=\"number\" class=\"form-control\" id=\"played_time\" placeholder=\"Days\" name=\"played_time_days\" required>
                  <input type=\"number\" class=\"form-control\" id=\"played_time\" placeholder=\"Hours\" name=\"played_time_hours\" required>
                  <input type=\"number\" class=\"form-control\" id=\"played_time\" placeholder=\"Minutes\" name=\"played_time_minutes\" required>
                  <input type=\"number\" class=\"form-control\" id=\"played_time\" placeholder=\"Seconds\" name=\"played_time_seconds\" required>
                </div>";
          #$i++;
        }
    } #http://localhost:81/game_Manager/add_game_2_db.php?game_name=Valorant&release_date=2021-09-02&played_time_days=1&played_time_hours=24&played_time_minutes=1&played_time_seconds=50&dev_name=Ed+Boon&category=Action
    else {
        echo "0 results";
    
    }
  }

  function updateGameById($gameId, $gameName, $categoryname, $releaseDate, $firstName, $lastName, $time_played){
    $sqlUpdateGameById = "UPDATE game SET GAME_NAME = '$gameName', RELEASE_DATE = '$releaseDate', TIME_PLAYED = '$time_played', DEV_ID = (SELECT d.DEV_ID FROM developer d WHERE d.FIRST_NAME LIKE '%$firstName%' AND d.LAST_NAME LIKE '%$lastName%'), CATEGORY = (SELECT c.CATEGORY_ID FROM game_category c WHERE c.CATEGORY_NAME LIKE '%$categoryname%'), UPDATE_DATE = SYSDATE() WHERE GAME_ID = $gameId";
    echo $sqlUpdateGameById;
    $resultUpdateGameById = mysqli_query($GLOBALS['conn'], $sqlUpdateGameById);
  }

  function getUpdateAndDeleteLink($gameId){
    echo "<li><a href=\"edit_game.php?game_id=$gameId\"><img src=\"EditBlack.png\"></a></li>
          <li><a href=\"delete_game_2_db.php?game_id=$gameId\"><img src=\"cancel_16.png\"></a></li>";
  }

?>