<?
  use PDO;

  class Connection{
    private static $instance = null;

    private function __construct(){}
    private function __clone(){}

    public static function getInstance(){
      try{
        if(is_null(self::$instance)){
          self::$instance = new PDO();
          self::$instance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
      }catch(Exception $e){
        echo $e;
      }
    }
  }