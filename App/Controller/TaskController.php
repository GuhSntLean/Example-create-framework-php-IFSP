<?php 
  namespace App\Controller;

  use App\Model\Task;
  use App\Model\DataUser;

  use Source\View\View;

  class TaskController{
    
    private $dataUser;
    private $task;
    private $view;
    
    public function __construct(){
      $this->dataUser = new DataUser();
      $this->task     = new Task();
      $this->view     = new View();
    }

    public function index($id = null){
      if(isset($id)){
        $tarefas = $this->task->listTask($id);
        return $tarefas;
      }
      return false;
    }

    public function editTask($id){
      $tarefa = $this->task->findById($id);
      $this->view->render('task/edit',$tarefa);
      $tarefa;
    }
  }