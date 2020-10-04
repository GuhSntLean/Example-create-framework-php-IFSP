<?php

namespace Source\Config;

abstract class Routes{
  /**
   * @var array
   */
  private $routes = [];

  /**
   * @var string
   */
  private $defaultRoute;

  protected function listRoutes():array{
    
    /**
     * Tem que sempre seguir exemplos de rotas para que haja
     * problema com a suas chamadas na aplicacao.
     * Evite colocar nome de todas iguais, sempre verifique 
     * os controller que serão usados.
     */
    
    /** Rotas das infomações do TODO */
    $this->routes['editTask']    = 'TaskController@editTask';
    $this->routes['updateTask']  = 'TaskController@updateTask';

    $this->routes['newTask']     = 'TaskController@newTask';
    $this->routes['saveTask']     = 'TaskController@saveTesk';

     /** Rotas para login e logout */
    $this->routes['login']       = 'HomeController@login';
    
     /** Dados basico sobre usuario */
    $this->routes['newuser']      = 'DataUserController@newUser';
    $this->routes['createuser']   = 'DataUserController@createNewUser';
    
    /** Rotas de home */
    $this->routes['home']         = 'HomeController@index';

    return $this->routes;
  }

  /**
   * Ao adicionar o sempre o Controller se 
   * ele é existente e seu metodo para que não haja erro
   */
  protected function defaultParent():string{
    $this->defaultRoute = 'HomeController@index';
    return $this->defaultRoute;
  }

}