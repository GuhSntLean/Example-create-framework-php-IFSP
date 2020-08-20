<?
  use PDO;

  class conection {
    private static $user      = DBUSER;
    private static $password  = DBPASSWORD;
    private static $domain    = DBDOMAIN;
    private static $instance  = null;
    
    private function __construct(){}
    private function __clone(){}

    public static function getInstance(){
      if(is_null(self::$instance)){

          self::$instance = new PDO(self::$dns, self::$user, self::$password);

      }
      return self::$instance;
    }
  }