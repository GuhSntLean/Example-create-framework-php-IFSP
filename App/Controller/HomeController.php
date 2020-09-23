<?php
  namespace App\Controller;

  use Source\View\View;

  class HomeController{

    private $view;

    public function __construct(){
      $this->view = new View();
    }

    public function index(){
      $this->view->render('home/index');
      // echo 'teste';
    }

    public function teste(){
      echo 'index';
    }
  }