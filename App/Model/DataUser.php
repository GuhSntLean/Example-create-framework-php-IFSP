<?php 
  namespace App\Model;

  use Source\DB\Model;

  class DataUser extends Model{

    public function __construct(){
      parent::__construct("dataUser", ['userName', 'pass']);
    }
  }