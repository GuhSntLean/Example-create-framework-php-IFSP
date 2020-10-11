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
        header('Location:?r=home');
      }else{
        $this->view->render('dadosuser/create');
      }
    }

    /**
     * Verificando as informações para adicionar o usuario
     */
    public function createNewUser(){
      if(!LoginController::isLogado()){
        $this->view->render('dadosuser/create');
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

    public function dataUser($id){
      $this->dataUser =  $this->dataUser->findById($id);

      $this->view->render('dadosuser/home', $this->dataUser);
    }

    public function infoUser($id){
      $this->dataUser = $this->dataUser->findById($id);
    }

    public function editUser($id){
      $this->dataUser = $this->dataUser->findById($id);
      if($this->dataUser == NULL){
        header('Location:?r=home');
      }else{
        $data[] = $this->dataUser ;
        $this->view->render('dadosuser/edit', $data);
      }
    }

    public function updateUser($id){
      $username = $_POST['username'];
      $pass     = $_POST['pass'];
      $repass   = $_POST['repeatpass'];
      if($pass === $repass && strlen($pass) >= 5 || strlen($username) >= 5 || strlen($username) > 5 || isset($username)) {
        $this->dataUser = $this->dataUser->findById($id);
        $this->dataUser->userName = $username;
        $this->dataUser->pass = $pass;

        $validation = $this->find('userName = :userName', "userName={$this->userName}")->fetch(true);
        if($validation != NULL){
          if($validation[0]->userName == $this->dataUser->userName){
            $this->editUser($id);
          }
          // $this->dataUser->save();
          var_dump($this->dataUser);
        }
        // header('Location:?r=home');
      }else{
        //  header('Location:?r=home');
      }
    }
  }