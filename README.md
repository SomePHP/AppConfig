A basic application config class that loads from a JSON file and
returns a single run-time instance.  The instance is writable.

* An object can be created from a JSON file.
* An object can be created from a section of a JSON file, one level deep.
* An object can be built at runtime.
* Only one instance of an object is returned.
* The returned object is writable.

### License
MIT - MIT License
File: [LICENSE](LICENSE)

### Installation
##### Composer
composer require somephp/appconfig


## Usage Examples
The following two examples show how to load a JSON config file and a section of
a JSON config file.  They use [config.json](example/config.json).
The last example shows how to build a configuration at runtime.

### Example #1 create an object from a json file
```php
<?php
require_once 'AppConfig.php';

try {
  // Specify the path of a JSON file to load.
  $config = AppConfig::load('config.json');
} catch (Exception $e) {
  var_dump($e->getMessage());
  exit;
}

echo "API: {$config->dev->api->example->url} \n";
echo "User: {$config->dev->db->mysql->user} \n";
echo "Passowrd: {$config->dev->db->mysql->pass} \n";
```

### Example #1 output
```
API: https://example.com/dev/api 
User: admin 
Passowrd: love 
```

### Example #2 create an object from a sub section of a JSON file
```php
<?php
class ServerConfig {
  public static $env = 'prod';
}

require_once 'AppConfig.php';

try {
  // Create an object from the "prod" section of a JSON file.
  $config = AppConfig::load('config.json', ServerConfig::$env);
} catch (Exception $e) {
  var_dump($e->getMessage());
  exit;
}

// Display a copy the entire runtime object.
echo print_r($config->get(), true);
```

### Example #2 output
```
stdClass Object
(
    [db] => stdClass Object
        (
            [mysql] => stdClass Object
                (
                    [server] => https://example.com
                    [user] => admin
                    [pass] => secret
                    [db] => currency_prod
                )

            [mongo] => stdClass Object
                (
                    [collection] => currency_prod
                    [doc] => 
                    [server] => mongodb://127.0.0.1:27017
                )

        )

    [api] => stdClass Object
        (
            [example] => stdClass Object
                (
                    [url] => https://example.com/api
                    [secret] => 74c42a009d7c0fcdb1aa4a853b37977f
                    [key] => 85bb2e1519dbb2c2421b5cad6039bfcd
                    [pass] => realsecret5realkey
                )

        )

)
```

### Example #3 build an object at runtime
```php
<?php
require_once 'AppConfig.php';

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

// load() will return the same instance of the config object.
$configTwo = AppConfig::load();

echo 'configTwo->api: '. print_r($configTwo->api, true). PHP_EOL;
echo 'configTwo->db: '. print_r($configTwo->db, true). PHP_EOL;
```

### Example #3 output
```
config->api: 
config->db: 
configTwo->api: stdClass Object
(
    [example] => stdClass Object
        (
            [url] => http://example.com/api
        )

)

configTwo->db: stdClass Object
(
    [mysql] => stdClass Object
        (
            [server] => localhost
            [user] => admin
            [pass] => love
            [db] => currency_dev
        )

)
```

### Contents
| Resource | Description |
| -------- | ----------- |
|  | |

### Contributions
Suggestions and code modifications are welcome.  Create a merge request, and tell me what you are thinking.


