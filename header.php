<?php
include 'includes/dbh.inc.php';
//inizio la sessione
session_start();
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>loginsystem</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
  </head>
  <body>
    <header>

      <nav>
        <div class="main-wrapper">
          <div class="prova">


          <ul>
            <li> <a href="index.php" >Home</a> </li>
          </ul>
          <div class="nav-login">

            <?php
              if (isset($_SESSION['u_id']))
              {

                /*  echo '<div class="logtxt">
                        login effettuato!
                        </div>';*/

                echo '<form class="" action="includes/logout.inc.php" method="post">
                      <button type="submit" name="submit">Logout</button>
                      </form>';
                echo '<a href="profilo.php">Profilo</a>';
              }
              else {
                echo '<form action="includes/login.inc.php" method="post">
                      <input type="text" name="uid" placeholder="Username/email">
                      <input type="password" name="pwd" placeholder="password">
                      <button type="submit" name="submit">Login</button>
                      </form><a href="signup.php">Sign up</a>';
              }
             ?>



          </div>
        </div>
      </div>
      </nav>
    </header>
