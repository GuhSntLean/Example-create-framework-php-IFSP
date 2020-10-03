<?php

require_once ('autoload.php');

use Source\Controller\Controller;
use Source\DB\Model;

class Teste extends Model{
  public function __construct(){
    parent::__construct('people', ['name', 'last_name']);
  }
}

$teste = new Teste();
echo '<pre>';
var_dump($teste);

// $app = new Controller();

// $app->run();