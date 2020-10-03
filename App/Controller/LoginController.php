<?php
  namespace App\Controller;

 class LoginController{

    private function __construct(){}
    private function __clone(){}

    public function isLogado(): bool{
      if($_SESSION['logado']){
        return false;
      }
      return true;
    }

    public function login(){
      $_SESSION['logado'];
    }
  } 