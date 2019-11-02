<?php


$link = '../../../../connect.php';
require $link;

if($link){

}

if(isset($_POST['aanmelden'])){
  $email = $_REQUEST['email'];
  $password = $_REQUEST['password'];
  $sqlAanmeldquery = "insert into Login (email, password) values ('$email', '$password');";
  if (mysqli_query($conn, $sqlAanmeldquery)) {
  echo "je bent aangemeld".$email;
  }else{
    echo "Error: " . $sqlAanmeldquery . "<br>" . mysqli_error($conn);
  }
}

if(isset($_POST['login'])){
  $email = $_REQUEST['email'];
  $password = $_REQUEST['password'];
  $_SESSION['email'] = $email;
  $_SESSION['password'] = $password;
  $sqlLoginQuery = "SELECT $email, $password FROM Login WHERE email IS LIKE $email AND password IS LIKE'.$password;";

  if (mysqli_query($conn, $sqlLoginQuery) && isset($_SESSION['email'] && isset($_SESSION['password'])) {
      echo "je bent succesvol aangemeld ".$email;
  }else{
echo "Verkeerde login of wachtwoord: " . $sqlLoginQuery . "<br>" . mysqli_error($conn);

  }
}
 ?>
