<?php


$link = '../../../../connect.php';
require $link;

if($link){
//kijken of de connectie werkt;
}

if(isset($_POST['aanmelden'])){
  $email = $_REQUEST['email'];
  $password = $_REQUEST['password'];
  $sqlAanmeldquery = "insert into Login (email, password) values ('$email', '$password');";
  if (mysqli_query($conn, $sqlAanmeldquery)) {
    // Added successfully
  }else{
    echo "Error: " . $sqlAanmeldquery . "<br>" . mysqli_error($conn);
  }
echo "dikke prima";
}

if(isset($_POST['login'])){
  $email = $_REQUEST['email'];
  $password = $_REQUEST['password'];
  $sqlLoginQuery = "SELECT email, password FROM login WHERE email = '$email' AND password = '$password';";
  if (mysqli_query($conn, $sqlLoginQuery)) {
  echo "Je bent ingelogd";
  echo "  \<button type=\"button\" name=\"button\"><a href=\"login-pagina.php\"\>inlogpagina</a></button>";
  $_SESSION['email'] = $email;
  echo $SESSION['email'];
  $_SESSION['password'] = $password;
  echo $SESSION['password'];
  }else{
    echo "Verkeerde login of wachtwoord: " . $sqlLoginQuery . "<br>" . mysqli_error($conn);
  ]
}


 ?>
