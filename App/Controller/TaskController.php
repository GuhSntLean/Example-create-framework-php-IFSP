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

    public function newTask($id){

      $data[] = $id;
      $data[] = $this->defaulsTaks();
      $this->view->render('task/create', $data);
    }

    public function saveTesk($id){
      if(empty($_POST['nameTask']) || empty($_POST['descricao']) || empty($_POST['status'])){
        $this->newTask($id);
      }
      $this->task->idDatauser = $id;
      $this->task->nameTask = $_POST['nameTask'];
      $this->task->descricao = $_POST['descricao'];
      $this->task->statusTask = $_POST['status'];

      $this->task->save();

      // header('Location:?r=home');
    }

    public function editTask($id){
      $tarefa = $this->task->findById($id);
      $data[] = $tarefa;
      $data[] = $this->defaulsTaks();
      $this->view->render('task/edit',$data);
    }


    public function updateTask($id){
      if(empty($_POST['nameTask']) || empty($_POST['descricao']) || empty($_POST['status'])){
        $this->editTask($id);
      }
      $this->task = $this->task->findById($id);

      $this->task->id = $id;

      $this->task->nameTask = $_POST['nameTask'];
      $this->task->descricao = $_POST['descricao'];
      $this->task->statusTask = $_POST['status'];

      $this->task->save();

      header('Location:?r=home');
    }

    public function defaulsTaks(){
      return ["A fazer", "Fazendo", "Feito"];
    }  
  }