<?php

  namespace Source\Config\DB;

  use PDO;
  use Exception;
  use PDOException;

  class Connection{

    private static $instance = null;

    private static $error = null;

    private function __construct(){}
    private function __clone(){}

    public static function getInstance(){
      if(is_null(self::$instance)){
        try{
          $instance = new PDO();
          $instance = setAttribute();
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
