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

   protected function update(){

   }

   protected function delete(): bool{
    try{

      return true;

    }catch(PDOException $e){

      $this->error = $e;
      return false;

    }
   }

   protected function filter(){
     
   }
  }
