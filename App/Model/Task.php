<?php 
  namespace App\Model;

  use Source\DB\Model;

  class Task extends Model{

    public function __construct(){
      parent::__construct('tasks', ['idDatauser', 'nameTask', 'descricao', 'statusTask']);
    }

    public function listTask($id){
      $this->find('idDatauser = :idDatauser', "idDatauser={$id}");
      $listtask = $this->fetch(true);

      return $listtask;
    }
  }