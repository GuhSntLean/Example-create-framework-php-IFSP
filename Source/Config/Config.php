<?php

namespace Source\Config;

use PDO;

/*
  Definição de banco de dados;
    - MySql = mysql
    - Postgresql = pgsql
    - SqlServer = sqlsrv
*/
class Config{

  /**
   * @var array
   */
  private static $dataConfig;

  public function getConfig():array{
    Config::$dataConfig = [
      'driver'    => 'mysql',
      'host'      => 'database',
      'port'      => '3306',
      'db_name'   => 'projeto',
      'user'      => 'root',
      'password'  => 'MySql2020!',
      'data_mode' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
      ]
    ];

    return self::$dataConfig;
  }
}
