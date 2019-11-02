<!DOCTYPE html>
<?php
session_start();
echo "$password";
 ?>
<html lang="" dir="ltr">
  <head>
    <title>loginpagina</title>
    <meta charset="utf-8">
    <?php include (COMPONENT_PATH . "/header/index.php") ?>
    <title>login pagina</title>

  </head>
  <body>

      <form class="" action="login-functions.php" method="post">
        <input type="text" name="email" value="">
        <input type="password" name="password" value="">
        <input type="submit" name="login" value="login">
        <br/>
    <button type="button" name="button"><a href="aanmeld-pagina.php">aanmeldpagina</a></button>

      </form>





  </body>

  <?php

  require "login-functions.php";
  include "../../../../connect.php";
  ?>
</html>
