<?php
$sqlInfoArray = explode("-",$_SESSION['reserveerVal']);
$sqlInfoKamer = $sqlInfoArray[0];
$sqlInfoGebouw = "Van " . $sqlInfoArray[1];

$sql = "
SELECT kamernummer, ruimte.gebouw, vleugel, faciliteit, verdieping, kamercapaciteit, faciliteit, gebouw.adres
from ruimte
INNER JOIN gebouw
ON ruimte.gebouw=gebouw.gebouw
WHERE kamernummer='{$sqlInfoKamer}' and ruimte.gebouw='{$sqlInfoGebouw}'";

$result = $conn->query($sql);
$record = mysqli_fetch_assoc($result);
$row = $record;

$sqlGetTimesQuery = "
select starttijd, eindtijd
from reservering
where kamernummer='{$row['kamernummer']}' and gebouw='{$row['gebouw']}' and reserveringsdatum='{$_SESSION['datum']}';";

$sqlGetTimesResult = mysqli_query($conn, $sqlGetTimesQuery);

$data = [];
$starttijden = [];
$eindtijden = [];
while ($record = mysqli_fetch_assoc($sqlGetTimesResult)) {
  array_push($starttijden, $record['starttijd']);
  array_push($eindtijden, $record['eindtijd']);
}

// FUNCTIE
if (count($starttijden) == count($eindtijden)) {
  for ($i=0; $i < count($starttijden); $i++) {
    $startTijdA = explode(":", $starttijden[$i]);
    $startTijdN = $startTijdA[0] . $startTijdA[1];
    $startTijd = floatval($startTijdN);

    $eindTijdA = explode(":", $eindtijden[$i]);
    $eindTijdN = $eindTijdA[0] . $eindTijdA[1];
    $eindTijd = floatval($eindTijdN);

    $timesArrayA[] = [];
    array_push($timesArrayA[$i], $startTijd, $eindTijd);
  }
}
?>
