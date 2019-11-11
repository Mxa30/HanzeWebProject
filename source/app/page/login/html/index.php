    <?php
    include "../../../../meta.php";
    include "../../login/html/login-functions.php";
     ?>
  </head>
  <body>
    <?php include (COMPONENT_PATH . "/header/index.php"); ?>
    <main>
      <form action="login-functions.php" method="post">
        <h3>Login</h3>
        <input type="text" name="email" value="" placeholder="E-mail">
        <br/>
        <input type="password" name="password" value="" placeholder="Wachtwoord">
        <br/>
        <input class="button"type="submit" name="login" value="Login">
      </form>
    </main>
  </body>
</html>
