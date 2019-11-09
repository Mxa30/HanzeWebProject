<?php
  // Querys
  $sqlGetResQuery = "
  select I.id, I.email, I.kamernummer, I.gebouw, R.vleugel, I.starttijd, I.eindtijd, I.reserveringsdatum
  from reservering I, ruimte R
  where I.kamernummer = R.kamernummer and I.gebouw = R.gebouw {$idVal}
  order by id desc;";

  $sqlGetIDQuery = "
  select id
  from reservering
  order by id desc;";

  // Query results
  $sqlGetResResult = mysqli_query($conn, $sqlGetResQuery);
  $sqlGetIDResult = mysqli_query($conn, $sqlGetIDQuery);

  // Function for deleting reservations from the database
  function delFromDB($conn,$id){
    $sqlDelResQuery = "
    delete from `reservering` where `id` = {$id}";
    if (mysqli_query($conn, $sqlDelResQuery)) {
      // Deleted successfully
    }
    else{
      echo "Error: " . $sqlDelResQuery . "<br>" . mysqli_error($conn);
    }
  }

  // Validating if button is pressed and which one was pressed
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    while($record = mysqli_fetch_assoc($sqlGetIDResult)){
      // Validate which button was pressed and parsing that value to the function
      if (isset($_POST['verwijder' . $record['id']])){
        delFromDB($conn,$record['id']);
      }
    }
  }
?>
