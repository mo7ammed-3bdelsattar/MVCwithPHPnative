<?php

declare(strict_types=1);

namespace App;

use PDO;

class Database
{
    private ?PDO $pdo = null;
    public function __construct(private string $host, private string $dbname, private string $user, private string $password) {}
    public function getConnection(): PDO
    {
        if ($this->pdo === null) {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;port=3306;charset=utf8";
            $this->pdo = new PDO($dsn, $this->user, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return $this->pdo;
    }
}
