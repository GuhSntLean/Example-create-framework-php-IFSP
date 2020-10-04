<?php

  namespace Source\DB;
  
  use PDO;
  use Exception;
  use PDOException;
  use PDOStatement;

  trait Crud{

    /**
     * @return int|null
     * @throws PDOException
     */
    protected function create(array $data){
     try{
      $columns = implode(", ", array_keys($data));
      $values = ":" . implode(", :", array_keys($data));

      $stmt = Connection::getInstance()->prepare("INSERT INTO {$this->entity} ({$columns}) VALUES ({$values})");
      $stmt->execute($this->filter($data));

      return Connection::getInstance()->lastInsertId();

     }catch(PDOException $e){
       $this->error = $e;
       return null;
     }
   } 

   protected function update(array $data, string $terms, string $params){
    try{
      $dataSet = [];
      foreach($data as $bind => $value){
        $dataSet[] = "{$bind} = :{$bind}";
      }
      
      $dataSet = implode(" , ", $dataSet);
      parse_str($params, $params);
      
      $stmt = Connection::getInstance()->prepare("UPDATE {$this->entity} SET {$dataSet} WHERE {$terms}");
      $stmt->execute($this->filter(array_merge($data, $params)));
            
      return ($stmt->rowCount() ?? 1);
    }catch(PDOException $exception) {
      $this->error = $exception;
      return null;
    }
   }

   protected function delete(string $terms, ?string $params): bool{
      try {
            $stmt = Connection::getInstance()->prepare("DELETE FROM {$this->entity} WHERE {$terms}");
            if ($params) {
                parse_str($params, $params);
                $stmt->execute($params);
                return true;
            }

            $stmt->execute();
            return true;
      } catch (PDOException $exception) {
            $this->fail = $exception;
            return false;
      }
   }

   protected function filter(array $data): array{
      $filter = [];
      foreach ($data as $key => $value) {
          $filter[$key] = (is_null($value) ? null : filter_var($value, FILTER_DEFAULT));
      }
      return $filter;
   }
  }
