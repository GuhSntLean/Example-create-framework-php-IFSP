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
     * Erro no banco de dados 
     * @var \PDOException|null
     */
    protected $error;

    /**
     * $object objeto da $entity
     * @var object|null
    */
    protected $object;

    /**
    * String da query para ser executada no banco de dados banco de dados
    * @var string
    */
    protected $statement;

    /**
     * String com paramentros a serem passado a uma query
     * @var string
     */
    protected $parameters;

    /**Opções para o select */

    /**
     * @var string
     */
    protected $group ;

    /**
     * @var string
     */
    protected $order;


    public function __construct(string $entity, array $fields, string $primary = 'id'){
      $this->entity   = $entity;
      $this->fields   = $fields;
      $this->primary  = $primary;
    }

    /**
     * Referencia de a um objeto com a entidade
     */

     /**
     * @return bool|null
     */
    public function __isset($name):bool{
      $response = isset($this->data->$name);
      return $response;
    }

    public function __set($name, $value){
      if(empty($this->data)){
        $this->data = new stdClass();
      }

      $this->data = new stdClass();
    }

    public function __get($name){
      $method     = str_replace(' ', '', ucwords(str_replace('_',' ', $name)));
      $method[0]  = strtolower($method[0]);

      if(method_exists($this, $method)){
        return $this->$method();
      }

      if(method_exists($this, $name)){
        return $this->$name();
      }

      return ($this->data->$name ?? null);
    }

    /**
     * @return object|null
     */
    protected function data(): ?object{
      return $this->data;
    }

    /**
     * @return bool
     */
    protected function require(): bool{
      $data = (array) $this->data();
      foreach($this->fields as $field){
        if(empty($data[$field])){
          return false;
        }
      }
      return true;
    }

    /**
     * @return array|null
     */
    protected function safe(): ?array{
      $safe = (array) $this->object;
      unset($safe[$this->primary]);
      return $safe;
    }

     /**
     * Erro de Objetos e conexão a banco de dados
     * @return Exception|PDOException|null
     */
    public function error(){
      return $this->error;
    }

    /**
     * Deletando informações
     * @return boll 
     */
    public function destroy():bool{
      $primary = $this->primary;
      $id = $this->object->$primary;

      if(empty($id)){
        return false;
      }

      return $this->delete("{$this->primary} = :id", "id={$id}");
    }

    /**
     * Procurando informações
     * @return Model
     */
    public function find(?string $terms = null, ?string $parameters = null, string $coluns = "*"): Model{
      if($terms){
        $this->statement = "SELECT {$coluns} FROM {$this->entity} WHERE {$terms}";
        parse_str($parameters, $this->fields);
      }else{
        $this->statement = "SELECT {$coluns} FROM {$this->entity}";
      }
      return $this;
    } 

    /**
     * Trazer as informações em ordem
     * @return Model|null
     */
    public function order(string $column): ?Model{
      $this->order = " ORDER BY {$column}";
      return $this;
    }

    /**
     * Para seleção em grupo
     * @return Model|null
     */
    public function group(string $column): ?Model{
      $this->group = " GROUP BY {$column}";
      return $this;
    }

    public function count(){
      $stmt = Connection::getInstance()->prepare($this->statement);
      $stmt->execute($this->parameters);
      return $stmt->rowCount();
    }

    /**
     * Seleção atraves do ID
     */
    public function findById(int $id, string $columns = "*") {
      return $this->find("{$this->primary} = :id", "id={$id}", $columns);
    }

    public function fetch(bool $all = false){
      try{
        $stmt = Connection::getInstance()->prepare($this->statement . $this->group . $this->order);
        $stmt->execute($this->parameters);

        if (!$stmt->rowCount()) {
          return null;
        }

        if ($all) {
          return $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
        }

        return $stmt->fetchObject(static::class);
      } catch (PDOException $exception) {
          $this->error = $exception;
          return null;
      }
    }

    public function save() :bool{
      $primary = $this->primary;
      $id = null;
      try{

        if(!$this->require()){
          throw new Exception();
        }

        if(!empty($this->object->$primary)){
          $id = $this->object->$primary;
          $this->update($this->safe, "{$this->primary} = :id", "id={$id}");
        }

        if (empty($this->object->$primary)) {
          $id = $this->create($this->safe());
        }
      
        if(!$id){
          return false;
        }

        $this->object = $this->findById($id);
        return true;

      }catch(PDOException $exception) {
        $this->error = $exception;
        return false;
      }
    }
  }