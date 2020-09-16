<?php

  namespace Source\Config\DB;

  use PDO;
  use Exception;
  use PDOException;

  abstract class Connection{

    /** @var PDO|null Retorna um objeto de conexão com o banco de dados*/
    private static $instance = null;

    /** @var  PROException|null Em caso de erro ao conectar com o banco de dados */
    private static $error = null;

    private function __construct(){}
    private function __clone(){}

    /** @return PDO */
    public static function getInstance(): ?PDO{
      if(is_null(self::$instance)){
        try{

          $instance = new PDO(
            DATA_BASE['driver'].':host='.DATA_BASE['drive'].';port='.DATA_BASE['port'].';dbname='.DATA_BASE['db_name'],
            DATA_BASE['user'],
            DATA_BASE['password']
          );

          $instance = setAttribute(DATA_BASE['data_mode']);
        
        }catch(PDOException $error){
          self::$error = $error;
        }catch(Exception $error){
          self::$error = $error;
        }
      }
      return self::$instance;
    }

    public static function error(){
      return self::$error;
    }

  }
