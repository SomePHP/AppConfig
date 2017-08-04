<?php
/**
 * A basic application config class that loads from a JSON file and
 * returns a single run-time instance.  The instance is writable.
 *
 * @property AppConfig $instance  An instance of this class.
 * @property mixed $config  A JSON parsed config file.
*/
class AppConfig {
  private static $instance;
  private $config;

  /** 
   * Load a config file, a section of a config file, or create an empty one.
   * 
   * @param string $file  The path to a JSON config file.
   * @param string $section  A root level property of a JSON config file.
  */
  private function __construct($filename, $section) {
    if ($filename) {
      if ($json = file_get_contents($filename)) {
        if (($cfg = json_decode($json)) !== null) {

          if ($section) {
            $this->config = $cfg->$section;
          } else {
            $this->config = $cfg;
          }

        } else {
          throw new Exception("Invalid JSON");
        }
      } else {
        throw new Exception("AppConfig: File Not Loaded");
      }
    } else {
      $this->config = (object) array();
    }
  }

  /** 
   * Create or return a single isntance of AppConfig.
   * 
   * @param string $file  A JSON config file.
   * @param string $section  A section of a JSON config file.
   * @param bool $new  Return a unique isntance of the AppConfig class.
   * @return AppConfig  An instance of AppConfig.
  */
  public static function load($file = false, $section = false) {
    if (isset(self::$instance)) {
      return self::$instance;
    }

    self::$instance = new AppConfig($file, $section);
    return self::$instance;
  }

  /** 
   * Get a property from the config file. This magic method returns by
   * reference so that new config properties can be created within the 
   * object instance: $this->config.
   * 
   * @param string $prop  A property in the loaded config file.
   * @return mixed  A property from the config file.
  */
  public function &__get($prop) {
    return $this->config->$prop;
  }


  /**
   * Get the current running config.
   * 
   * @return mixed  The current running configuration.
  */  
  public function get() {
    return $this->config;
  }
}

