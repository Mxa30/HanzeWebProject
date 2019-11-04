<?php
  function search_kamer($kamer){
    $searchKamerVal = "and kamernummer = {$kamer}";
    return $searchKamerVal;
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['searchKamerSubmit'])) {
      if (!empty($_POST['searchKamer'])) {
        $searchKamerVal = search_kamer($_POST['searchKamer']);
      }else {
        $searchKamerVal = "";
      }
    }else {
      $searchKamerVal = "";
    }
  }else {
    $searchKamerVal = "";
  }
?>
