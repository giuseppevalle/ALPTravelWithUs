<?php
  include_once 'header.php';
 ?>
    <section class="main-container">
      <div class="main-wrapper">

        <section id="banner">
          <h2>Main Page  <br> <br></h2>
          <h3>ALP <br>Travel with us<br> <br></h3>
        </section>

        <div class="hotel-container">



           <form class="search" action="search.php" method="post">
             <button type="submit" name="submit-search">Search</button>
             <input type="text" name="ricerca" placeholder="Ricerca">
           </form>
           <br>
		 <h6><div class='hotelpeppe'>Hotels: </div></h6>
        <br><br>
        <?php
            $sql2 = "SELECT * FROM hotels;";
            //eseguo la query
            $results2 = mysqli_query($conn, $sql2);
            //controllo se ho risultati
            $queryResult2 = mysqli_num_rows($results2);

            if ($queryResult2 > 0)
            {
              while ($row2 = mysqli_fetch_assoc($results2))
              {
                echo "<div class='hotel-box'>
                    <h3>".$row2['nome']."</h3>
                    <h6>".$row2['prezzo']."</h6>
                    <h5>".$row2['citta']."</h5>
                    <h5>".$row2['indirizzo']."</h5>
                    <p>".$row2['descrizione']."</p>
                    <br>
                  </div>";
              }
            }

         ?>
		 <?php
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') == TRUE) {
		?>
		<h3>strpos() dovrebbe ritornare non-false</h3>
		<b>Stai usando Internet Explorer</b>
		<?php
		} else {
		?>
		<h3>strpos() dovrebbe ritornare false</h3>
		<b>Non stai usando Internet Explorer</b>
		<?php
		}
		?>

        </div>
      </div>
    </section>

<?php
  include_once 'footer.php';
 ?>
