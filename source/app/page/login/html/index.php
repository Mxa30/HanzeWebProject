  <?php
  include "../../../../meta.php";
  include "../php/login-functions.php";
  ?>
  </head>
    <body>
      <?php include (COMPONENT_PATH . "/header/index.php"); ?>
      <main>
        <form method="post" class="mainForm">
          <h3>Login</h3>
          <?php
            if (isset($errorCode)) {
              echo "<p>{$errorCode}</p>";
            }
          ?>
          <input type="email" name="email" placeholder="E-mail" required>
          <br/>
          <input type="password" name="password" placeholder="Wachtwoord" required>
          <br/>
          <button class="button" type="submit" name="loginButton">Login</button>
        </form>
      </main>
    </body>
  </html>
