<?php
$sqlGetroomnrQuery = "
select kamernummer, gebouw,  vleugel
from ruimte
order by kamernummer;";

$sqlGetroomnrResult = mysqli_query($conn, $sqlGetroomnrQuery);
while ($record = mysqli_fetch_assoc($sqlGetroomnrResult)){
  echo $record['kamernummer'];
  echo "<br>";
  echo $record['gebouw'];
  echo "<br>";
  echo $record['vleugel'];
}

 ?>
