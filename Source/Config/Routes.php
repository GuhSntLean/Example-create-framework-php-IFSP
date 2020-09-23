<?php

namespace Source\Config;

abstract class Routes{
  /**
   * @var array
   */
  private $routes = [];

  protected function listRoutes(){
    
    /**
     * Tem que se seguir exemplos de rotas para que não 
     * tenha problema com a rota chamda de rota
     * $routes[rota-desejada] = 'controller@metodo';
     */

    $this->routes[''] = 'HomeController@index';
    $this->routes['/'] = 'HomeController@teste';

    return $this->routes;
  }

}