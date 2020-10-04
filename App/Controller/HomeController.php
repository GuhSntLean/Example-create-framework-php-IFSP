<?
  namespace App\Controller;

  use App\Controller\LoginController;
  use App\Controller\TaskController;

  use App\Model\DataUser;

  use Source\View\View;


  class HomeController{

    private $view;
    private $dataUser;
    private $task;

    public function __construct(){
      $this->dataUser = new DataUser();
      $this->view =  new View();
      $this->task = new TaskController();
    }

    public function index(){
      if(LoginController::isLogado()){
        $user = $_SESSION['usuario'];
        $data[] = $this->task->index($user->id);
        $data[] = $_SESSION['usuario'];
        $this->view->render('home/home', $data);
      }else{
        $this->view->render('home/login');
      }
    }

    public function login(){
      if(LoginController::isLogado()){
        $this->view->render('home/home');
      }else{
        $userName  = $_POST['nameUser'];
        $pass      = $_POST['pass'];
        $datauser = $this->dataUser->loginIn($userName, $pass);
        $this->dataUser = $this->dataUser->loginIn($userName, $pass);
        if($datauser != NULL){
          $task = $this->task->index($this->dataUser->id);
          $data[] = $this->task->index($this->dataUser->id);
          $data[] = $this->dataUser;
          LoginController::login($this->dataUser);
          $this->view->render('home/home', $data);
        }else{
          $this->view->render('home/login');
        }
      }
    }

    public function logout(){
      LoginController::logout();
    }
  }