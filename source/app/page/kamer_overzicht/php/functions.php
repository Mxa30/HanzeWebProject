<?php
$sqlGetroomnrQuery = "
select kamernummer, gebouw,  vleugel
from ruimte
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

// vleugel:
$sqlGetOptionVleugelQuery = "
select vleugel
from vleugel
order by vleugel;";

// query's versturen en opslaan
// gegevens van de reservering zijn hier opgeslagen
$sqlGetroomnrResult = mysqli_query($conn, $sqlGetroomnrQuery);
while ($record = mysqli_fetch_assoc($sqlGetroomnrResult)){
  echo $record['kamernummer'];
  echo "<br>";
  echo $record['gebouw'];
  echo "<br>";
  echo $record['vleugel'];
}
// kamernummer kan zo opgeroepen worden
$kamerNrLijstResult = mysqli_query($conn, $sqlGetNrListQuery);
while ($record = mysqli_fetch_assoc($sqlGetroomnrResult)){
  echo $record['kamernummer'];

}
  // faciliteit kan zo opgeroepen worden
    $kamerFaciliteitLijstResult = mysqli_query($conn, $sqlGetFaciliteitListQuery);
    while ($record = mysqli_fetch_assoc($kamerFaciliteitLijstResult)){
      echo $record['faciliteit'];
}
      // vleugel kan zo opgeroepen worden

      $vleugelOptionResult = mysqli_query($conn, $sqlGetOptionVleugelQuery);
      while ($record = mysqli_fetch_assoc($vleugelOptionResult)){
        echo $record['vleugel'];
      }
 ?>
