<?php

session_start();
$link = '../../../../connect.php';
require $link;

if($link){

}

if(isset($_POST['aanmelden'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
//wachtwoord hashen in database
$hashForRoomservice = password_hash($_POST['password'], PASSWORD_DEFAULT);
//email sanitizen
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Dit email adres is goedgekeurd\n";
}

  $sqlAanmeldquery = "insert into Login (email, password) values ('$email', '$hashForRoomservice');";
  if (mysqli_query($conn, $sqlAanmeldquery)) {
  echo "je bent aangemeld".$email;
  }else{
    echo "Error: " . $sqlAanmeldquery . "<br>" . mysqli_error($conn);
  }
}

if(isset($_POST['login'])){

  //ophalen email en gebruikersnaam;
  $email = $_POST['email'];
  $password = $_POST['password'];
  //variabelen sanitizen;
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Dit email adres is goedgekeurd\n";
}
  //na sanitizen in een sessionvariabele verwerken om overal opgehaald te kunnen worden
  $_SESSION['email'] = $email;
  $_SESSION['password'] = $password;
  $sqlLoginQuery = "SELECT email, password FROM Login WHERE email = '$email' AND password = '$password';";

  //DIT MOET NOG OPGELOST WORDEN. WAARBIJ DE HASH WORDT GECHECKT
if(password_verify($password)){
  echo "het wachtwoord is correct";
}
  if (mysqli_query($conn, $sqlLoginQuery)) {
    echo "login gelukt";
    echo "<a href=\"ingelogd.php\">hallo</a>";

  }else{
    echo "Verkeerde login of wachtwoord: " . $sqlLoginQuery . "<br>" . mysqli_error($conn);

  }
}
 ?>
