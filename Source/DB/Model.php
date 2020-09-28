<?php

  namespace Source\DB;

  use PDO;
  use Exception;
  use PDOException;
  use stdClass;

  abstract class Model{
    use Crud;

    /**
     * $entity tabela que sera utilizada
     * @var string
     * */
    private $entity;

    /**
     * $fields campos a serem inserindos
     * @var array
     */
    private $fields;

    /**
     * $primary chave primaria da tabela
     * @var string
     */
    private $primary;

    /**
     * @var \PDOException|null
     */
    protected $error;

    public function __construct(string $entity, array $fields, string $primary = 'id'){
      $this->entity   = $entity;
      $this->fields   = $fields;
      $this->primary  = $primary;
    }

    public function data():object{

    }
  }