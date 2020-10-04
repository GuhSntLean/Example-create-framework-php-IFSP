<?php 
  namespace App\Model;

  use Source\DB\Model;

  class DataUser extends Model{

    public function __construct(){
      parent::__construct("dataUser", ['userName', 'pass']);
    }

    public function saveUser(){
      $validation = $this->find('userName = :userName', "userName={$this->userName}")->fetch(true);
      if($validation == NULL){
        return $this->save();
      }else{
        return false;
      }
    }
  }