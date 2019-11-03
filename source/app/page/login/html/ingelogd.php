<!DOCTYPE html>
<?php
session_start();
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
<?php
echo "hallo gebruiker met het emailadres: ".$_SESSION['email'];
echo "<br/>";
echo "en met het wachtwoord: ".$_SESSION['password'];
 ?>
  </body>
  <?php

  include "login-functions.php";
  include "../../../../connect.php";
  ?>
</html>
