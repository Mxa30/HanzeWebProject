<?php include "../../../../meta.php";
      include "../php/mijnsearch.php";
      include "../php/mijn_reservering_function.php";
      include "../css/style.css";
?>

</head>
<body>
  <?php include (COMPONENT_PATH . "/header/index.php") ?>
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
              <th>ID</th>
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
                  <td>{$record['id']}</td>
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
</body>
