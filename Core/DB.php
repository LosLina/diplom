<?php

namespace Core;

class DB
{
    protected $pdo;

    public function __construct($server, $login, $password, $database)
    {
        $this->pdo = new \PDO("mysql:host={$server};dbname={$database};charset=UTF8", $login, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    }

    public function select($table, $fields = '*', $where = null, $orderBy = null, $limit = null, $offset = null, $like = null)
    {
        $fieldsStr = "*";
        if (is_string($fields))
            $fieldsStr = $fields;
        if (is_array($fieldsStr))
            $fieldsStr = implode(", ", $fields);
        $sql = "SELECT {$fieldsStr} FROM {$table}";
        if (is_array($where) && count($where) > 0) { ///якщо передається масив
            $whereParts = [];
            foreach ($where as $key => $value)
                $whereParts[] = "{$key} = ?";
            $whereStr = implode(" AND ", $whereParts);
            $sql .= ' WHERE ' . $whereStr;
        }
        if (is_string($where))
            $sql .= ' WHERE ' . $where;
        if (is_array($orderBy)) {
            $orderByParts = [];
            foreach ($orderBy as $key => $value) {
                $orderByParts[] = "{$key} {$value}";
            }
            $sql .= ' ORDER BY ' . implode(', ', $orderByParts);

        }
        if (!empty($limit)) {
            if (!empty($offset))
                $sql .= " LIMIT {$offset}, {$limit}";
            else
                $sql .= " LIMIT {$limit}";
        }
        $sth = $this->pdo->prepare($sql);

        if (is_array($where) && count($where) > 0)
            $sth->execute(array_values($where));
        else
            $sth->execute();
        return $sth->fetchAll();
    }

    public function insert($table, $row)
    {
        $fieldsStr = implode(', ', array_keys($row));
        $valueParts = [];
        foreach ($row as $key => $value) {
            $valueParts[] = '?';
        }
        $valueStr = implode(', ', $valueParts);
        $sql = "INSERT INTO {$table} ($fieldsStr) VALUES ($valueStr)";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(array_values($row));
        return $this->pdo->lastInsertId();
    }

    public function delete($table, $where)
    {
        $sql = "DELETE FROM {$table}";
        if (is_array($where) && count($where) > 0) {
            $whereParts = [];
            foreach ($where as $key => $value)
                $whereParts[] = "{$key} = ?";
            $whereStr = implode(" AND ", $whereParts);
            $sql .= ' WHERE ' . $whereStr;
        }
        if (is_string($where))
            $sql .= ' WHERE ' . $where;

        $sth = $this->pdo->prepare($sql);
        if (is_array($where) && count($where) > 0)
            $sth->execute(array_values($where));
        else
            $sth->execute();
    }

    public function update($table, $newPow, $where)
    {
        $sql = "UPDATE {$table} SET ";
        $setParts = [];
        $paramsArr = [];
        foreach ($newPow as $key => $value) {
            $setParts[] = "{$key} = ?";
            $paramsArr[] = $value;
        }
        $sql .= implode(', ', $setParts);
        if (is_array($where) && count($where) > 0) {
            $whereParts = [];
            foreach ($where as $key => $value) {
                $whereParts[] = "{$key} = ?";
                $paramsArr[] = $value;
            }
            $whereStr = implode(" AND ", $whereParts);
            $sql .= ' WHERE ' . $whereStr;
        }
        if (is_string($where))
            $sql .= ' WHERE ' . $where;
        $sth = $this->pdo->prepare($sql);
        $sth->execute($paramsArr);

    }

    public function search($table, $search)
    {
        $sql = "SELECT * FROM {$table} WHERE title LIKE '%{$search}%'";
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    public function count($table) {
        $sql = "SELECT COUNT(*) FROM {$table}";
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
    public function count2($table, $value) {
        $sql = "SELECT COUNT(*) FROM {$table} WHERE access = {$value}";
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
}
