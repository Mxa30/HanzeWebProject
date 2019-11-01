<?php include "../../../../meta.php" ?>

<?php include "../php/functions.php"; ?>
  <?php include (COMPONENT_PATH . "/header/index.php") ?>
</head>
<body>


    <!-- FUNCTIE maken om de datum te veranderen-->
<div class="date">
  <p>Date: <input type="date" id="datepicker"></p>
</div>

  <!-- foto's van de kamers erin toevoegen -->

  <div class="overzicht_container">
    <div class="overzicht_header">

    </div>
    <div class="overzichtTabel_container">
      <table>
          <!-- eerst de tabel maken voor de foto, met de knop 'meer informatie' -->
        <?php
          echo "
          <tr class='overzicht_full_container'>
            <td class='overzicht_left_container'>
              <table class= 'overzicht_left_inner_table '>
                <tr class= 'overzicht_img_container '>
                  <td class= 'overzicht_img'><img src='../../../../asset/afbeelding_Brugsmaborg.jpg' alt=' style= 'width:auto; height:auto;'></td>
                </tr>
                <tr class= 'overzicht_informatie_container'>
                  <td class= 'overzicht_informatie'>Kamer: A.214 Locatie: blabla</td>
                </tr class= 'overzicht_button_container'>
                <tr class= 'overzicht_button'>
                  <td><button class= 'overzicht_button_button' type='submit' name='button'>Meer informatie</button></td>
                </tr>
              </table>
            </td>
            <td class='overzicht_right_container'>
              <div class='overzicht_time_container'>

              </div>
            </td>
          </tr>";

        ?>
      </table>
    </div>
  </div>
