<?
  // TODO: Melhorar algumas coisas da conexao com o banco de dados de forma que de para criar e verificar se o banco e exestento por comandos

  use PDO;

  class Connection {
    private static $user      = DBUSER;
    private static $password  = DBPASSWORD;
    private static $domain    = DBDOMAIN;
    private static $instance  = null;
    
    private function __construct(){}
    private function __clone(){}

    public static function getInstance(){
      try{
        if(is_null(self::$instance)){
          self::$instance = new PDO(self::$dns, self::$user, self::$password);
          self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
      }catch(Exception $e){
        return ($e->getMessage());
      }
    }
  }

