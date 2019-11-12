<!DOCTYPE html>
<?php
  // if (session_status() == '') {
  //   session_start();
  // }
  session_start();
  // Include de default paths
  include "../../../../defaultpaths.php";
  // Include de database in elke pagina
  include SOURCE_PATH . "/connect.php";
?>
<html lang="nl">
  <head>
    <!-- META TAGS -->
    <meta charset="utf-8">
    <!-- Definieer de viewport voor responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
      $link = $_SERVER['REQUEST_URI'];
      $filePath = substr(substr($link, 0, strpos($link,"/index.php") +10),strpos($link, '/source'),strlen($link));
      // Definieer het file path per pagina, daarna plaatst het de beschrijving van die pagina
      // in het variabele $filePath
       if ($filePath == null) {
         $headTitle = "";
       }elseif($filePath == "/source/app/page/cms-kamer/html/index.php"){
         $headTitle = "CMS-Kamers";
       }elseif($filePath == "/source/app/page/cms-reservering/html/index.php"){
         $headTitle = "CMS-Reserveringen";
       }elseif($filePath == "/source/app/page/kamer_overzicht/html/index.php"){
         $headTitle = "Kamer Overzicht";
       }elseif($filePath == "/source/app/page/login/html/index.php"){
         $headTitle = "Login";
       }elseif($filePath == "/source/app/page/login/html/aanmeld-pagina.php"){
         $headTitle = "Aanmelden";
       }elseif($filePath == "/source/app/page/mijn_reservering/html/index.php"){
         $headTitle = "Mijn Reserveringen";
       }elseif($filePath == "/source/app/page/reservering/html/index.php"){
         $headTitle = "Reserveer Kamer";
       }
    ?>
    <title>RoomService | <?php if(isset($headTitle)){echo $headTitle;}//Plaats de beschrijving van de pagina in de titel?></title><!--Maak dit varabel per pagina met php-->

    <!--Website Icon-->
    <link rel="icon" type="image/x-icon" href="">

    <!-- Font definieren -->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <!-- Stylesheet van toepassing op elke pagina -->
    <link rel="stylesheet" href="<?php echo SOURCE_PATH?>/main.css">
    <!-- Stylesheet per apparte pagina -->
    <link rel="stylesheet" href="../css/style.css">

    <!-- clear resubmit of form so no popup is shown -->
    <script>
      if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
      }
    </script>
