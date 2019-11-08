<?php include "../../../../meta.php" ?>
</head>
<body>
<?php include (COMPONENT_PATH . "/header/index.php") ?>

<main>
  <?php include COMPONENT_PATH . "/filter/html/index.php" ?>
  <?php //include "../php/functions.php"; ?>
  <div class="overzicht_main">
    <form method="post">
      <!-- FUNCTIE maken om de datum te veranderen-->
    <div class="date">
    <p>Date: <input type="date" name="date" id="datepicker"></p>
    <?php
    if (isset($errorCode)) {
      echo $errorCode;
    }
    ?>
    </div>

    <!-- foto's van de kamers erin toevoegen -->

    <div class="overzicht_container">
      <div class="overzichtTabel_container">
            <!-- eerst de tabel maken voor de foto, met de knop 'meer informatie' -->
          <?php
          while ($record = mysqli_fetch_assoc($sqlGetroomnrResult)){
            if ($record['gebouw'] == "Van DoorenVeste") {
              $imgLink = ASSET_PATH . "/afbeelding_vanDoorenveste.jpg";
              $gebouwVal = substr($record['gebouw'], strpos($record['gebouw'],"Van ")+4, strlen($record['gebouw']));
            }elseif ($record['gebouw'] == "Van OlstToren") {
              $imgLink = ASSET_PATH . "/afbeelding_vanOlsttoren.jpg";
              $gebouwVal = substr($record['gebouw'], strpos($record['gebouw'],"Van ")+4, strlen($record['gebouw']));
            }
            echo "
            <table class='headTable'>
            <tr class='overzicht_full_container'>
              <td class='overzicht_left_container'>
                <table class= 'overzicht_left_inner_table '>
                  <tr class= 'overzicht_img_container '>
                    <td class= 'overzicht_img'><img src='{$imgLink}' alt='' style= 'width:auto; height:auto;'><hr></td>
                  </tr>
                  <tr class= 'overzicht_informatie_container'>
                    <td class= 'overzicht_informatie'>Kamer: {$record['vleugel']}.{$record['kamernummer']} Locatie: {$record['gebouw']}</td>
                  </tr class= 'overzicht_button_container'>
                  <tr class= 'overzicht_button'>
                    <td class='overzicht_button_td'><button class='overzicht_button_button' type='submit' name='button{$record['kamernummer']}-{$gebouwVal}'>Meer informatie</button></td>
                  </tr>
                </table>
              </td>
              <td class='overzicht_right_container'>
                <div class='overzicht_time_container'>

                </div>
              </td>
            </tr>
            </table>";
          }
          ?>
        </div>
      </div>
    </form>
  </div>
</main>

</body>
