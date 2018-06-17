<?php


$path = trim( $_SERVER['REQUEST_URI'], '/' );

$path = parse_url($path, PHP_URL_PATH);


$routes = [
  'geb' => 'src/home/home.php',
  'geb/karten' => 'src/zuteilungskarten/karten.php',
  'geb/editor' => 'src/editor/editor.php',
  'geb/editor-pub' => 'src/editor/editor.php',
  'geb/editor-set' => 'src/editor/editor.php',
  'geb/publisher' => 'src/editor/handle_publisher.php',
  'geb/territory' => 'src/editor/handle_territory.php',
  'geb/return' => 'src/home/home.php',
  'geb/processing' => 'src/editor/handle_processing.php'
];




?>