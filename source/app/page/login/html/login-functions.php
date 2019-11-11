<?php
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

  $sqlAanmeldquery = "insert into Login (email, password) values ('$email', '$password');";
  if (mysqli_query($conn, $sqlAanmeldquery)) {
  echo "je bent aangemeld ".$email;
  echo "<a href=\"../../login/html/index.php\">naar loginpagina</a>";
  }else{
    echo "Error: " . $sqlAanmeldquery . "<br>" . mysqli_error($conn);
  }
}
//
//
//
//
//
//
//
//
//


//login functie;
if(isset($_POST['login'])) {
  if($_POST['email'] == "" || $_POST['password'] == ""){
  echo "niet gelukt";
  echo "<br/>";
  echo "<a href=\"../../login/html/index.php\">naar loginpagina</a>";

  }
else {


  //ophalen email en gebruikersnaam;
  $email = $_POST['email'];
  $password = $_POST['password'];
  //variabelen in een session zetten



  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Dit email adres is legitiem";
    echo "<br/>";
  }
  $getSqlPassword = "SELECT password FROM Login WHERE email = '$email';";
  $getPassword = mysqli_query($conn, $getSqlPassword);


  if($getPassword == $password){
    echo "het wachtwoord is $password";
    echo "<br/>";
    echo " het wachtwoord is correct";
    echo "<br/>";
  }else {
    echo "het wachtwoord: ".$email." is niet correct";
    echo "<br/>";

  }

  $sqlLoginQuery = "SELECT email, password FROM Login WHERE email = '$email' AND password = '$password';";
  $runSqlLoginQuery = (mysqli_query($conn, $sqlLoginQuery));
  if($email == 'm.van.der.velde@st.hanze.nl' && $password == 'Wachtwoord123') {
    echo "<a href=\"../../login/html/login-pagina.php\">naar loginpagina</a>";
  }elseif ($runSqlLoginQuery && $verifyPassword) {
    echo "login gelukt";
    echo "<br/>";
    echo "<a href=\"ingelogd.php\">hallo</a>";
    echo "<a href=\"../../reservering/html/index.php\">naar reserveringspagina</a>";
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    echo $_SESSION['email'];
    echo "<br/>";
    echo $_SESSION['password'];
  }else{
    echo "<br/>";
    echo "Verkeerde login of wachtwoord: " . $sqlLoginQuery . "<br>" . mysqli_error($conn);
    echo "<a href=\"../../login/html/index.php\">naar loginpagina</a>";

  }

}
}

 ?>
