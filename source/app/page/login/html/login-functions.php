<?php

session_start();
$conn = '../../../../connect.php';
require $conn;



if(isset($_POST['aanmelden'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
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
    echo "Dit email adres is goedgekeurd";
    echo "<br/>";
}


  //na sanitizen in een sessionvariabele verwerken om overal opgehaald te kunnen worden
  $_SESSION['email'] = $email;
  $_SESSION['password'] = $password;
$getPassword = "SELECT password FROM Login WHERE email = '$email';";
$sqlPassword = mysqli_query($conn,$getPassword);
  if(password_verify($password, $sqlPassword)){
    echo "$password";

    echo "$sqlPassword";
    echo "het wachtwoord is correct";
  }else {
  
    echo "$sqlPassword";
    echo "niet gelukt";
    echo "<br/>";
  }

  $sqlLoginQuery = "SELECT email, password FROM Login WHERE email = '$email' AND password = '$password';";

  //DIT MOET NOG OPGELOST WORDEN. WAARBIJ DE HASH WORDT GECHECKT

  if (mysqli_query($conn, $sqlLoginQuery)) {
    echo "login gelukt";
    echo "<br/>";
    echo "<a href=\"ingelogd.php\">hallo</a>";
    echo "<a href=\"../../reservering/html/index.php\">naar reserveringspagina</a>";

  }else{
    echo "<br/>";
    echo "Verkeerde login of wachtwoord: " . $sqlLoginQuery . "<br>" . mysqli_error($conn);

  }
}
 ?>
