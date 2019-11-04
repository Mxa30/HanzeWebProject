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
where faciliteit != ' '
order by faciliteit";

$sqlGetOptionFaciliteitResult = mysqli_query($conn, $sqlGetOptionFaciliteitQuery);

// Functie om querys te maken die worden verstuurd naar de database om gefilterde kamers te laten zien.
function filterFunc($conn,$doorenCheck,$olstCheck,$aCheck,$bCheck,$cCheck,$dCheck,$eCheck,$Check0,$Check1,$Check2,$Check3,$Check4,$digiCheck,$stopCheck,$whiteCheck){
  // Als DoorenVeste is gecheckt, maak dan de deelquery, maak anders een lege string
  if ($doorenCheck) {
    $doorenQuery = "  (gebouw = 'Van DoorenVeste'";
  }else {
    $doorenQuery = "";
  }

  // Als OlstToren is gecheckt, maak dan de deelquery, maak anders een lege string
  if ($doorenCheck && $olstCheck) {
    $olstQuery = " or gebouw = 'Van OlstToren'";
  }elseif($olstCheck) {
    $olstQuery = " (gebouw = 'Van OlstToren'";
  }else {
    $olstQuery = "";
  }

  // Maak array met daarin de waardes van de deelquerys
    $gebouwArray = array($doorenQuery,$olstQuery);

  // Als Vleugel a is gecheckt, maak dan de deelquery, maak anders een lege string
  if ($aCheck) {
    $aQuery = " (vleugel = 'A'";
  }else {
    $aQuery = "";
  }

  // Als Vleugel b is gecheckt, maak dan de deelquery, maak anders een lege string
  if ($aCheck && $bCheck) {
    $bQuery = " or vleugel = 'B'";
  } elseif($bCheck) {
    $bQuery = " (vleugel = 'B'";
  } else {
    $bQuery = "";
  }

  // Als Vleugel c is gecheckt, maak dan de deelquery, maak anders een lege string
  if ($aCheck && $bCheck && $cCheck) {
    $cQuery = " or vleugel = 'C'";
  }elseif($aCheck && $cCheck) {
    $cQuery = " or vleugel = 'C'";
  }elseif($bCheck && $cCheck) {
    $cQuery = " or vleugel = 'C'";
  }elseif($cCheck){
    $cQuery = " (vleugel = 'C'";
  }else {
    $cQuery = "";
  }

  // Als Vleugel d is gecheckt, maak dan de deelquery, maak anders een lege string
  if ($aCheck && $bCheck && $cCheck && $dCheck) {
    $dQuery = " or vleugel = 'D'";
  }elseif($aCheck && $dCheck) {
    $dQuery = " or vleugel = 'D'";
  }elseif($bCheck && $dCheck) {
    $dQuery = " or vleugel = 'D'";
  }elseif($cCheck && $dCheck) {
    $dQuery = " or vleugel = 'D'";
  }elseif($dCheck){
    $dQuery = " (vleugel = 'D'";
  }else {
    $dQuery = "";
  }

  // Als Vleugel e is gecheckt, maak dan de deelquery, maak anders een lege string
  if ($aCheck && $bCheck && $cCheck && $dCheck && $eCheck) {
    $eQuery = " or vleugel = 'E'";
  }elseif($aCheck && $eCheck) {
    $eQuery = " or vleugel = 'E'";
  }elseif($bCheck && $eCheck) {
    $eQuery = " or vleugel = 'E'";
  }elseif($cCheck && $eCheck) {
    $eQuery = " or vleugel = 'E'";
  }elseif($dCheck && $eCheck) {
    $eQuery = " or vleugel = 'E'";
  }elseif($eCheck){
    $eQuery = " (vleugel = 'E'";
  }else {
    $eQuery = "";
  }

  // Maak array met daarin de waardes van de deelquerys
  $vleugelArray = array($aQuery,$bQuery,$cQuery,$dQuery,$eQuery);

  if ($Check0) {
    $Query0 = " (verdieping = '0'";
  }else {
    $Query0 = "";
  }

  if ($Check0 && $Check1) {
    $Query1 = " or verdieping = '1'";
  }elseif ($Check1) {
    $Query1 = " (verdieping = '1'";
  }else {
    $Query1 = "";
  }

  if ($Check0 && $Check1 && $Check2) {
    $Query2 = " or verdieping = '2'";
  }elseif ($Check0 && $Check2) {
    $Query2 = " or verdieping = '2'";
  }elseif ($Check1 && $Check2) {
    $Query2 = " or verdieping = '2'";
  }elseif ($Check2) {
    $Query2 = " (verdieping = '2'";
  }else {
    $Query2 = "";
  }

  if ($Check0 && $Check1 && $Check2 && $Check3) {
    $Query3 = " or verdieping = '3'";
  }elseif ($Check0 && $Check3) {
    $Query3 = " or verdieping = '3'";
  }elseif ($Check1 && $Check3) {
    $Query3 = " or verdieping = '3'";
  }elseif ($Check2 && $Check3) {
    $Query3 = " or verdieping = '3'";
  }elseif ($Check3) {
    $Query3 = " (verdieping = '3'";
  }else {
    $Query3 = "";
  }

  if ($Check0 && $Check1 && $Check2 && $Check3 && $Check4) {
    $Query4 = " or verdieping = '4'";
  }elseif ($Check0 && $Check4) {
    $Query4 = " or verdieping = '4'";
  }elseif ($Check1 && $Check4) {
    $Query4 = " or verdieping = '4'";
  }elseif ($Check2 && $Check4) {
    $Query4 = " or verdieping = '4'";
  }elseif ($Check3 && $Check4) {
    $Query4 = " or verdieping = '4'";
  }elseif ($Check4) {
    $Query4 = " (verdieping = '4'";
  }else {
    $Query4 = "";
  }

  // Maak array met daarin de waardes van de deelquerys
  $verdiepingArray = array($Query0,$Query1,$Query2,$Query3,$Query4);

  if ($digiCheck) {
    $digiQuery = " (faciliteit = 'digibord'";
  }else {
    $digiQuery = "";
  }

  if ($digiCheck && $stopCheck) {
    $stopQuery = " or faciliteit = 'stopcontacten'";
  }elseif ($stopCheck) {
    $stopQuery = " (faciliteit = 'stopcontacten'";
  }else {
    $stopQuery = "";
  }

  if ($digiCheck && $stopCheck && $whiteCheck) {
    $whiteQuery = " or faciliteit = 'whiteboard'";
  }elseif ($digiCheck && $whiteCheck) {
    $whiteQuery = " or faciliteit = 'whiteboard'";
  }elseif ($stopCheck && $whiteCheck) {
    $whiteQuery = " or faciliteit = 'whiteboard'";
  }elseif ($whiteCheck) {
    $whiteQuery = " (faciliteit = 'whiteboard'";
  }else {
    $whiteQuery = "";
  }

  // Maak array met daarin de waardes van de deelquerys
  $faciliteitArray = array($digiQuery,$stopQuery,$whiteQuery);

  // Als niet alle gegevens zijn ingevuld geef dan een foutcode.
  // if ($doorenQuery == $olstQuery){
  //   echo '<script language="javascript">';
  //   echo 'alert("Vul al de gegevens in")';
  //   echo '</script>';
  //   return;
  // } elseif ($aQuery == $bQuery && $bQuery == $cQuery && $cQuery == $dQuery && $dQuery == $eQuery){
  //   echo '<script language="javascript">';
  //   echo 'alert("Vul al de gegevens in")';
  //   echo '</script>';
  //   return;
  // } elseif ($Query0 == $Query1 && $Query1 == $Query2 && $Query2 == $Query3 && $Query3 == $Query4){
  //   echo '<script language="javascript">';
  //   echo 'alert("Vul al de gegevens in")';
  //   echo '</script>';
  //   return;
  // } elseif ($digiQuery == $stopQuery && $stopQuery == $whiteQuery){
  //   echo '<script language="javascript">';
  //   echo 'alert("Vul al de gegevens in")';
  //   echo '</script>';
  //   return;
  // }

  // Gebruik dit om de where statement te laten zien na alle gegevens te hebben ingevuld.
  echo 'where';
  echo $doorenQuery,$olstQuery, ')';

  echo $aQuery,$bQuery,$cQuery,$dQuery,$eQuery, ')';
  if ($aQuery != $bQuery && $bQuery != $cQuery && $cQuery != $dQuery && $dQuery != $eQuery){
    echo ' and';
  }
  echo $Query0,$Query1,$Query2,$Query3,$Query4, ')';
  if ($Query0 != $Query1 && $Query1 != $Query2 && $Query2 != $Query3 && $Query3 != $Query4){
    echo ' and';
  }
  echo $digiQuery,$stopQuery,$whiteQuery, ')';
  if ($digiQuery != $stopQuery && $stopQuery != $whiteQuery){
    echo ' and';
  }
  echo ';';
  // Maak array met daarin de gemaakte arrays
  $deelQueryFilter = array($gebouwArray,$vleugelArray,$verdiepingArray,$faciliteitArray);

  // Gebuik dit om te checken hoe de array er uit ziet. breid alles hier boven uit zodat alles in de array komt.
  // echo "<pre>";
  // print_r ($deelQueryFilter);
  // echo "</pre>";


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

      if (!isset($_POST['0'])) {
        $Check0 = false;
      }else {
        $Check0 = true;
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
      if (!isset($_POST['4'])) {
        $Check4 = false;
      }else {
        $Check4 = true;
      }

      if (!isset($_POST['digibord'])) {
        $digiCheck = false;
      }else {
        $digiCheck = true;
      }
      if (!isset($_POST['stopcontacten'])) {
        $stopCheck = false;
      }else {
        $stopCheck = true;
      }
      if (!isset($_POST['whiteboard'])) {
        $whiteCheck = false;
      }else {
        $whiteCheck = true;
      }
      // Parse alle waardes naar de functie filterFunc
      filterFunc($conn,$doorenCheck,$olstCheck,$aCheck,$bCheck,$cCheck,$dCheck,$eCheck,$Check0,$Check1,$Check2,$Check3,$Check4,$digiCheck,$stopCheck,$whiteCheck);
  }

//if ($deimtenCheck = true){
//    echo 'ye';
//  }
}

?>
