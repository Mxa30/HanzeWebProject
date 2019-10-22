<?php include "../../../../meta.php" ?>

</head>
<body>
  <?php include (COMPONENT_PATH . "/header/index.php") ?>
  <main>
    <div id="kamerLijstID">
      <div class="kamerHead">
         <h2>Reserveringen</h2>
         <form id="searchFormID">
           <input type="text" name="search" placeholder="Zoeken" id="searchInputID">
           <button type="submit" name="submit" id="searchButtonID">
             <img src="<?php echo ASSET_PATH ?>/search.png" alt="search" id="searchIconID">
          </button>
         </form>
      </div>
      <div id="kamerTableContain">
        <table id="kamerViewTableID">
          <thead>
            <tr>
              <th>Kamer</th>
              <th>Tijd</th>
              <th>Datum</th>
              <th>E-mail</th>
              <th>Actie</th>
            </tr>
          </thead>
          <tbody>
            <!-- PHP CODE VOOR DATABASE -->
            <tr>
              <td>A.214</td>
              <td>12:00-13:00</td>
              <td>30-10-2019</td>
              <td>mail@mail.mail</td>
              <td>
                <button type="button" name="wijzig" id="wijzigButton">Wijzigen</button>
                <button type="button" name="verwijder" id="verwijderButton">Verwijderen</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</body>
