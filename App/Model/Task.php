<?php 
  namespace App\Model;

  use Source\DB\Model;

  class Task extends Model{

    public function __construct(){
      parent::__construct("tb_usuarios", ['idDatauser', 'nameTask', 'descricao', 'statusTask']);
    }
  }