<?php 
  namespace App\Model;

  use Source\DB\Model;

  class InformationUser extends Model{

    public function __construct(){
      parent::__construct("information_user", ['idDatauser', 'first_names', 'last_name', 'email']);
    }
  }