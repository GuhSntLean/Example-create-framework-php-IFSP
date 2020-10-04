<?
  namespace App\Controller;

  use App\Controller\LoginController;
  use App\Model\DataUser;

  use Source\View\View;


  class HomeController{

    private $view;
    private $dataUser;

    public function __construct(){
      $this->dataUser = new DataUser();
      $this->view =  new View();
    }

    public function index(){
      if(LoginController::isLogado()){
        $this->view->render('home/home');
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
        if($this->dataUser->loginIn($userName, $pass)){
          $this->view->render('home/home');
        }else{
          $this->view->render('home/login');
        }          
      }
    }
  }