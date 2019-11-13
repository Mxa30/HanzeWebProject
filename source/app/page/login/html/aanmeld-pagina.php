  <?php
  include "../../../../meta.php";
  include "../php/login-functions.php";
  ?>
  </head>
    <body>
      <?php include (COMPONENT_PATH . "/header/index.php"); ?>
      <main>
        <form method="post" class="mainForm">
          <h3>Aanmelden</h3>
          <?php
            if (isset($errorCodeA)) {
              echo "<p>{$errorCodeA}</p>";
            }
          ?>
          <input type="email" name="email" value="" placeholder="E-mail">
          <br/>
          <input type="password" name="password" value="" placeholder="Wachtwoord">
          <br/>
          <button class="button" type="submit" name="aanmeldButton">Aanmelden</button>
        </form>
      </main>
    </body>
  </html>
