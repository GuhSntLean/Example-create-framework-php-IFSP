<?php

namespace Source\Config;

use PDO;

/*
  Definição de banco de dados;
    - MySql = mysql
    - Postgresql = pgsql
    - SqlServer = sqlsrv
*/
  const DATA_BASE = [
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'port'      => '3306',
        'db_name'   => 'projeto',
        'user'      => 'root',
        'password'  => '',
        'data_mode' => [
          PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]
  ];
