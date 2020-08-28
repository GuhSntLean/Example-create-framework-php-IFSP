<?php
  abstract class DataModel{
  
    /** Nome da tabela */
    protected $table;

    /** Colunas desejadas */
    protected $columns;

    /** Chave primaria */
    protected $primary;

    /** Select se precisar de ByOrder */
    protected $order;
    
    /** Condicional */
    protected $terms;

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