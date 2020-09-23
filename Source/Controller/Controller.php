<?php

  namespace Source\Controller;

  use Source\Config\Routes;

  class Controller extends Routes{

    /**
     * Lista de rotas cadastradas em uma outra classe.
     * @var array
     */
    private $routes;

    /**
     * Rota a ser utilizada para realizar as chamadas
     * @var Routes 
    */
    private $route;

    /**
     * Caso a rota não exista sera uma rota default para erros
     * @var string
     */
    private $defaultRouter = 'home';

    public function __construct(){
      $this->routes = parent::listRoutes();
    }

    public function setRouteDefault($route):void{
      $this->defaultRouter = $route;
    }

    public function run(){
      if(isset($_GET['r'])){
        $route = $_GET['r'];
      }else{
        $route = $this->defaultRouter;
      }

      if(array_key_exists($route, $this->routes)){
        $route = $this->routes;
        $this->callController($route);
      }else{
        echo 'Rota invalida';
      }

    }

    private function callController($route){
      $route = explode;
      $controller = $route[0];
      $method = $route[1];
      if(isset($_GET['id'])){
        $id = $_GET['id'];
      }else{
        $id = null;
      }

      $controller = 'Controller\\' . $controller;

      $objController = new $controller;

      $objController->method($id);
    }
  }