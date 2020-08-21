<?php


namespace Source\Models;


use CoffeeCode\DataLayer\Connect;
use CoffeeCode\DataLayer\DataLayer;

/**
 * Class Model
 * @package Source\Models
 *
 * @property Connect $connect
 */
abstract class Model extends DataLayer
{
    /**
     * @var Connect
     */
    protected $connect;

    /**
     * Tabela que vai ser cabeçalho da consulta.
     *
     * @var $table
     */
    protected $table;

    /**
     * Antiga tabela setada para realizar consulta.
     *
     * @var $oldTable
     */
    protected $oldTable;

    /**
     * Model constructor.
     * @param $entity
     * @param $required
     */
    public function __construct($entity, $required)
    {
        $this->connect = Connect::getInstance();

        parent::__construct($entity, $required);
    }

    /**
     * Setando tabela que vai ser cabeçalho da consulta.
     *
     * @param string $table
     */
    public function setTable(string $table): void
    {
        if (! empty($this->table)) {
            $this->oldTable = $this->table;
        }

        $this->table = $table;
    }

    /**
     * Consulta tabela que vai ser cabeçalho da consulta.
     *
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * Responsavel por retirar a tabela setada para realizar a consulta.
     */
    public function reset()
    {
        $this->table = $this->oldTable;
    }

    /**
     * Estrutura responsavel por montar querys mais específicas
     *
     * @param array $data
     * @return array|null
     */
    public function search(array $data, $forceArray = false)
    {
        $filds = null;
        $joins = [];
        $filters = [];
        $limit = null;

        foreach ($data as $key => $value) {
            switch ($key) {
                case 'select':
                    $filds = $value;
                    break;
                case 'join':
                    $joins = $value;
                    break;
                case 'where':
                    $filters = $value;
                    break;
                case 'limit':
                    $limit = $value;
                    break;
            }
        }

        $fild = "*";
        if (! empty($filds)) {
            $fild = implode(" ,", $filds);
        }

        $join = "";
        if (! empty($joins)) {
            $join = [];

            foreach ($joins as $key => $value) {
                $join[] = "INNER JOIN {$key} AS " . ucfirst($key) . " ON " . key($value) . " = " . current($value);
            }

            $join = implode(" ", $join);
        }

        $where = null;
        if (! empty($filters)) {
            $where = [];

            foreach ($filters as $key => $value) {
                $where[] = $key . " = " . $value;
            }
            $where = implode(" AND ", $where);
        }

        if (! empty($where)) {
            $query = "SELECT {$fild} FROM {$this->getTable()} AS " . ucfirst($this->getTable()) . " {$join} WHERE {$where}";
        } else {
            $query = "SELECT {$fild} FROM {$this->getTable()} AS " . ucfirst($this->getTable()) . " {$join}";
        }

        if (! is_null($limit)) {
            $forceArray = false;
            $query .= ' limit ' . $limit;
        }

        if (isset($data['sql']) && $data['sql']) {
            return $query;
        }

        try {
            if (! is_null($limit) && (int) $limit == 1) {
                $return = $this->connect->query(trim($query))->fetch();
            } else {
                $return = $this->connect->query(trim($query))->fetchAll();
            }

        } catch (\Exception $exception) {
            $return = null;
        }

        $returnToArray = null;
        if ($return && ! is_array($return) && $forceArray) {
            $returnToArray[] = $return;
        }

        return $returnToArray ?: $return;
    }
}