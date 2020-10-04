<?php

  namespace Source\DB;

  use PDO;
  use Exception;
  use PDOException;
  use Source\Config\Config;
  
  class Connection{


    /** @var PDO|null Retorna um objeto de conexão com o banco de dados*/
    private static $instance = null;

    /** @var  PROException|null Em caso de erro ao conectar com o banco de dados */
    private static $error = null;

    private function __construct(){}
    private function __clone(){}

    /** @return PDO */
    public static function getInstance(): ?PDO{
      $data_config = Config::getConfig();
      if(is_null(self::$instance)){
        try{

          self::$instance = new PDO(
            $data_config['driver'].':host='.$data_config['host'].';port='.$data_config['port'].';dbname='.$data_config['db_name'],
            $data_config['user'],
            $data_config['password']
          );

          
        
          self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        }catch(PDOException $error){
          self::$error = $error;
        }
      }
      return self::$instance;
    }

    public static function error(){
      return self::$error;
    }
  }
