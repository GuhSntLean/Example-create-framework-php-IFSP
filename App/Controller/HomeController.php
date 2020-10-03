<?
  namespace App\Controller;

  
  use App\Controller\LoginController;
  
  use Source\View\View;


  class HomeController{

    private $view;

    public function __construct(){
      $this->view =  new View();
    }

    public function index(){
      if(LoginController::isLogado()){
        $this->view->render('home/login');
      }
    }
  }