<?php include "../../../../meta.php" ?>

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
              <th>Capaciteit</th>
              <th>Faciliteiten</th>
              <th>Kamer soort</th>
              <th>Beschrijving</th>
            </tr>
          </thead>
          <tbody>
            <!-- PHP CODE VOOR DATABASE -->
          </tbody>
        </table>
      </div>
    </div>
    <div id="kamerFormID">
      <div class="kamerHead">
        <h2>Kamer lijst</h2>
      </div>
      <div id="kamerFormContainID">
        <form>
          <table id="kamerInputFormID">
            <tr>
              <td>Kamer:</td>
              <td><input type="text" name="kamerNr"></td>
            </tr>
            <tr>
              <td>Gebouw:</td>
              <td>
                <select name="gebouw">
                </select>
              </td>
            </tr>
            <tr>
              <td>Vleugel:</td>
              <td>
                <select name="vleugel">
                </select>
              </td>
            </tr>
            <tr>
              <td>Capaciteit:</td>
              <td><input type="number" name="capaciteit"></td>
            </tr>
            <tr>
              <td>Beschrijving:</td>
              <td><textarea name="beschrijving"></textarea></td>
            </tr>
            <tr>
              <td>Kamersoort:</td>
              <td>
                <select name="kamersoort">

                </select>
              </td>
            </tr>
            <tr>
              <!-- VOEG MEER OPTIES TOE -->
              <td>Faciliteiten:</td>
              <td>
                <table>
                  <tr>
                    <td>Digibord:</td>
                    <td>
                      <input type="checkbox" name="digibord">
                    </td>
                  </tr>
                  <tr>
                    <td>Stopcontacten:</td>
                    <td>
                      <input type="checkbox" name="stopcontacten">
                    </td>
                  </tr>
                  <tr>
                    <td>Whiteboard:</td>
                    <td>
                      <input type="checkbox" name="whiteboard">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>Zichtbaarheid:</td>
              <td>
                <select name="zichtbaar">
                  <option value="">Zichtbaar</option>
                  <option value="">Niet zichtbaar</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>
                <button type="submit" name="submitKamer" id="VoegButton">Toevoegen</button>
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
