<?php
  // Query voor het verkrijgen van alle data voor de kamer lijst
  $sqlGetListQuery = "
  select R.kamernummer, R.gebouw, G.adres, R.vleugel, R.kamercapaciteit, R.faciliteit, R.kamersoort, R.beschrijving
  from ruimte R, gebouw G
  where R.gebouw = G.gebouw
  order by kamernummer";

  // Query voor het verkrijgen van alle kamaernummers
  $sqlGetNrListQuery = "
  select kamernummer
  from ruimte
  order by kamernummer";

  // Query's voor het verkrijgen van de form opties
  // Gebouw:
  $sqlGetOptionGebouwQuery = "
  select gebouw, adres
  from gebouw
  order by gebouw";

  // Vleuel:
  $sqlGetOptionVleugelQuery = "
  select vleugel
  from vleugel
  order by vleugel";

  // Kamersoort:
  // NOG AAN TE PASSEN, DIT MOET EEN APARTE TABEL WORDEN (NIET DATA HALEN UIT TABEL GEBOUW DUS).
  $sqlGetOptionSoortQuery = "
  select kamersoort
  from ruimte
  order by kamersoort";

  // Faciliteiten:
  $sqlGetOptionFaciliteitQuery = "
  select faciliteit
  from faciliteit
  order by faciliteit";

  // verstuur alle query's en bewaar de resulaten
  $kamerLijstResult = mysqli_query($conn, $sqlGetListQuery);
  $kamerNrLijstResult = mysqli_query($conn, $sqlGetNrListQuery);
  $gebouwOptionResult = mysqli_query($conn, $sqlGetOptionGebouwQuery);
  $vleugelOptionResult = mysqli_query($conn, $sqlGetOptionVleugelQuery);
  $soortOptionResult = mysqli_query($conn, $sqlGetOptionSoortQuery);
  $faciliteitOptionResult = mysqli_query($conn, $sqlGetOptionFaciliteitQuery);

  // functie voor het manipuleren van de database, deze returnt een sql query
  function sendToDB($nums,$kamer,$gebouw,$vleugel,$capaciteit,$beschrijving,$kamersoort,$digibord,$stopcontacten,$whiteboard,$zichtbaar){
    while($record = mysqli_fetch_assoc($nums)){
      if ($kamer == $record['kamernummer']) {
        echo "string";
      }
    }
  }

// Voer alleen uit als er een postrequest wordt gedaan
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // check of checkboxes gecheckt zijn en geeft ze de waarde true of false
    if (isset($_POST['submitKamerVoeg'])) {
      if (!isset($_POST['digibord'])) {
        $check1 = false;
      }else {
        $check1 = true;
      }
      if (!isset($_POST['stopcontacten'])) {
        $check2 = false;
      }else {
        $check2 = true;
      }
      if (!isset($_POST['whiteboard'])) {
        $check3 = false;
      }else {
        $check3 = true;
      }
      // stuur waarden van form op naar de functie sendToDB
      $sendToDBQuery = sendToDB($kamerNrLijstResult,$_POST['kamerNr'],$_POST['gebouw'],$_POST['vleugel'],$_POST['capaciteit'],$_POST['beschrijving'],$_POST['kamersoort'],$check1,$check2,$check3,$_POST['zichtbaar']);
    }
  }
?>
