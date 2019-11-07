<!DOCTYPE html>
<html lang="" dir="ltr">
  <head>
    <?php include "../../../../meta.php" ?>
    <meta charset="utf-8">
    <title>hoi</title>

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

  include "login-functions.php";
  include "../../../../connect.php";
  ?>
</html>
