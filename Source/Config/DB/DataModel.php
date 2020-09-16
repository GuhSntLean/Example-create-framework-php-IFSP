<?php
  abstract class DataModel{
  
    /** Nome da tabela */
    protected $table;

    /** @var array Colunas desejadas */
    protected $columns;

    /** @var array Colunas required */
    protected $required;

    /** @var array Chave primaria */
    protected $primary;

    /** Select se precisar de ByOrder */
    protected $order;
    
    /** Condicional */
    protected $terms;

    public function __construct(){

    }

    public function create(): bool{
      
    }

    public function destroy(): bool{

    }

    public function update(): int{

    }

    public function find(): array{

    }

    public function findId(): array{

    }

  }