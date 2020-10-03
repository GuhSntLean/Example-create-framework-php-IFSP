<?php
  namespace App\Controller;

  use App\Model\DataUser;

  use Source\View\View;
  
  class DataUserController{
    private $view;
    private $dataUser;

    public function __construct(){
      $this->view = new View();
      $this->dataUser = new DataUser();
    }

    public function newUser(){
      $this->view->render('dadosuser/create');
    }

    public function createNewUser(){
      $username = $_POST['username'];
      $pass     = $_POST['pass'];
      $repass   = $_POST['repeatpass'];
      if(strcmp ($pass ,$repass) && strlen($username) > 5 &&  $username()){
        var_dump('teste');
      }else{

      }
    }
  }