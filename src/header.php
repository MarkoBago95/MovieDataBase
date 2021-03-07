<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
      <?php echo $title ?> - 
      <?php echo $sitename ?> | 
      <?php echo $tagline ?>
    </title>
    <link href="css/style.css" rel="stylesheet">
    <?php

    session_start();

    $sqluser = "user";
    $sqlpassword = "password";

    $sqldatabase = "login";


    try {
        $pdo = new PDO("mysql:host=localhost;dbname=".$sqldatabase,$sqluser,$sqlpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
    $st = $pdo->prepare('SELECT * FROM list WHERE user_name=?');
    $st->execute(array($_SESSION["uname"]));
    if(($r=$st->fetch())==null||($r["password"]!=$_SESSION["pass"])) {
        header("Location:login.php");
        exit;
    }
    if ($_SERVER['REQUEST_METHOD']=='POST') {
      session_destroy();
        header("Location:login.php");
        exit;
      
    }
    ?>
  </head>
  <body>
    <div class="naslovnica">
<form   method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    Dobrodošli <?php echo $_SESSION["fname"];?><br><br>
    <input id="odjava" type="submit" id="submit" name="submit" value="Odjavi se">
    
</form>
    <h1 id="naslov">
      <?php echo $sitename ?>
    </h1>
    </div>
    <form  action="search.php" method="get">
      <input id="trazi" type="text" name="search" placeholder="Unesite naslov filma ili serije" required>
      <select class="izbor" name="channel" required>
        <option value="movie" selected="selected">Movie
        </option>
        <option  value="tv">TV Show
        </option>
      </select>
      <button id="traz" type="submit">Traži
      </button>
    </form>
    <ul class="label">
      <li>
        <button id="dem1" type ="button" onclick =location.href="index.php">Home</button>
      </li>
      <li>
        <button id="dem2" type ="button" onclick =location.href="popular.php">Popular Movies</button>
      </li>
      <li>
        <button id="dem3" type ="button" onclick =location.href="now-playing.php">Now Playing Movies</button>
      </li>
      <li>
        <button id="dem4" type ="button" onclick =location.href="upcoming.php">Upcoming Movies</button>
      </li>
      <li>
        <button id="dem5" type ="button" onclick =location.href="tv-series.php">TV SERIES</button>
      </li>
    </ul>
