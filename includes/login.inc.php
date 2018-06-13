<?php

  //inizio la sessione

  session_start();

  if (isset($_POST['submit']))
  {
    include 'dbh.inc.php';
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    if (empty($uid) || empty($pwd))
    {
      header("Location: ../index.php?login=empty");
      exit();
    }
    else
    {
      $sql = "SELECT * FROM users WHERE user_uid = '$uid' OR user_email= '$uid'";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);
      if ($resultCheck < 1)
      {
        //dovrei mettere solamente login=error per non far capire cos'è sbagliato
        header("Location: ../index.php?login=utente");
        exit();
      }
      else
      {
        if ($rowlog = mysqli_fetch_assoc($result))
        {
          $hashedPwdChechk = password_verify($pwd, $rowlog['user_pwd']);
          //verifico se la password e la sua hash corrsipondono
          if ($hashedPwdChechk == false)
          {
            //dovrei mettere solamente login=error per non far capire cos'è sbagliato
            header("Location: ../index.php?login=pwd");
            exit();
          }
          elseif ($hashedPwdChechk == true) {
            // ora eseguo il login attraverso la variabile SESSION
            $_SESSION['u_id'] = $rowlog['user_id'];
            $_SESSION['u_first'] = $rowlog['user_first'];
            $_SESSION['u_last'] = $rowlog['user_last'];
            $_SESSION['u_email'] = $rowlog['user_email'];
            $_SESSION['u_uid'] = $rowlog['user_uid'];
            header("Location: ../index.php?login=success&id=".$rowlog['user_id']."");
            exit();
          }
        }
      }
    }

  }
  else
  {
    header("Location: ../index.php?login=esterno");
    exit();
  }
 ?>
