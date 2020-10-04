<?php
  namespace App\Controller;

  use App\Model\DataUser;

 class LoginController{

    private $dataUser;

    public function __construct(){}

    private function __clone(){}

    public function isLogado(): bool{
      if($_SESSION['logado']){
        return true;
      }
      return false;
    }

    public function login(){
      $_SESSION['logado'];
    }

    public function logout(){
      session_destroy();
      header('Location:?r=home');
    }
  } 