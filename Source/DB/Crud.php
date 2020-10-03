<?php

  namespace Source\DB;

  use Exception;
  use PDOException;

  trait Crud{

    /**
     * @param array $data
     * @return int|null
     * @throws PDOException
     */
    protected function create(array $data){
     try{
       $colluns = implode(",", array_keys($data));
       $values = implode(", :", array_keys($data));

       $stmt = Connect::getInstance()->prepare("INSERT INTO {$this->entity}($colluns) VALUES($values)");
       $stmt->execute($this->filter($data));

       return Connect::getInstance()->lastInsertId();

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

      $dataSet = implode(", ", $dataSet);
      parse_str($params, $params);

      $stmt = Connection::getInstance()->prepare("UPDATE {$this->entity} SET {$dateSet} WHERE {$terms}");
      $stmt->execute($this->filter(array_merge($data, $params)));
            
      return ($stmt->rowCount() ?? 1);
    }catch(PDOException $exception) {
      $this->error = $exception;
      return null;
    }
   }



   protected function delete(): bool{
      try {
            $stmt = Connect::getInstance()->prepare("DELETE FROM {$this->entity} WHERE {$terms}");
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

   protected function filter(){
      $filter = [];
      foreach ($data as $key => $value) {
          $filter[$key] = (is_null($value) ? null : filter_var($value, FILTER_DEFAULT));
      }
      return $filter;
   }
  }
