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

function sendToDB($deimtenCheck,$doorenCheck,$olstCheck,$aCheck,$bCheck,$cCheck,$Check1,$Check2,$Check3,$digiCheck,$stopCheck,$whiteCheck){

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['filterToepassen'])) {
      if (!isset($_POST['De Deimten'])) {
        $deimtenCheck = false;
      }else {
        $deimtenCheck = true;
      }
      if (!isset($_POST['Van Doorenveste'])) {
        $doorenCheck = false;
      }else {
        $doorenCheck = true;
      }
      if (!isset($_POST['Van OlstToren'])) {
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
  }

//if ($deimtenCheck = true){
//    echo 'ye';
//  }

  sendToDB($deimtenCheck,$doorenCheck,$olstCheck,$aCheck,$bCheck,$cCheck,$Check1,$Check2,$Check3,$digiCheck,$stopCheck,$whiteCheck);

}

?>
