<?php 
  namespace App\Model;

  use Source\DB\Model;

  class User extends Model{

    public function __construct(){
      parent::__construct("tb_usuarios", ['nome', 'email', 'senha']);
    }
  }