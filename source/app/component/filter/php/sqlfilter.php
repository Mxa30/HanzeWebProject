<?php

$sqlGetOptionGebouwQuery = "
select gebouw
from gebouw
order by gebouw;";

$sqlGetOptionGebouwResult = mysqli_query($conn, $sqlGetOptionGebouwQuery);

$sqlGetOptionVleugelQuery = "
select vleugel
from vleugel
order by vleugel;";

$sqlGetOptionVleugelResult = mysqli_query($conn, $sqlGetOptionVleugelQuery);

$sqlGetOptionVerdiepingQuery = "
select verdieping
from verdieping
order by verdieping";

$sqlGetOptionVerdiepingResult = mysqli_query($conn, $sqlGetOptionVerdiepingQuery);

$sqlGetOptionFaciliteitQuery = "
select faciliteit
from faciliteit
order by faciliteit";

$sqlGetOptionFaciliteitResult = mysqli_query($conn, $sqlGetOptionFaciliteitQuery);

// Functie om querys te maken die worden verstuurd naar de database om gefilterde kamers te laten zien.
function filterFunc($conn,$doorenCheck,$olstCheck,$aCheck,$bCheck,$cCheck,$dCheck,$eCheck,$Check1,$Check2,$Check3,$digiCheck,$stopCheck,$whiteCheck){
  // Als DoorenVeste is gecheckt, maak dan de deelquery, maak anders een lege string
  if ($doorenCheck) {
    $doorenQuery = "
    gebouw = 'Van DoorenVeste'";
  }else {
    $doorenQuery = "";
  }

  // Als OlstToren is gecheckt, maak dan de deelquery, maak anders een lege string
  if ($olstCheck) {
    $olstQuery = "
    gebouw = 'Van OlstToren'";
  }else {
    $olstQuery = "";
  }
  // Maak array met daarin de waardes van de deelquerys
  $gebouwArray = array($doorenQuery,$olstQuery);

  // Als Vleugel a is gecheckt, maak dan de deelquery, maak anders een lege string
  if ($aCheck) {
    $aQuery = "
    vleugel = 'A'";
  }else {
    $aQuery = "";
  }

  // Als Vleugel b is gecheckt, maak dan de deelquery, maak anders een lege string
  if ($bCheck) {
    $bQuery = "
    vleugel = 'B'";
  }else {
    $bQuery = "";
  }

  // Als Vleugel c is gecheckt, maak dan de deelquery, maak anders een lege string
  if ($cCheck) {
    $cQuery = "
    vleugel = 'C'";
  }else {
    $cQuery = "";
  }

  // Als Vleugel d is gecheckt, maak dan de deelquery, maak anders een lege string
  if ($dCheck) {
    $dQuery = "
    vleugel = 'D'";
  }else {
    $dQuery = "";
  }

  // Als Vleugel e is gecheckt, maak dan de deelquery, maak anders een lege string
  if ($eCheck) {
    $eQuery = "
    vleugel = 'E'";
  }else {
    $eQuery = "";
  }
  // Maak array met daarin de waardes van de deelquerys
  $vleugelArray = array($aQuery,$bQuery,$cQuery,$dQuery,$eQuery,);

  // Maak array met daarin de gemaakte arrays
  $deelQueryFilter = array($gebouwArray,$vleugelArray);

  // Gebuik dit om te checken hoe de array er uit ziet. breid alles hier boven uit zodat alles in de array komt.
  echo "<pre>";
  print_r ($deelQueryFilter);
  echo "</pre>";
}

// Check of er een verzoek wordt gedaan om iets uit te voeren: toepassen knop
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check of het verzoek ook daatwerkelijk van de toepassen knop komt
  if (isset($_POST['filterToepassen'])) {
    // Geef waardes aan variabelen om vervolgens te kunnen gebruiken in de functie filterFunc
      if (!isset($_POST['DoorenVeste'])) {

        $doorenCheck = false;
      }else {
        $doorenCheck = true;
      }
      if (!isset($_POST['OlstToren'])) {
        $olstCheck = false;
      }else {
        $olstCheck = true;
      }

      if (!isset($_POST['A'])) {
        $aCheck = false;
      }else {
        $aCheck = true;
      }
      if (!isset($_POST['B'])) {
        $bCheck = false;
      }else {
        $bCheck = true;
      }
      if (!isset($_POST['C'])) {
        $cCheck = false;
      }else {
        $cCheck = true;
      }
      if (!isset($_POST['D'])) {
        $dCheck = false;
      }else {
        $dCheck = true;
      }
      if (!isset($_POST['E'])) {
        $eCheck = false;
      }else {
        $eCheck = true;
      }

      if (!isset($_POST['1'])) {
        $Check1 = false;
      }else {
        $Check1 = true;
      }
      if (!isset($_POST['2'])) {
        $Check2 = false;
      }else {
        $Check2 = true;
      }
      if (!isset($_POST['3'])) {
        $Check3 = false;
      }else {
        $Check3 = true;
      }

      if (!isset($_POST['Digibord'])) {
        $digiCheck = false;
      }else {
        $digiCheck = true;
      }
      if (!isset($_POST['Stopcontacten'])) {
        $stopCheck = false;
      }else {
        $stopCheck = true;
      }
      if (!isset($_POST['Whiteboard'])) {
        $whiteCheck = false;
      }else {
        $whiteCheck = true;
      }
      // Parse alle waardes naar de functie filterFunc
      filterFunc($conn,$doorenCheck,$olstCheck,$aCheck,$bCheck,$cCheck,$dCheck,$eCheck,$Check1,$Check2,$Check3,$digiCheck,$stopCheck,$whiteCheck);
  }

//if ($deimtenCheck = true){
//    echo 'ye';
//  }
}

?>
