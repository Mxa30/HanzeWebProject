<?php
if (!isset($filter)) {
  $sqlGetroomnrQuery = "
  select distinct kamernummer, gebouw, vleugel
  from ruimte
  order by gebouw, vleugel, kamernummer;";
  $sqlGetroomnrResult = mysqli_query($conn, $sqlGetroomnrQuery);
}else {
  $sqlGetroomnrQuery = "
  select distinct kamernummer, gebouw, vleugel
  from ruimte
  $filters
  order by gebouw, vleugel, kamernummer;";
  $sqlGetroomnrResult = mysqli_query($conn, $sqlGetroomnrQuery);
}

// query's versturen en opslaan
 ?>
