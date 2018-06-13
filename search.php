<?php
   include 'header.php';
?>

<section class="main-container">
  <div class="main-wrappe">
      <h4>Pagina ricerca </h4><br>
  </div>

  <div class="hotel-container">
    <?php
      if (isset($_POST['submit-search']))
      {
        //sempre per evitare swl injection
        $search = mysqli_real_escape_string($conn, $_POST['ricerca']);
        $sql = "SELECT * FROM hotels WHERE citta LIKE '%$search%' OR indirizzo LIKE '%$search%' OR nome LIKE '%$search%' OR descrizione LIKE '%$search%'";
        $results = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($results);
        echo "Ci sono " . $queryResult . " risultati:";

        if ($queryResult > 0)
        {
          while ($row = mysqli_fetch_assoc($results))
          {
            echo "  <a href='hotel.php?hotel=".$row['nome']."&citta=".$row['citta']."'><div class='hotel-box'>
                <h3>".$row['nome']."</h3>
                <h6>".$row['prezzo']."</h6>
                <h5>".$row['citta']."</h5>
                <h5>".$row['indirizzo']."</h5>
                <p>".$row['descrizione']."</p>
                <br>
              </div></a>";
          }
        }
        else
        {
          echo "there are no results matching your search";
        }

      }
     ?>
  </div>
</section>
<?php
  include_once 'footer.php';
 ?>
</html>
