<?php
require_once '../src/AppConfig.php';

try {
  // Create an empty config object.
  $config = AppConfig::load();
} catch (Exception $e) {
  var_dump($e->getMessage());
  exit;
}
echo 'config->api: '. print_r($config->api, true). PHP_EOL;
echo 'config->db: '. print_r($config->db, true). PHP_EOL;
echo PHP_EOL;

// Add a property.
@$config->api->example->url = 'http://example.com/api';

// Add an object.
$config->db = (object) [
  'mysql' => (object) [
    'server' => 'localhost',
    'user' => 'admin',
    'pass' => 'love',
    'db' => 'currency_dev'
  ]
];

// Always return the same instance of the config object.
$configTwo = AppConfig::load();

echo 'configTwo->api: '. print_r($configTwo->api, true). PHP_EOL;
echo 'configTwo->db: '. print_r($configTwo->db, true). PHP_EOL;

