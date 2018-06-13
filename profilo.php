<?php
  include_once 'header.php';
 ?>
 <div class="profilo-container">

     <?php

          $myid = $_SESSION['u_id'];

         $sqlp = "SELECT * FROM users WHERE user_id='$myid'";
         //eseguo la query
         $results = mysqli_query($conn, $sqlp);
         $queryResult = mysqli_num_rows($results);

         if ($queryResult > 0)
         {
           while ($rowpro = mysqli_fetch_assoc($results))
           {
             echo "<div class='profilo'>
                 <h5>Nome <div class='nomeeex'>".$rowpro['user_first']."</div></h5>
                 <h5>Cognome<div class='nomeeex'>".$rowpro['user_last']."</div></h5>
                 <h5>Email <div class='nomeeex'>".$rowpro['user_email']."</div></h5>
                 <h5>Username<div class='nomeeex'>".$rowpro['user_uid']."</div></h5>
                 <br>

               </div>";
           }
         }

      ?>
    </div>
</div>
<div class='modifica-container'>
 <a href='#'>Modifica profilo</a>
</div>
 <?php
   include_once 'footer.php';
  ?>
