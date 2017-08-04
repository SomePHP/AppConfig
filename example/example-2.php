<?php
class ServerConfig {
  public static $env = 'prod';
}

require_once '../src/AppConfig.php';

try {
  // Create an object from the "prod" section of a JSON file.
  $config = AppConfig::load('config.json', ServerConfig::$env);
} catch (Exception $e) {
  var_dump($e->getMessage());
  exit;
}

// Display a copy the entire runtime object.
echo print_r($config->get(), true);

