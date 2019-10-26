<?php


$link = '../../../../connect.php';
require $link;

if($link){
  echo "oke dikke";
}

if(isset($_POST['submit'])){
  $email = $_REQUEST['email'];
  $password = $_REQUEST['password'];
  $sql = "USE roomservice;";
  $sql = "INSERT INTO Login (email, password) VALUES ($email, $password);";
echo "dikke prima";
}
 ?>
