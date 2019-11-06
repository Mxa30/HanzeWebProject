<?php include "../../../../meta.php" ?>
<link rel="stylesheet" href="../css/style.css">
<?php session_start(); ?>
</head>
<body class"body">

  <?php $filePath = "/source/app/page/reservering/html/index.php";
  include (COMPONENT_PATH . "/header/index.php");

  $sql = "
  SELECT kamernummer, ruimte.gebouw, vleugel, faciliteit, verdieping, kamercapaciteit, faciliteit, gebouw.adres
  from ruimte
  INNER JOIN gebouw
  ON ruimte.gebouw=gebouw.gebouw
  WHERE kamernummer=60";

  // $sqlResult = mysqli_query($conn, $sql);

  $result = $conn->query($sql);
//
//   if ($result->num_rows > 0) {
//     // output data of each row
//     $row = $result->fetch_assoc();
// } else {
//     echo "0 results";
// }
$record = mysqli_fetch_assoc($result);

    $row = $record;

  foreach ($record as $faciliteit) {
    if ($faciliteit == "digibord") {
      $digibord = true;
      break;
    }else {
      $digibord = false;
    }
  }

  foreach ($record as $faciliteit) {
    if ($faciliteit == "stopcontacten") {
      $stop = true;
      break;
    }else {
      $stop = false;
    }
  }

  foreach ($record as $faciliteit) {
    if ($faciliteit == "whiteboard") {
      $white = true;
      break;
    }else {
      $white = false;
    }
  }


  ?>
  <main>
    <div class="master">
    <p>  <?php echo $row["kamernummer"]; ?> | <?php echo $row["gebouw"]; ?> </p>

    <div class="beschrijvingContainer">
      <div class="informatieContainer">
<h3>Informatie</h3>
<?php
  if ($row["gebouw"] == 'Van DoorenVeste') {
    $imgLink = ASSET_PATH . "/afbeelding_vanDoorenveste.jpg";
  }else if($row["gebouw"] == 'Van OlstToren'){
    $imgLink = ASSET_PATH . "/afbeelding_vanOlstToren.jpg";
  }
?>
<div class="image">

<img src="<?php echo $imgLink; ?>" alt="">
</div>
<hr class="hr">

<br/>
<p>Gebouw : <?php echo $row["gebouw"]; ?></p>
<br/>
<p>Adres : <?php echo $row["adres"] ?></p>
<br/>
<p>Vleugel : <?php echo $row["vleugel"] ?></p>
<br/>
<p>Verdieping : <?php echo $row["verdieping"] ?></p>
<br/>
<p>Aantal personen : <?php echo $row["kamercapaciteit"] ?></p>
<br/>
<hr class="hr">
<div class="">
  <h3>Faciliteiten</h3>
<?php
  $checkBoxImg = ASSET_PATH . "/Check.png";
  $crossBoxImg = ASSET_PATH . "/Cross.png";

  if ($digibord) {
    echo "<img src='{$checkBoxImg}' alt=''>";
    echo "Digibord<br/>";
  }else{
    echo "<img src='{$crossBoxImg}' alt=''>";
    echo "Digibord<br/>";
  }

  if ($stop) {
    echo "<img src='{$checkBoxImg}' alt=''>";
    echo "Stopcontacten<br/>";
  }else{
    echo "<img src='{$crossBoxImg}' alt=''>";
    echo "Stopcontacten<br/>";
  }
  if ($white) {
    echo "<img src='{$checkBoxImg}' alt=''>";
    echo "Whiteboard<br/>";
  }else{
    echo "<img src='{$crossBoxImg}' alt=''>";
    echo "Whiteboard<br/>";
  }
?>

</div>
</div>
</div>
      <div class="Reserveringssysteem">
      <h3>reservering</h3>
      <hr class="hr">
      <p class="tijden">Tijd: van </p>
      <select class="tijd" name="">
        <option value="">08:30</option>
        <option value="">09:00</option>
        <option value="">09:30</option>
        <option value="">10:00</option>
        <option value="">10:30</option>
        <option value="">11:00</option>
        <option value="">11:30</option>
        <option value="">12:00</option>
        <option value="">12:30</option>
        <option value="">13:00</option>
        <option value="">13:30</option>
        <option value="">14:00</option>
        <option value="">14:30</option>
        <option value="">15:00</option>
        <option value="">15:30</option>
        <option value="">16:00</option>
        <option value="">16:30</option>
        <option value="">17:00</option>
        <option value="">17:30</option>
        <option value="">18:00</option>
        <option value="">18:30</option>
        <option value="">19:00</option>
      </select>
      <p class="tijden">Tot </p>
      <select class="tijd" name="">
        <option value="">08:30</option>
        <option value="">09:00</option>
        <option value="">09:30</option>
        <option value="">10:00</option>
        <option value="">10:30</option>
        <option value="">11:00</option>
        <option value="">11:30</option>
        <option value="">12:00</option>
        <option value="">12:30</option>
        <option value="">13:00</option>
        <option value="">13:30</option>
        <option value="">14:00</option>
        <option value="">14:30</option>
        <option value="">15:00</option>
        <option value="">15:30</option>
        <option value="">16:00</option>
        <option value="">16:30</option>
        <option value="">17:00</option>
        <option value="">17:30</option>
        <option value="">18:00</option>
        <option value="">18:30</option>
        <option value="">19:00</option>
      </select>
      <br>
      <p class="tijden">Datum</p>
      <input type="date" name="Datum" value="">
      <br>
      <button id="submitButtonID" type="submit" name="Reserveren">Reserveren</button>
      </div>
      <div class="timeTableContain">
      <h3>Tijden</h3>
      <hr class="hr">
        <div class="timeGraph">
          <ul class="timeoverlay">
            <li>08:00</li>
            <li>08:30</li>
            <li>09:00</li>
            <li>09:30</li>
            <li>10:00</li>
            <li>10:30</li>
            <li>11:00</li>
            <li>11:30</li>
            <li>12:00</li>
            <li>12:30</li>
            <li>13:00</li>
            <li>13:30</li>
            <li>14:00</li>
            <li>14:30</li>
            <li>15:00</li>
            <li>15:30</li>
            <li>16:00</li>
            <li>16:30</li>
            <li>17:00</li>
            <li>17:30</li>
            <li>18:00</li>
            <li>18:30</li>
            <li>19:00</li>
          </ul>
          <ul class="lineoverlay">
            <li><div class="line"></div>08:00</li>
            <li>08:30</li>
            <li>09:00</li>
            <li>09:30</li>
            <li>10:00</li>
            <li>10:30</li>
            <li>11:00</li>
            <li>11:30</li>
            <li>12:00</li>
            <li>12:30</li>
            <li>13:00</li>
            <li>13:30</li>
            <li>14:00</li>
            <li>14:30</li>
            <li>15:00</li>
            <li>15:30</li>
            <li>16:00</li>
            <li>16:30</li>
            <li>17:00</li>
            <li>17:30</li>
            <li>18:00</li>
            <li>18:30</li>
            <li>19:00</li>
          </ul>
        </div>
      </div>
    </div>
  </main>
</body>
