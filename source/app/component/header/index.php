<?php
// Definieer de text op de knoppen in de header per pagina
  if (!isset($filePath)) {
    $button1 = "Mijn reserveringen";
    $button2 = "Kamer overzicht";
    $button3 = "Uitloggen";
  }elseif($filePath == "/HanzeWebProject/source/app/page/cms-kamer/html/index.php"){
    $button1 = "Kamer aanpassen";
    $button2 = "Alle reserveringen";
    $button3 = "Uitloggen";
  }elseif($filePath == "/HanzeWebProject/source/app/page/cms-reservering/html/index.php"){
    $button1 = "Kamer aanpassen";
    $button2 = "Alle reserveringen";
    $button3 = "Uitloggen";
  }elseif($filePath == "/HanzeWebProject/source/app/page/kamer_overzicht/html/index.php"){
    $button1 = "Mijn reserveringen";
    $button2 = "Kamer overzicht";
    $button3 = "Uitloggen";
  }elseif($filePath == "/HanzeWebProject/source/app/page/login/html/index.php"){
    $button1 = null;
    $button2 = null;
    $button3 = "Maak account";
  }elseif($filePath == "/HanzeWebProject/source/app/page/mijn_reservering/html/index.php"){
    $button1 = "Mijn reserveringen";
    $button2 = "Kamer overzicht";
    $button3 = "Uitloggen";
  }elseif($filePath == "/HanzeWebProject/source/app/page/reservering/html/index.php"){
    $button1 = "Mijn reserveringen";
    $button2 = "Kamer overzicht";
    $button3 = "Uitloggen";
  }
?>
<header>
  <div class="leftButtonContain">
    <?php
    // Wanneer $button1 & $button2 zijn gedefinieerd, laat dan de meest linkse knoppen zien
    // met de text in deze variabelen
      if(isset($button1)){
        echo "<button type='button' class='headButton' name='but1'>" . $button1 . "</button>";
      }
      if(isset($button2)){
        echo "<button type='button' class='headButton' name='but1'>" . $button2 . "</button>";
      }
    ?>
  </div>
  <h1 class="headText">RoomService</h1>
  <div class="rightButtonContain">
    <button type="button" class="logoutButton" name="logout"><?php echo $button3 ?></button>
  </div>
</header>
