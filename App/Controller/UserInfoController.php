<?php 
  namespace App\Controller;

  use App\Model\InformationUser;
  use App\Model\DataUser;

  use Source\View\View;

  class UserInfoController{
    private $view;
    private $dataUser;
    private $infoUser;

    public function __construct(){
      $this->view = new View();
      $this->dataUser = new DataUser();
      $this->infoUser = new InformationUser();
    }

    public function infoUser($id){
        $verify = $this->dataUser->findById($id);
        if($verify == NULL){
          header('Location:?r=home');
        }else{
          $validation = $this->infoUser->find('idDatauser = :idDatauser', "idDatauser={$verify->id}")->fetch(false);
          if($validation == NULL){
            $this->view->render('infouser/create');
          }else{
            $this->view->render('infouser/home');
          }
        }
    }

    public function saveInfo($id){
      $firstName = $_POST['firstName'];
      $lastName  = $_POST['lastName'];
      $email     = $_POST['email'];
    }

  }