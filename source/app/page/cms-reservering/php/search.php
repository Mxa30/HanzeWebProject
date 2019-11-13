<?php
  function search_kamer($id){
    $idVal = "and id = {$id}";
    return $idVal;
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submitResId'])) {
      if (!empty($_POST['searchResId'])) {
        $idVal = search_kamer($_POST['searchResId']);
      }else {
        $idVal = "";
      }
    }else {
      $idVal = "";
    }
  }else {
    $idVal = "";
  }
?>
