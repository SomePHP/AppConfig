<?php
require_once '../src/AppConfig.php';

try {
  // Create an object from a JSON file.
  $config = AppConfig::load('config.json');
} catch (Exception $e) {
  var_dump($e->getMessage());
  exit;
}

echo "API: {$config->dev->api->example->url} \n";
echo "User: {$config->dev->db->mysql->user} \n";
echo "Passowrd: {$config->dev->db->mysql->pass} \n";

