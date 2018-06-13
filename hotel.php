<?php
  include 'header.php';
 ?>
 <section class="main-container">
   <h4>Pagina Hotel</h4>
   <br>
   <div class="hotel-container">
     <?php

         //prendo le informazioni dall'url quindi uso GET
         $hotel = mysqli_real_escape_string($conn, $_GET['hotel']);
         $citta = mysqli_real_escape_string($conn, $_GET['citta']);

         $sql = "SELECT * FROM hotels WHERE citta='$citta' AND nome='$hotel'";
         //eseguo la query
         $results = mysqli_query($conn, $sql);
         $queryResult = mysqli_num_rows($results);

         if ($queryResult > 0)
         {
           while ($row = mysqli_fetch_assoc($results))
           {
             echo "<div class='hotel-box'>
                 <h3>".$row['nome']."</h3>
                 <h6>".$row['prezzo']."</h6>
                 <h5>".$row['citta']."</h5>
                 <h5>".$row['indirizzo']."</h5>
                 <p>".$row['descrizione']."</p>
                 <br>
               </div>";
               echo "<img src='images/".$row['nome'].".jpg' alt='Girl in a jacket' width='700' height='400'>";
           }
         }
      ?>
   </div>

   </body>

  </section>
  <?php
    include_once 'footer.php';
   ?>
</html>
