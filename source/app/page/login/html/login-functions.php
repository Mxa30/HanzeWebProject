<?php


$link = '../../../../connect.php';
require $link;

if($link){
  echo "oke dikke";
}

if(isset($_POST['submit'])){
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
    // Added successfully
  }else{
    echo "Verkeerde login of wachtwoord: " . $sqlLoginQuery . "<br>" . mysqli_error($conn);
  }
echo "dikke prima";
}
 ?>
