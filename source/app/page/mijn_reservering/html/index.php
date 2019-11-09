<?php include "../../../../meta.php";
      include "../php/mijn_reservering_function.php";
      include "../css/style.css";
?>

</head>
<body>
  <?php include (COMPONENT_PATH . "/header/index.php") ?>
  <h2> Hier zijn uw reserveringen te vinden</h2>
  //reserveringen ophalen van andere bestanden
  <form action="....php" method="post" method="post">
  <table>
    <tr>
    <td> gebouw</td>
  //Poging om gebouw uit de database te halen met een GET functie
    <td> input type= "GET" ...
  </table>

  <main>
    <div id="kamerLijstID">
      <div class="kamerHead">
         <h2>Reserveringen</h2>
         <form id="searchFormID" method="post">
           <input type="text" name="searchResId" placeholder="Zoeken op id" id="searchInputID">
           <button type="submit" name="submitResId" id="searchButtonID">
             <img src="<?php echo ASSET_PATH ?>/search.png" alt="search" id="searchIconID">
          </button>
         </form>
      </div>
      <div id="kamerTableContain">
        <table id="kamerViewTableID">
          <thead>
            <tr>
              <th>Kamer</th>
              <th>Gebouw</th>
              <th>Tijd</th>
              <th>Datum</th>
              <th>E-mail</th>
              <th>Actie</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while($record = mysqli_fetch_assoc($sqlGetResResult)){
                echo "
                <tr>
                  <td>{$record['vleugel']}.{$record['kamernummer']}</td>
                  <td>{$record['gebouw']}</td>
                  <td>{$record['starttijd']}-{$record['eindtijd']}</td>
                  <td>{$record['reserveringsdatum']}</td>
                  <td>{$record['email']}</td>
                  <td>
                    <form method='post'>
                      <button type='submit' name='verwijder{$record['id']}' id='verwijderButton'>Verwijderen</button>
                    </form>
                  </td>
                </tr>
                ";
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <?php

   ?>
</body>
<nav>
</nav>
