<?php

namespace Source\DB;

use PDO;
use Exception;
use PDOException;
use PDOStatement;
use stdClass;

abstract class Model
{
    use Crud;

    /** 
     * @var string 
     */
    private $entity;

    /** 
     * @var string 
    */
    private $primary;

    /** 
     *  @var array
    */
    private $fields;

    /** 
     * @var string 
     * */
    protected $statement;

    /** 
     * @var string 
     * */
    protected $params;

    /** 
     * @var string 
     * */
    protected $group;

    /** 
     * @var string 
     * */
    protected $order;

    /** 
     * @var PDOException|null 
     * */
    protected $fail;

    /** @var object|null */
    protected $data;

    public function __construct(string $entity, array $fields, string $primary = 'id'){
        $this->entity = $entity;
        $this->primary = $primary;
        $this->fields = $fields;
    }

    public function __set($name, $value)
    {
        if (empty($this->data)) {
            $this->data = new stdClass();
        }

        $this->data->$name = $value;
    }

    public function __isset($name)
    {
        return isset($this->data->$name);
    }

    /**
     * @return string|null
     */
    public function __get($name)
    {
        $camelCase = str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
        $camelCase[0] = strtolower($camelCase[0]);

        $method = $camelCase;
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        if (method_exists($this, $name)) {
            return $this->$name();
        }

        return ($this->data->$name ?? null);
    }

    /**
     * @return object|null
     */
    public function data(): ?object
    {
        return $this->data;
    }

    /**
     * @return PDOException|Exception|null
     */
    public function fail()
    {
        return $this->fail;
    }

    /**
     * @return Model
     */
    public function find(?string $terms = null, ?string $params = null, string $columns = "*"): Model
    {
        if ($terms) {
            $this->statement = "SELECT {$columns} FROM {$this->entity} WHERE {$terms}";
            parse_str($params, $this->params);
            return $this;
        }

        $this->statement = "SELECT {$columns} FROM {$this->entity}";
        return $this;
    }

    /**
     * @return Model|null
     */
    public function findById(int $id, string $columns = "*"): ?Model
    {
        return $this->find("{$this->primary} = :id", "id={$id}", $columns)->fetch();
    }

    /**
     * @return Model|null
     */
    public function group(string $column): ?Model
    {
        $this->group = " GROUP BY {$column}";
        return $this;
    }

    /**
     * @return Model|null
     */
    public function order(string $columnOrder): ?Model
    {
        $this->order = " ORDER BY {$columnOrder}";
        return $this;
    }

    /**
     * @return array|mixed|null
     */
    public function fetch(bool $all = false)
    {
        try {
            $stmt = Connection::getInstance()->prepare($this->statement . $this->group . $this->order);
            $stmt->execute($this->params);

            if (!$stmt->rowCount()) {
                return null;
            }

            if ($all) {
                return $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
            }

            return $stmt->fetchObject(static::class);
        } catch (PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    /**
     * @return int
     */
    public function count(): int
    {
        $stmt = Connection::getInstance()->prepare($this->statement);
        $stmt->execute($this->params);
        return $stmt->rowCount();
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        $primary = $this->primary;
        $id = null;

        try {
            if (!$this->required()) {
                throw new Exception("Preencha os campos necessários");
            }

            if (!empty($this->data->$primary)) {
                $id = $this->data->$primary;
                $this->update($this->safe(), "{$this->primary} = :id", "id={$id}");
            }

            if (empty($this->data->$primary)) {
                $id = $this->create($this->safe());
            }

            if (!$id) {
                return false;
            }

            $this->data = $this->findById($id)->data();
            return true;
        } catch (Exception $exception) {
            $this->fail = $exception;
            return false;
        }
    }

    /**
     * @return bool
     */
    public function destroy(): bool
    {
        $primary = $this->primary;
        $id = $this->data->$primary;

        if (empty($id)) {
            return false;
        }

        return $this->delete("{$this->primary} = :id", "id={$id}");
    }

    /**
     * @return bool
     */
    protected function required(): bool
    {
        $data = (array)$this->data();
        foreach ($this->fields as $field) {
            if (empty($data[$field])) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return array|null
     */
    protected function safe(): ?array
    {
        $safe = (array)$this->data;
        unset($safe[$this->primary]);
        return $safe;
    }
}