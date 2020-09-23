<?php

namespace Source\View;

class View{

  /**
   * @var string
   */
  private $base;

   /**
   * @var string
   */
  private $header;

  /**
   * @var string
   */
  private $footer;

  private function __clone(){}

  public function __construct(){
    $this->base = getcwd(); // Captura a base do aplicativo.
    $this->header = $this->base.'/App/View/Layout/header.php';
    $this->footer = $this->base.'/App/View/Layout/footer.php';
  }

  public function render($view, $data = null):void{
    $container = $this->base . '/App/View/'.$view.'.php';
    
    $this->load($container, $data);
  }

  private function load(string $containe, $data = null):void{
    if(is_array($data)){
      extract($data);
    }

    include $this->header;
    include $containe;
    include $this->footer;
  }

}