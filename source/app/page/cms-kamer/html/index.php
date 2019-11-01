<?php include "../../../../meta.php";
      include "../php/kamer_process.php";
?>

</head>
<body>
  <?php include (COMPONENT_PATH . "/header/index.php") ?>
  <main>
    <div id="kamerLijstID">
      <div class="kamerHead">
         <h2>Kamer lijst</h2>
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
              <th>Gebouw</th>
              <th>Vleugel</th>
              <th>Verdieping</th>
              <th>Capaciteit</th>
              <th>Faciliteiten</th>
              <th>Kamer soort</th>
              <th>Beschrijving</th>
              <th>Zichtbaar</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while($record = mysqli_fetch_assoc($kamerLijstResult)){
                echo "<tr>
                        <td>{$record['kamernummer']}</td>
                        <td>{$record['gebouw']} - {$record['adres']}</td>
                        <td>{$record['vleugel']}</td>
                        <td>{$record['verdieping']}</td>
                        <td>{$record['kamercapaciteit']}</td>
                        <td>{$record['faciliteit']}</td>
                        <td>{$record['kamersoort']}</td>
                        <td>{$record['beschrijving']}</td>
                        <td>{$record['zichtbaar']}</td>
                      </tr>";
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div id="kamerFormID">
      <div class="kamerHead">
        <h2>Kamer toevoegen</h2>
      </div>
      <div id="kamerFormContainID">
        <form method="post">
          <table id="kamerInputFormID">
            <tr>
              <td>Kamer:</td>
              <td><input type="text" name="kamerNr"></td>
            </tr>
            <tr>
              <td>Gebouw:</td>
              <td>
                <select name="gebouw">
                  <?php
                    while($record = mysqli_fetch_assoc($gebouwOptionResult)){
                      echo "<option value='{$record['gebouw']}'>{$record['gebouw']} - {$record['adres']}</option>";
                    }
                  ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Vleugel:</td>
              <td>
                <select name="vleugel">
                  <?php
                    while($record = mysqli_fetch_assoc($vleugelOptionResult)){
                      echo "<option value='{$record['vleugel']}'>{$record['vleugel']}</option>";
                    }
                  ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Verdieping:</td>
              <td>
                <select name="verdieping">
                  <?php while($record = mysqli_fetch_assoc($verdiepingOptionResult)){
                    echo "<option value='{$record['verdieping']}'>{$record['verdieping']}</option>";
                  }?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Capaciteit:</td>
              <td><input type="number" name="capaciteit" max="450"></td>
            </tr>
            <tr>
              <td>Beschrijving:</td>
              <td><textarea name="beschrijving"></textarea></td>
            </tr>
            <tr>
              <td>Kamersoort:</td>
              <td>
                <select name="kamersoort">
                  <?php
                    while($record = mysqli_fetch_assoc($soortOptionResult)){
                      echo "<option value='{$record['kamersoort']}'>{$record['kamersoort']}</option>";
                    }
                  ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Faciliteiten:</td>
              <td>
                <table>
                  <?php
                    while($record = mysqli_fetch_assoc($faciliteitOptionResult)){
                      echo "<tr>
                        <td>{$record['faciliteit']}:</td>
                        <td>
                          <input type='checkbox' name='{$record['faciliteit']}'>
                        </td>
                      </tr>";
                    }
                  ?>
                </table>
              </td>
            </tr>
            <tr>
              <td>Zichtbaar:</td>
              <td>
                <select name="zichtbaar">
                  <?php
                    while($record = mysqli_fetch_assoc($zichtbaarOptionResult)){
                      echo "<option value='{$record['zichtbaar']}'>{$record['zichtbaar']}</option>";
                    }
                  ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>
                <button type="submit" name="submitKamerVoeg" id="VoegButton">Toevoegen</button>
              </td>
              <td>
                <button type="submit" name="submitKamerVerwijder" id="VerwButton">Verwijderen</button>
              </td>
            </tr>
          </table>
        </form>
        <p id="noticeParID">Als het kamernummer al bestaat in de database zal
          deze worden geüpdate met de nieuwe waarden of worden verwijderd.</p>
      </div>
    </div>
  </main>
</body>
