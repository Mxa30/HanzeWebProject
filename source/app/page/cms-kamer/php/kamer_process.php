<?php
  // Query voor het verkrijgen van alle data voor de kamer lijst
  $sqlGetListQuery = "
  select R.kamernummer, R.gebouw, G.adres, R.vleugel, R.verdieping, R.kamercapaciteit, R.faciliteit, R.kamersoort, R.beschrijving, R.zichtbaar
  from ruimte R, gebouw G
  where R.gebouw = G.gebouw {$searchKamerVal}
  order by kamernummer, faciliteit;";

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

  // Vleugel:
  $sqlGetOptionVleugelQuery = "
  select vleugel
  from vleugel
  order by vleugel;";

  // Kamersoort:
  // NOG AAN TE PASSEN, DIT MOET EEN APARTE TABEL WORDEN (NIET DATA HALEN UIT TABEL GEBOUW DUS).
  $sqlGetOptionSoortQuery = "
  select kamersoort
  from kamersoort
  order by kamersoort;";

  // Faciliteiten:
  $sqlGetOptionFaciliteitQuery = "
  select faciliteit
  from faciliteit
  where faciliteit != ''
  order by faciliteit;";

  $verdiepingOptionQuery = "
  select verdieping
  from verdieping
  order by verdieping;";

  $zichtbaarOptionQuery = "
  select zichtbaar
  from zichtbaar
  order by zichtbaar desc;";

  // verstuur alle query's en bewaar de resulaten
  $kamerLijstResult = mysqli_query($conn, $sqlGetListQuery);
  $kamerNrLijstResult = mysqli_query($conn, $sqlGetNrListQuery);
  $kamerFaciliteitLijstResult = mysqli_query($conn, $sqlGetFaciliteitListQuery);
  $gebouwOptionResult = mysqli_query($conn, $sqlGetOptionGebouwQuery);
  $vleugelOptionResult = mysqli_query($conn, $sqlGetOptionVleugelQuery);
  $soortOptionResult = mysqli_query($conn, $sqlGetOptionSoortQuery);
  $faciliteitOptionResult = mysqli_query($conn, $sqlGetOptionFaciliteitQuery);
  $verdiepingOptionResult = mysqli_query($conn, $verdiepingOptionQuery);
  $zichtbaarOptionResult = mysqli_query($conn, $zichtbaarOptionQuery);

  // functie voor het manipuleren van de database, deze returnt een sql query
  function sendToDB($conn,$nums,$facils,$kamer,$gebouw,$vleugel,$verdieping,$capaciteit,$beschrijving,$kamersoort,$digibord,$stopcontacten,$whiteboard,$zichtbaar){
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
        }else {// Anders geef een true waarde
          $kamerExist = true;
          break;
        }
      }
      // Als kamernummer niet bestaat, maak dan een query waar deze wordt toegveogd aan de database.
      if ($kamerExist == false) {
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
              $sqlPostDeelKamerQuery1 = "('{$kamer}','{$record['faciliteit']}','{$beschrijving}','{$gebouw}','{$vleugel}','{$verdieping}','$kamersoort','{$capaciteit}','{$zichtbaar}')";
            }
            // als stopcontacten gecheckt is, maak er dan een query voor.
            if ($stopcontacten && $record['faciliteit'] == 'stopcontacten') {
              $sqlPostDeelKamerQuery2 = "('{$kamer}','{$record['faciliteit']}','{$beschrijving}','{$gebouw}','{$vleugel}','{$verdieping}','$kamersoort','{$capaciteit}','{$zichtbaar}')";
            }
            // als whiteboard gecheckt is, maak er dan een query voor.
            if ($whiteboard && $record['faciliteit'] == 'whiteboard') {
              $sqlPostDeelKamerQuery3 = "('{$kamer}','{$record['faciliteit']}','{$beschrijving}','{$gebouw}','{$vleugel}','{$verdieping}','$kamersoort','{$capaciteit}','{$zichtbaar}')";
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
          insert into ruimte (kamernummer,faciliteit,beschrijving,gebouw,vleugel,verdieping,kamersoort,kamercapaciteit,zichtbaar)
          values {$sqlPostDeelKamerQuery1}{$sqlPostDeelKamerQuery2}{$sqlPostDeelKamerQuery3}";

          if (mysqli_query($conn, $sqlPostKamerQuery)) {
            // Added successfully
          }else{
            echo "Error: " . $sqlPostKamerQuery . "<br>" . mysqli_error($conn);
          }
        }
        // Als faciliteit in de query moet en beschrijving niet, voer dan deze code uit.
        elseif (!empty($faciliteitEmpty) && empty($beschrijvingEmpty)) {
          $sqlPostDeelKamerQuery1="";
          $sqlPostDeelKamerQuery2="";
          $sqlPostDeelKamerQuery3="";
          // Voor elke faciliteit, maak een query die die faciliteit apart toevoegd.
          while($record = mysqli_fetch_assoc($facils)){
            // als digibord gecheckt is, maak er dan een query voor.
            if ($digibord && $record['faciliteit'] == 'digibord') {
              $sqlPostDeelKamerQuery1 = "('{$kamer}','{$record['faciliteit']}','{$gebouw}','{$vleugel}',{$verdieping},'$kamersoort','{$capaciteit}','{$zichtbaar}')";
            }
            // als stopcontacten gecheckt is, maak er dan een query voor.
            if ($stopcontacten && $record['faciliteit'] == 'stopcontacten') {
              $sqlPostDeelKamerQuery2 = "('{$kamer}','{$record['faciliteit']}','{$gebouw}','{$vleugel}',{$verdieping},'$kamersoort','{$capaciteit}','{$zichtbaar}')";
            }
            // als whiteboard gecheckt is, maak er dan een query voor.
            if ($whiteboard && $record['faciliteit'] == 'whiteboard') {
              $sqlPostDeelKamerQuery3 = "('{$kamer}','{$record['faciliteit']}','{$gebouw}','{$vleugel}',{$verdieping},'$kamersoort','{$capaciteit}','{$zichtbaar}')";
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
          insert into ruimte (kamernummer,faciliteit,gebouw,vleugel,verdieping,kamersoort,kamercapaciteit,zichtbaar)
          values {$sqlPostDeelKamerQuery1}{$sqlPostDeelKamerQuery2}{$sqlPostDeelKamerQuery3}";

          if (mysqli_query($conn, $sqlPostKamerQuery)) {
            // Added successfully
          }else{
            echo "Error: " . $sqlPostKamerQuery . "<br>" . mysqli_error($conn);
          }
        }
        elseif (empty($faciliteitEmpty) && !empty($beschrijvingEmpty)) {
          $sqlPostDeelKamerQuery = "('{$kamer}','{$gebouw}','{$beschrijving}','{$vleugel}',{$verdieping},'$kamersoort','{$capaciteit}','{$zichtbaar}')";
          // De query samenstellen
          $sqlPostKamerQuery = "
          insert into ruimte (kamernummer,gebouw,beschrijving,vleugel,verdieping,kamersoort,kamercapaciteit,zichtbaar)
          values {$sqlPostDeelKamerQuery}";

          if (mysqli_query($conn, $sqlPostKamerQuery)) {
            // Added successfully
          }else{
            echo "Error: " . $sqlPostKamerQuery . "<br>" . mysqli_error($conn);
          }
        }
        elseif (empty($faciliteitEmpty) && empty($beschrijvingEmpty)) {
          $sqlPostDeelKamerQuery = "('{$kamer}','{$gebouw}','{$vleugel}',{$verdieping},'$kamersoort','{$capaciteit}','{$zichtbaar}')";
          // De query samenstellen
          $sqlPostKamerQuery = "
          insert into ruimte (kamernummer,gebouw,vleugel,verdieping,kamersoort,kamercapaciteit,zichtbaar)
          values {$sqlPostDeelKamerQuery}";

          if (mysqli_query($conn, $sqlPostKamerQuery)) {
            // Added successfully
          }else{
            echo "Error: " . $sqlPostKamerQuery . "<br>" . mysqli_error($conn);
          }
        }
      }
      // Als kamernummer bestaat, maak d'an een query waar deze wordt geupdate in de database.
      if ($kamerExist == true) {
        // Als faciliteiten allemaal niet gecheckt zijn, zorg dan dat deze niet wordt uitgevoerd in de query.
        if (!$digibord && !$stopcontacten && !$whiteboard) {
          $faciliteitEmpty = "";
        }else {
          $faciliteitEmpty = "faciliteit,";
        }
          // Valideer of faciliteit bestaat bij het kamernummer
          $sqlGetFacilKamer = "
          select faciliteit
          from ruimte
          where kamernummer = '{$kamer}'
          order by faciliteit;";
          $facilKamerResult = mysqli_query($conn, $sqlGetFacilKamer);
          while ($record = mysqli_fetch_assoc($facilKamerResult)) {
            if ($record['faciliteit'] == 'digibord') {
              $digVal = true;
            }
            if ($record['faciliteit'] == 'stopcontacten') {
              $stopVal = true;
            }
            if ($record['faciliteit'] == 'whiteboard') {
              $whiteVal = true;
            }
            if ($record['faciliteit'] == '') {
              $nullVal = true;
            }
          }
          // Voor elke faciliteit, maak een query die die faciliteit apart toevoegd.

          // als digibord gecheckt is, maak er dan een query voor.
          if ($digibord && isset($digVal)) {
            $sqlPostDeelKamerQuery = "`faciliteit` = 'digibord',`beschrijving` = '{$beschrijving}',`gebouw` = '{$gebouw}',`vleugel` = '{$vleugel}',`verdieping` = '{$verdieping}',`kamersoort` = '$kamersoort',`kamercapaciteit` = '{$capaciteit}',`zichtbaar` = '{$zichtbaar}'";
            $sqlPostKamerQuery = "
            update ruimte
            set {$sqlPostDeelKamerQuery}
            where kamernummer = {$kamer} and (faciliteit = 'digibord' or faciliteit = '');";
            if (mysqli_query($conn, $sqlPostKamerQuery)) {
              // Added successfully
            }
            else{
              echo "Error: " . $sqlPostKamerQuery . "<br>" . mysqli_error($conn);
            }
          }
          else if ($digibord && !isset($digVal) && !isset($nullVal)) {
            $sqlPostDeelKamerQuery = "('{$kamer}','digibord','{$beschrijving}','{$gebouw}','{$vleugel}','{$verdieping}','$kamersoort','{$capaciteit}','{$zichtbaar}')";
            $sqlPostKamerQuery = "
            insert into ruimte (kamernummer,faciliteit,beschrijving,gebouw,vleugel,verdieping,kamersoort,kamercapaciteit,zichtbaar)
            values {$sqlPostDeelKamerQuery}";
            if (mysqli_query($conn, $sqlPostKamerQuery)) {
              // Added successfully
            }
            else{
              echo "Error: " . $sqlPostKamerQuery . "<br>" . mysqli_error($conn);
            }
          }
          else if ($digibord && !isset($digVal) && isset($nullVal)) {
            $sqlPostDeelKamerQuery = "`faciliteit` = 'digibord',`beschrijving` = '{$beschrijving}',`gebouw` = '{$gebouw}',`vleugel` = '{$vleugel}',`verdieping` = '{$verdieping}',`kamersoort` = '$kamersoort',`kamercapaciteit` = '{$capaciteit}',`zichtbaar` = '{$zichtbaar}'";
            $sqlPostKamerQuery = "
            update ruimte
            set {$sqlPostDeelKamerQuery}
            where kamernummer = {$kamer} and faciliteit = '';";
            if (mysqli_query($conn, $sqlPostKamerQuery)) {
              // Added successfully
            }
            else{
              echo "Error: " . $sqlPostKamerQuery . "<br>" . mysqli_error($conn);
            }
            unset($nullVal);
          }
          else if (!$digibord && isset($digVal)) {
            $sqlPostKamerQuery = "
            DELETE FROM `ruimte` WHERE `kamernummer` = {$kamer} AND `faciliteit` = 'digibord' AND `gebouw` = '{$gebouw}'";
            if (mysqli_query($conn, $sqlPostKamerQuery)) {
              // Added successfully
            }
            else{
              echo "Error: " . $sqlPostKamerQuery . "<br>" . mysqli_error($conn);
            }
          }
          // als stopcontacten gecheckt is, maak er dan een query voor.
          if ($stopcontacten && isset($stopVal)) {
            $sqlPostDeelKamerQuery = "`faciliteit` = 'stopcontacten',`beschrijving` = '{$beschrijving}',`gebouw` = '{$gebouw}',`vleugel` = '{$vleugel}',`verdieping` = '{$verdieping}',`kamersoort` = '$kamersoort',`kamercapaciteit` = '{$capaciteit}',`zichtbaar` = '{$zichtbaar}'";
            $sqlPostKamerQuery = "
            update ruimte
            set {$sqlPostDeelKamerQuery}
            where kamernummer = {$kamer} and (faciliteit = 'stopcontacten' or faciliteit = '');";
            if (mysqli_query($conn, $sqlPostKamerQuery)) {
              // Added successfully
            }
            else{
              echo "Error: " . $sqlPostKamerQuery . "<br>" . mysqli_error($conn);
            }
          }
          else if ($stopcontacten && !isset($stopVal) && !isset($nullVal)) {
            $sqlPostDeelKamerQuery = "('{$kamer}','stopcontacten','{$beschrijving}','{$gebouw}','{$vleugel}','{$verdieping}','$kamersoort','{$capaciteit}','{$zichtbaar}')";
            $sqlPostKamerQuery = "
            insert into ruimte (kamernummer,faciliteit,beschrijving,gebouw,vleugel,verdieping,kamersoort,kamercapaciteit,zichtbaar)
            values {$sqlPostDeelKamerQuery}";
            if (mysqli_query($conn, $sqlPostKamerQuery)) {
              // Added successfully
            }
            else{
              echo "Error: " . $sqlPostKamerQuery . "<br>" . mysqli_error($conn);
            }
          }
          else if ($stopcontacten && !isset($stopVal) && isset($nullVal)) {
            $sqlPostDeelKamerQuery = "`faciliteit` = 'stopcontacten',`beschrijving` = '{$beschrijving}',`gebouw` = '{$gebouw}',`vleugel` = '{$vleugel}',`verdieping` = '{$verdieping}',`kamersoort` = '$kamersoort',`kamercapaciteit` = '{$capaciteit}',`zichtbaar` = '{$zichtbaar}'";
            $sqlPostKamerQuery = "
            update ruimte
            set {$sqlPostDeelKamerQuery}
            where kamernummer = {$kamer} and faciliteit = '';";
            if (mysqli_query($conn, $sqlPostKamerQuery)) {
              // Added successfully
            }
            else{
              echo "Error: " . $sqlPostKamerQuery . "<br>" . mysqli_error($conn);
            }
            unset($nullVal);
          }
          else if (!$stopcontacten && isset($stopVal)) {
            $sqlPostKamerQuery = "
            DELETE FROM `ruimte` WHERE `kamernummer` = {$kamer} AND `faciliteit` = 'stopcontacten' AND `gebouw` = '{$gebouw}'";
            if (mysqli_query($conn, $sqlPostKamerQuery)) {
              // Added successfully
            }
            else{
              echo "Error: " . $sqlPostKamerQuery . "<br>" . mysqli_error($conn);
            }
          }
          // als whiteboard gecheckt is, maak er dan een query voor.
          if ($whiteboard && isset($whiteVal)) {
            $sqlPostDeelKamerQuery = "`faciliteit` = 'whiteboard',`beschrijving` = '{$beschrijving}',`gebouw` = '{$gebouw}',`vleugel` = '{$vleugel}',`verdieping` = '{$verdieping}',`kamersoort` = '$kamersoort',`kamercapaciteit` = '{$capaciteit}',`zichtbaar` = '{$zichtbaar}'";
            $sqlPostKamerQuery = "
            update ruimte
            set {$sqlPostDeelKamerQuery}
            where kamernummer = {$kamer} and (faciliteit = 'whiteboard' or faciliteit = '');";
            if (mysqli_query($conn, $sqlPostKamerQuery)) {
              // Added successfully
            }
            else{
              echo "Error: " . $sqlPostKamerQuery . "<br>" . mysqli_error($conn);
            }
          }
          else if ($whiteboard && !isset($whiteVal) && !isset($nullVal)) {
            $sqlPostDeelKamerQuery = "('{$kamer}','whiteboard','{$beschrijving}','{$gebouw}','{$vleugel}','{$verdieping}','$kamersoort','{$capaciteit}','{$zichtbaar}')";
            $sqlPostKamerQuery = "
            insert into ruimte (kamernummer,faciliteit,beschrijving,gebouw,vleugel,verdieping,kamersoort,kamercapaciteit,zichtbaar)
            values {$sqlPostDeelKamerQuery}";
            if (mysqli_query($conn, $sqlPostKamerQuery)) {
              // Added successfully
            }
            else{
              echo "Error: " . $sqlPostKamerQuery . "<br>" . mysqli_error($conn);
            }
          }
          else if ($whiteboard && !isset($whiteVal) && isset($nullVal)) {
            $sqlPostDeelKamerQuery = "`faciliteit` = 'whiteboard',`beschrijving` = '{$beschrijving}',`gebouw` = '{$gebouw}',`vleugel` = '{$vleugel}',`verdieping` = '{$verdieping}',`kamersoort` = '$kamersoort',`kamercapaciteit` = '{$capaciteit}',`zichtbaar` = '{$zichtbaar}'";
            $sqlPostKamerQuery = "
            update ruimte
            set {$sqlPostDeelKamerQuery}
            where kamernummer = {$kamer} and faciliteit = '';";
            if (mysqli_query($conn, $sqlPostKamerQuery)) {
              // Added successfully
            }
            else{
              echo "Error: " . $sqlPostKamerQuery . "<br>" . mysqli_error($conn);
            }
            unset($nullVal);
          }
          else if (!$whiteboard && isset($whiteVal)) {
            $sqlPostKamerQuery = "
            DELETE FROM `ruimte` WHERE `kamernummer` = {$kamer} AND `faciliteit` = 'whiteboard' AND `gebouw` = '{$gebouw}'";
            if (mysqli_query($conn, $sqlPostKamerQuery)) {
              // Added successfully
            }
            else{
              echo "Error: " . $sqlPostKamerQuery . "<br>" . mysqli_error($conn);
            }
          }

          if (!$digibord && !$stopcontacten && !$whiteboard) {
            $sqlDeleteKamerQuery = "
            DELETE FROM `ruimte` WHERE `kamernummer` = {$kamer} AND `gebouw` = '{$gebouw}'";
            if (mysqli_query($conn, $sqlDeleteKamerQuery)) {
              // Added successfully
            }
            else{
              echo "Error: " . $sqlDeleteKamerQuery . "<br>" . mysqli_error($conn);
            }
            $sqlPostDeelKamerQuery = "('{$kamer}','','{$beschrijving}','{$gebouw}','{$vleugel}','{$verdieping}','$kamersoort','{$capaciteit}','{$zichtbaar}')";
            $sqlPostKamerQuery = "
            insert into ruimte (kamernummer,faciliteit,beschrijving,gebouw,vleugel,verdieping,kamersoort,kamercapaciteit,zichtbaar)
            values {$sqlPostDeelKamerQuery}";
            if (mysqli_query($conn, $sqlPostKamerQuery)) {
              // Added successfully
            }
            else{
              echo "Error: " . $sqlPostKamerQuery . "<br>" . mysqli_error($conn);
            }
          }
      }

    }
  }

  // functie voor het verwijderen van kamers in de database
  function delFromDB($conn,$kamer,$gebouw){
    $sqlPostKamerQuery = "
    DELETE FROM `ruimte` WHERE `kamernummer` = {$kamer} AND `gebouw` = '$gebouw'";
    if (mysqli_query($conn, $sqlPostKamerQuery)) {
      // Deleted successfully
    }
    else{
      echo "Error: " . $sqlPostKamerQuery . "<br>" . mysqli_error($conn);
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
      sendToDB($conn,$kamerNrLijstResult,$kamerFaciliteitLijstResult,$_POST['kamerNr'],$_POST['gebouw'],$_POST['vleugel'],$_POST['verdieping'],$_POST['capaciteit'],$_POST['beschrijving'],$_POST['kamersoort'],$check1,$check2,$check3,$_POST['zichtbaar']);
    }
    else if (isset($_POST['submitKamerVerwijder'])){
      delFromDB($conn,$_POST['kamerNr'],$_POST['gebouw']);
    }
  }
?>
