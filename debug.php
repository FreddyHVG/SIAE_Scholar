<?php
ini_set('display_errors',1); error_reporting(E_ALL);
session_start();

$path = __DIR__.'/app/config.php';   // ← aquí está tu config
require_once $path;

echo "<pre>Usando config: $path\n";
echo "BD: ".(defined('BD')?BD:'(sin BD)')."\n";
echo "APP_URL: ".(defined('APP_URL')?APP_URL:'(sin APP_URL)')."\n";
echo "</pre>";
