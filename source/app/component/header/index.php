<?php
// Definieer de text en link op de knoppen in de header per pagina
  if (!isset($filePath)) {
    $button1 = "Mijn reserveringen";
    $button2 = "Kamer overzicht";
    $button3 = "Uitloggen";
    $headVal = "RoomService";
    $button1Link = PAGE_PATH . "/mijn_reservering/html/index.php";
    $button2Link = PAGE_PATH . "/kamer_overzicht/html/index.php";
    $button3Link = PAGE_PATH . "/login/html/index.php";
    $selectedButton = null;
  }elseif ($filePath == "/HanzeWebProject/source/app/page/reservering/html/index.php"){
    $button1 = "Mijn reserveringen";
    $button2 = "Kamer overzicht";
    $button3 = "Uitloggen";
    $headVal = "RoomService";
    $button1Link = PAGE_PATH . "/mijn_reservering/html/index.php";
    $button2Link = PAGE_PATH . "/kamer_overzicht/html/index.php";
    $button3Link = PAGE_PATH . "/login/html/index.php";
    $selectedButton = null;
  }elseif ($filePath == "/HanzeWebProject/source/app/page/kamer_overzicht/html/index.php"){
    $button1 = "Mijn reserveringen";
    $button2 = "Kamer overzicht";
    $button3 = "Uitloggen";
    $headVal = "RoomService";
    $button1Link = PAGE_PATH . "/mijn_reservering/html/index.php";
    $button2Link = PAGE_PATH . "/kamer_overzicht/html/index.php";
    $button3Link = PAGE_PATH . "/login/html/index.php";
    $selectedButton = 2;
  }elseif ($filePath == "/HanzeWebProject/source/app/page/mijn_reservering/html/index.php"){
    $button1 = "Mijn reserveringen";
    $button2 = "Kamer overzicht";
    $button3 = "Uitloggen";
    $headVal = "RoomService";
    $button1Link = PAGE_PATH . "/mijn_reservering/html/index.php";
    $button2Link = PAGE_PATH . "/kamer_overzicht/html/index.php";
    $button3Link = PAGE_PATH . "/login/html/index.php";
    $selectedButton = 1;
  }elseif($filePath == "/HanzeWebProject/source/app/page/cms-kamer/html/index.php"){
    $button1 = "Kamers aanpassen";
    $button2 = "Alle reserveringen";
    $button3 = "Uitloggen";
    $headVal = "RoomService - CMS";
    $button1Link = PAGE_PATH . "/cms-kamer/html/index.php";
    $button2Link = PAGE_PATH . "/cms-reservering/html/index.php";
    $button3Link = PAGE_PATH . "/login/html/index.php";
    $selectedButton = 1;
  }elseif ($filePath == "/HanzeWebProject/source/app/page/cms-reservering/html/index.php"){
    $button1 = "Kamers aanpassen";
    $button2 = "Alle reserveringen";
    $button3 = "Uitloggen";
    $headVal = "RoomService - CMS";
    $button1Link = PAGE_PATH . "/cms-kamer/html/index.php";
    $button2Link = PAGE_PATH . "/cms-reservering/html/index.php";
    $button3Link = PAGE_PATH . "/login/html/index.php";
    $selectedButton = 2;
  }elseif($filePath == "/HanzeWebProject/source/app/page/login/html/index.php"){
    $button1 = null;
    $button2 = null;
    $button3 = "Maak account";
    $headVal = "RoomService";
    $button1Link = null;
    $button2Link = null;
    // Button 3 moet een nieuwe form openen op de loginpagina zelf waar een account kan worden gemaakt
    // deze link mag dus weg worden gehaald als deze functionaliteit er is.
    $button3Link = PAGE_PATH . "/login/html/index.php";
    $selectedButton = null;
  }
?>
<header>
  <div class="leftButtonContain">
    <?php
    // Wanneer $button1 & $button2 zijn gedefinieerd, laat dan de meest linkse knoppen zien
    // met de text in deze variabelen
      if(isset($button1) && isset($button1Link)){
        if (isset($selectedButton) && $selectedButton == 1) {
          echo "<button type=\"button\" class=\"headButton selectedButton\" name=\"but1\" onclick=\"window.location.href='{$button1Link}'\">" . $button1 . "</button>";
        }else {
          echo "<button type=\"button\" class=\"headButton\" name=\"but1\" onclick=\"window.location.href='{$button1Link}'\">" . $button1 . "</button>";
        }
      }
      if(isset($button2) && isset($button2Link)){
        if (isset($selectedButton) && $selectedButton == 2) {
          echo "<button type=\"button\" class=\"headButton selectedButton\" name=\"but2\" onclick=\"window.location.href='{$button2Link}'\">" . $button2 . "</button>";
        }else {
          echo "<button type=\"button\" class=\"headButton\" name=\"but2\" onclick=\"window.location.href='{$button2Link}'\">" . $button2 . "</button>";
        }
      }
    ?>
  </div>
  <h1 class="headText"><?php echo $headVal; ?></h1>
  <div class="rightButtonContain">
    <button type="button" class="logoutButton" name="logout" onclick="window.location.href='<?php echo $button3Link; ?>'"><?php echo $button3 ?></button>
  </div>
</header>
