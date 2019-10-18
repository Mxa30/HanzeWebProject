<?php
  ob_start();

  //Linkt naar "HanzeWebProject/source/" vanuit hier kan je door
  //linken naar bestanden binnen "/source"
  define("SOURCE_PATH", "../../../../../source");
  //Linkt naar "HanzeWebProject/source/app" vanuit hier kan je door
  //linken naar bestanden binnen "/app"
  define("APP_PATH", dirname(SOURCE_PATH . "/app/."));
  //Linkt naar "HanzeWebProject/source/app/component" vanuit hier kan je door
  //linken naar bestanden binnen "/component"
  define("COMPONENT_PATH", dirname(APP_PATH . "/component/."));
  //Linkt naar "HanzeWebProject/source/app/page" vanuit hier kan je door
  //linken naar bestanden binnen "/page"
  define("PAGE_PATH", dirname(APP_PATH . "/page/."));
  //Linkt naar "HanzeWebProject/source/asset" vanuit hier kan je door
  //linken naar bestanden binnen "/asset"
  define("ASSET_PATH", dirname(SOURCE_PATH . "/asset/."));

 ?>
