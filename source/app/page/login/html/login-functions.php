<?php


$link = '../../../../connect.php';
require $link;

if($link){
  echo "oke dikke";
}

if(isset($_POST['submit'])){
  $email = $_REQUEST['email'];
  $password = $_REQUEST['password'];
  $sqlLoginQuery = "insert into Login (email, password) values ('$email', '$password');";
  if (mysqli_query($conn, $sqlLoginQuery)) {
    // Added successfully
  }else{
    echo "Error: " . $sqlLoginQuery . "<br>" . mysqli_error($conn);
  }
echo "dikke prima";
}
 ?>
