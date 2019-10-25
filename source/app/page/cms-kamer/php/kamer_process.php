<?php
  // Query voor het verkrijgen van alle data voor de kamer lijst
  $sqlGetListQuery = "
  select R.kamernummer, R.gebouw, G.adres, R.vleugel, R.kamercapaciteit, R.faciliteit, R.kamersoort, R.beschrijving
  from ruimte R, gebouw G
  where R.gebouw = G.gebouw
  order by kamernummer;";

  // Query voor het verkrijgen van alle kamaernummers
  $sqlGetNrListQuery = "
  select kamernummer
  from ruimte
  order by kamernummer;";

  // Query voor het verkrijgen van alle faciliteiten
  $sqlGetFaciliteitListQuery = "
  select faciliteit
  from faciliteit
  order by faciliteit;";

  // Query's voor het verkrijgen van de form opties
  // Gebouw:
  $sqlGetOptionGebouwQuery = "
  select gebouw, adres
  from gebouw
  order by gebouw;";

  // Vleuel:
  $sqlGetOptionVleugelQuery = "
  select vleugel
  from vleugel
  order by vleugel;";

  // Kamersoort:
  // NOG AAN TE PASSEN, DIT MOET EEN APARTE TABEL WORDEN (NIET DATA HALEN UIT TABEL GEBOUW DUS).
  $sqlGetOptionSoortQuery = "
  select kamersoort
  from ruimte
  order by kamersoort;";

  // Faciliteiten:
  $sqlGetOptionFaciliteitQuery = "
  select faciliteit
  from faciliteit
  order by faciliteit;";

  // verstuur alle query's en bewaar de resulaten
  $kamerLijstResult = mysqli_query($conn, $sqlGetListQuery);
  $kamerNrLijstResult = mysqli_query($conn, $sqlGetNrListQuery);
  $kamerFaciliteitLijstResult = mysqli_query($conn, $sqlGetFaciliteitListQuery);
  $gebouwOptionResult = mysqli_query($conn, $sqlGetOptionGebouwQuery);
  $vleugelOptionResult = mysqli_query($conn, $sqlGetOptionVleugelQuery);
  $soortOptionResult = mysqli_query($conn, $sqlGetOptionSoortQuery);
  $faciliteitOptionResult = mysqli_query($conn, $sqlGetOptionFaciliteitQuery);

  // functie voor het manipuleren van de database, deze returnt een sql query
  function sendToDB($conn,$nums,$facils,$kamer,$gebouw,$vleugel,$capaciteit,$beschrijving,$kamersoort,$digibord,$stopcontacten,$whiteboard,$zichtbaar){
    // check of de verplichte velden zijn ingevuld
    if (empty($kamer) || empty($gebouw) || empty($vleugel) || empty($capaciteit) || empty($kamersoort) || empty($zichtbaar)) {
      $isEmpty = true;
      return $isEmpty;
    }else{
      // Voor elk kamernummer, vergelijk of deze al bestaat
      while($record = mysqli_fetch_assoc($nums)){
        // Als kamernummer niet bestaat geef een flase waarde
        if ($kamer != $record['kamernummer']) {
          $kamerExist = false;
          break;
        }else {// Anders geef een true waarde
          $kamerExist = true;
        }
      }
      // Als kamernummer niet bestaat, maak dan een query waar deze wordt toegveogd aan de database.
      if (!$kamerExist) {
        // Als faciliteiten allemaal niet gecheckt zijn, zorg dan dat deze niet wordt uitgevoerd in de query.
        if (!$digibord && !$stopcontacten && !$whiteboard) {
          $faciliteitEmpty = "";
        }else {
          $faciliteitEmpty = "faciliteit,";
        }
        // Als beschrijving leeg is, zorg dan dat deze niet wordt uitgevoerd in de query.
        if (empty($beschrijving)) {
          $beschrijvingEmpty = "";
        }else {
          $beschrijvingEmpty = "beschrijving,";
        }
        // Als faciliteit in de query moet en beschrijving ook, voer dan deze code uit.
        if (!empty($faciliteitEmpty) && !empty($beschrijvingEmpty)) {
          $sqlPostDeelKamerQuery1="";
          $sqlPostDeelKamerQuery2="";
          $sqlPostDeelKamerQuery3="";
          // Voor elke faciliteit, maak een query die die faciliteit apart toevoegd.
          while($record = mysqli_fetch_assoc($facils)){
            // als digibord gecheckt is, maak er dan een query voor.
            if ($digibord && $record['faciliteit'] == 'digibord') {
              $sqlPostDeelKamerQuery1 = "('{$kamer}','{$record['faciliteit']}','{$beschrijving}','{$gebouw}','{$vleugel}','$kamersoort','{$capaciteit}')";
            }
            // als stopcontacten gecheckt is, maak er dan een query voor.
            if ($stopcontacten && $record['faciliteit'] == 'stopcontacten') {
              $sqlPostDeelKamerQuery2 = "('{$kamer}','{$record['faciliteit']}','{$beschrijving}','{$gebouw}','{$vleugel}','$kamersoort','{$capaciteit}')";
            }
            // als whiteboard gecheckt is, maak er dan een query voor.
            if ($whiteboard && $record['faciliteit'] == 'whiteboard') {
              $sqlPostDeelKamerQuery3 = "('{$kamer}','{$record['faciliteit']}','{$beschrijving}','{$gebouw}','{$vleugel}','$kamersoort','{$capaciteit}'";
            }
          }
          // Voeg het einde van elke deelquery toe op basis van welke deelquey's ingevuld zijn.
          if (!empty($sqlPostDeelKamerQuery1) && !empty($sqlPostDeelKamerQuery2) && !empty($sqlPostDeelKamerQuery3)) {
            $sqlPostDeelKamerQuery1 .= ",";
            $sqlPostDeelKamerQuery2 .= ",";
            $sqlPostDeelKamerQuery3 .= ";";
          }else if(!empty($sqlPostDeelKamerQuery1) && !empty($sqlPostDeelKamerQuery2) && empty($sqlPostDeelKamerQuery3)){
            $sqlPostDeelKamerQuery1 .= ",";
            $sqlPostDeelKamerQuery2 .= ";";
          }else if(!empty($sqlPostDeelKamerQuery1) && empty($sqlPostDeelKamerQuery2) && !empty($sqlPostDeelKamerQuery3)){
            $sqlPostDeelKamerQuery1 .= ",";
            $sqlPostDeelKamerQuery3 .= ";";
          }else if(empty($sqlPostDeelKamerQuery1) && !empty($sqlPostDeelKamerQuery2) && !empty($sqlPostDeelKamerQuery3)){
            $sqlPostDeelKamerQuery2 .= ",";
            $sqlPostDeelKamerQuery3 .= ";";
          }else if(!empty($sqlPostDeelKamerQuery1) && empty($sqlPostDeelKamerQuery2) && empty($sqlPostDeelKamerQuery3)){
            $sqlPostDeelKamerQuery1 .= ";";
          }else if(empty($sqlPostDeelKamerQuery1) && !empty($sqlPostDeelKamerQuery2) && empty($sqlPostDeelKamerQuery3)){
            $sqlPostDeelKamerQuery2 .= ";";
          }else if(empty($sqlPostDeelKamerQuery1) && empty($sqlPostDeelKamerQuery2) && !empty($sqlPostDeelKamerQuery3)){
            $sqlPostDeelKamerQuery3 .= ";";
          }
          // De query samenstellen
          $sqlPostKamerQuery = "
          insert into ruimte (kamernummer,{$faciliteitEmpty}{$beschrijvingEmpty}gebouw,vleugel,kamersoort,kamercapaciteit)
          values {$sqlPostDeelKamerQuery1}{$sqlPostDeelKamerQuery2}{$sqlPostDeelKamerQuery3}";

          if (mysqli_query($conn, $sqlPostKamerQuery)) {
            // Added successfully
          }else{
            echo "Error: " . $sqlPostKamerQuery . "<br>" . mysqli_error($conn);
          }
        }
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
      sendToDB($conn,$kamerNrLijstResult,$kamerFaciliteitLijstResult,$_POST['kamerNr'],$_POST['gebouw'],$_POST['vleugel'],$_POST['capaciteit'],$_POST['beschrijving'],$_POST['kamersoort'],$check1,$check2,$check3,$_POST['zichtbaar']);
    }
  }
?>
