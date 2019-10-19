<?php include "../../../../meta.php" ?>

<!-- DIT MAG NIET, DIT IS PLAGIAAT , alles dat in comments staat-->
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->

<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

<!-- <script>
$( function() {
  $( "#datepicker" ).datepicker();
} );
</script> -->

</head>
<body>
  <?php include (COMPONENT_PATH . "/header/index.php") ?>
<div class="date">
  <p>Date: <input type="text" id="datepicker"></p>
</div>


  <!-- foto's van de kamers erin toevoegen -->

  <!-- Poging om tijd te kunnen veranderen in een functie naast de datum(dat staat in center)-->
  <?php
  // $date = new DateTime('17-10-2019');
  // $date->modify('+1 day');
  // echo $date->format('d-m-Y');
  ?>
<table style="width:324px;" border="3" cellspacing="2" cellpadding="10">

  <!-- FUNCTIE maken om de datum te veranderen-->
  <!-- tabel Kamertijdtabel-->

  <tr>
    <td><b>Brugsmaborg</b></td>
  <center>
    <td> <b>8:00</b></td>
    <td> <b>9:00</b></td>
    <td> <b>10:00</b></td>
    <td> <b>11:00</b></td>
    <td> <b>12:00</b></td>
    <td> <b>13:00</b></td>
    <td> <b>14:00</b></td>
    <td> <b>15:00</b></td>
    <td> <b>16:00</b></td>
    <td> <b>17:00</b></td>
    <td> <b>18:00</b></td>
    <td> <b>19:00</b></td>
    <td> <b>20:00</b></td>
  </center>
  </tr>
  <td>
    <img src="../../../../asset/afbeelding_Brugsmaborg.jpg" alt="" style="width:auto; height:auto;">
  </td>
  <tr>
      <td><i> Vleugel A</i></td>
  </tr>

  <tr>
    <td>
      Kamer 1
      </td>
  </tr>

  <tr>
    <td><i> Vleugel B</i></td>
  </tr>

    <tr>
      <td>Kamer 1</td>
    </tr>

    <tr>
      <td> <i>Vleugel C</i></td>
    </tr>

    <tr>
      <td>Kamer 1</td>
    </tr>

      <tr>
        <td><i> Vleugel D</i></td>
      </tr>

      <tr>
          <td>Kamer 1</td>
      </tr>

    <tr>
      <td><b>van Doorenveste</b></td>
    </tr>
    <td>
      <img src="../../../../asset/afbeelding_vanDoorenveste.jpg" alt="" style="width:auto; height:auto;">
    </td>

    <tr>
      <td>Kamer 1</td>
    </tr>

    <tr>
      <td><b>van Olsttoren</b></td>
    </tr>
    <td>
      <img src="../../../../asset/afbeelding_vanOlsttoren.jpg" alt="" style="width:auto; height:auto;">
    </td>
    <tr>
      <td>Kamer 1</td>
    </tr>

</body>
