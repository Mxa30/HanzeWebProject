<!DOCTYPE html>
<?php include "../../../../defaultpaths.php"?>
<html lang="nl">
  <head>
    <!-- META TAGS -->
    <meta charset="utf-8">
    <!-- Definieer de viewport voor responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
      $filePath = $_SERVER['REQUEST_URI'];
      // Definieer het file path per pagina, daarna plaatst het de beschrijving van die pagina
      // in het variabele $filePath
       if ($filePath == null) {
         $filePath = "";
       }elseif($filePath == "/roomservice/source/app/page/cms/kamer/html/index.php"){
         $filePath = "CMS-Kamers";
       }elseif($filePath == "/roomservice/source/app/page/cms/reservering/html/index.php"){
         $filePath = "CMS-Reserveringen";
       }elseif($filePath == "/roomservice/source/app/page/kamer_overzicht/html/index.php"){
         $filePath = "Kamer Overzicht";
       }elseif($filePath == "/roomservice/source/app/page/login/html/index.php"){
         $filePath = "Login";
       }elseif($filePath == "/roomservice/source/app/page/mijn_reservering/html/index.php"){
         $filePath = "Mijn Reserveringen";
       }elseif($filePath == "/roomservice/source/app/page/reservering/html/index.php"){
         $filePath = "Reserveer Kamer";
       }
    ?>
    <title>RoomService | <?php echo "{$filePath}"//Plaats de beschrijving van de pagina in de titel?></title><!--Maak dit varabel per pagina met php-->

    <!--Website Icon-->
    <link rel="icon" type="image/x-icon" href="">

    <!-- Font definieren -->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <!-- Stylesheet van toepassing op elke pagina -->
    <link rel="stylesheet" href="<?php echo SOURCE_PATH?>/main.css">
    <!-- Stylesheet per apparte pagina -->
    <link rel="stylesheet" href="../css/style.css">
