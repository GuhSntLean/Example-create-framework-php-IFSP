<?php

namespace Source\View;

class View{

  private $header = '';
  private $footer = '';
  private $path;

  public function render($view, $data = null){
    $container = __DIR__ . '';
    $this->load($container, $data);
  }

  private function load(string $containe, $data){
    if(is_array($data)){
      extract($data);
    }
    include $this->header;
    include $containe;
    include $this->footer;
  }

}