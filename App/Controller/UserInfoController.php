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

    public function editInfo($id){
        $verify = $this->infoUser->findById($id);
        if($verify == NULL){
          header('Location:?r=home');
        }else{
          if($verify == NULL){
            header('Location:?r=home');
          }else{
            $this->view->render('infouser/edit', $verify );
          }
        }
    }

    public function infoUser($id){
        $verify = $this->dataUser->findById($id);
        if($verify == NULL){
          header('Location:?r=home');
        }else{
          $validation = $this->infoUser->find('idDatauser = :idDatauser', "idDatauser={$verify->id}")->fetch(true);
          if($validation == NULL){
            $this->view->render('infouser/create', $id);
          }else{
            $this->view->render('infouser/home', $validation );
          }
        }
    }

    public function saveInfo($id){
      $firstName = $_POST['firstName'];
      $lastName  = $_POST['lastName'];
      $email     = $_POST['email'];
      
      $validation = $this->infoUser->find('idDatauser = :idDatauser', "idDatauser={$id}")->fetch(false);
      if($validation != NULL){
        $this->infoUser = $validation;
        $this->infoUser->first_names = $firstName;
        $this->infoUser->last_name = $lastName;
        $this->infoUser->email = $email;
      }else{
        $this->infoUser->idDatauser = $id;
        $this->infoUser->first_names = $firstName;
        $this->infoUser->last_name = $lastName;
        $this->infoUser->email = $email;
      }

      $this->infoUser->save();

      header('Location:?r=home');
    }

  }