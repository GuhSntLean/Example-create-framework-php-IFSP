<?php
  namespace App\Controller;

  use App\Model\DataUser;

  use Source\View\View;
  
  use App\Controller\LoginController;

  class DataUserController{
    private $view;
    private $dataUser;

    public function __construct(){
      $this->view = new View();
      $this->dataUser = new DataUser();
    }

    /**
     * Chamada de tela para cadatro do usuario
     */
    public function newUser(){
      if(LoginController::isLogado()){
        $this->view->render('home/login');
      }else{
        $this->view->render('dadosuser/create');
      }
    }

    /**
     * Verificando as informações para adicionar o usuario
     */
    public function createNewUser(){
      if(LoginController::isLogado()){
        $this->view->render('home/login');
      }

      $username = $_POST['username'];
      $pass     = $_POST['pass'];
      $repass   = $_POST['repeatpass'];
      if($pass === $repass && strlen($pass) >= 5 && strlen($username) >= 5 && strlen($username) > 5 && isset($username)) {
        $this->dataUser->userName = $username;
        $this->dataUser->pass     = $pass;
        if($this->dataUser->saveUser() == true){
          $this->view->render('home/login');
        }else{
          $this->view->render('dadosuser/create');
        }
      }else{
         $this->view->render('dadosuser/create');
      }
    }
  }