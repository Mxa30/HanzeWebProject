<?php
// Maak in PHPMyAdmin een gebruiker aan met de gebruiersnaam: roomsServiceAdmin
// wachtwoord: Strongpassword123
// servernaam: lokaal
// en bij rechten, alles onder de tabel "Data" dus SELECT, INSERT, UPDATE, DELETE, FILE
$servername = "localhost";
$username = "roomsServiceAdmin";
$password = "Strongpassword123";
$dbname = "roomservice";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if (mysqli_connect_errno($conn)){
 $message = "Connectie Database mislukt: " . mysqli_connect_error();
 echo "<script type='text/javascript'>alert('$message');</script>";
}
?>
