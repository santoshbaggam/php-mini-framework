<?php

namespace App\Core\Database;

use PDO;

class QueryBuilder
{
    protected $connection;

    protected $model;

    protected $table;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function on($model)
    {
        $this->model = $model;

        $this->setTable();

        return $this;
    }

    protected function setTable()
    {
        $this->table = (new $this->model)->table;
    }

    public function selectAll()
    {
        $statement = $this->connection->prepare("select * from {$this->table}");

        $statement->execute();

        return $statement->fetchAll( PDO::FETCH_CLASS, $this->model );
    }

    public function insert($parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $this->table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->connection->prepare($sql);

            $statement->execute($parameters);
        } catch (\Exception $e) {
            //
        }
    }
}
