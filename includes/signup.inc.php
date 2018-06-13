<?php
  //se il bottone submit viene schiacciato esegui il codice
  if (isset($_POST['submit']))
  {
    include_once 'dbh.inc.php';
    /*queste variabile vanno nel database quindi gli utenti potrebbero scrivere
     del codice che potrebbe andare a modificare il database stesso (SQL injection)
     per questo motivo si usa il metodo escape che converte tutto in semplice text
     altrimenti sarebbe direttaente $first = $_POST['first']; che mette nella variabile
     first ciò che l'utente hascritto nell'input first nel form signup*/

     $first = mysqli_real_escape_string($conn, $_POST['first']);
     $last = mysqli_real_escape_string($conn, $_POST['last']);
     $email = mysqli_real_escape_string($conn, $_POST['email']);
     $uid = mysqli_real_escape_string($conn, $_POST['uid']);
     $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

     //Error handlers
     //1° check for empty fields
     if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd))
     {
       header("Location: ../signup.php?signup=empty");
       exit();

     }
     else
     {
       //2° check if input characters are valid
       if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last))
       {
         header("Location: ../signup.php?signup=invalid");
         exit();
       }
       else
       {
         //3° check if email is valid
         if (!filter_var($email, FILTER_VALIDATE_EMAIL))
         {
           header("Location: ../signup.php?signup=invalid_email");
           exit();
         }
         else
         {
           //4° chech if username is already used
           $sql = "SELECT * FROM users WHERE user_uid='$uid'";
           $result = mysqli_query($conn, $sql);
           /*controllo se la query ha successo o meno, se ha successo(il numero di righe
           è maggiore di 0) l'username è già preso e nn puo essere assegnato*/
           $resultCheck = mysqli_num_rows($result);
           if ($resultCheck > 0)
           {
             header("Location: ../signup.php?signup=usertaken");
             exit();
           }
           else {
             /*Ora che tutti gli input sono corretti,
             Faccio l'hash alla password in modo che non può essere letta*/
             $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
             //aggiungo l'utente nel database
             $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES('$first', '$last', '$email', '$uid', '$hashedPwd');";
             //eseguo la query
             mysqli_query($conn, $sql);
             header("Location: ../signup.php?signup=success");
             exit();


           }
         }
       }
     }

  }
  /*se si prova ad entrare inquesta pagina senza schiacciare il pulsante
  rimandalo alla pagina di signup(altrimenti vederebbero il codice)*/
  else
  {
    header("Location: ../signup.php?error");
  }
?>
