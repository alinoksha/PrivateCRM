<?php

class DataBase
{
    private $pdo;
    public $lastInsertId;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=' . DB_HOST . ';port=3306;charset=utf8;', DB_USER, DB_PASS);
        $this->exec('SET NAMES utf8;');
        $this->exec('CREATE DATABASE IF NOT EXISTS ' . DB_NAME . ' CHARACTER SET utf8;');
        $this->exec('USE ' . DB_NAME);
    }

    public function exec(string $sql, array $params = []): bool
    {
        $stmt = $this->pdo->prepare($sql);
        if ($stmt === false) {
            return false;
        }
        $res = $stmt->execute($params);
        $this->lastInsertId = $this->pdo->lastInsertId();
        return $res;
    }

    public function findOne(string $sql, array $params = []): false|array
    {
        $stmt = $this->pdo->prepare($sql);
        if ($stmt === false) {
            return false;
        }
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findAll(string $sql, array $params = []): Generator
    {
        $stmt = $this->pdo->prepare($sql);
        if ($stmt === false) {
            return;
        }
        $stmt->execute($params);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            yield $row;
        }
    }
}
