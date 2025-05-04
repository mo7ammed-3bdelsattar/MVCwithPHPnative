<?php

declare(strict_types=1);

namespace Framework;

use PDO;
use App\Database;
use Framework\Exceptions\PageNotFoundException;

abstract class Model
{
    protected $table;
    protected array $errors = [];

    private function getTable(): string
    {
        if ($this->table === null) {
            $className = (new \ReflectionClass($this))->getShortName();
            $this->table = strtolower($className . 's');
        }
        return $this->table;
    }
    public function __construct(private Database $db) {}
    protected function validate(array $data) {}
    protected function addError(string $field, string $message): void
    {
        if (!isset($this->errors[$field])) {
            $this->errors[$field] = [];
        }
        $this->errors[$field] = $message;
    }
    public function getErrors(): array
    {
        return $this->errors;
    }
    public function clearErrors(): void
    {
        $this->errors = [];
    }
    public function getInsertId(): string|false
    {
        return $this->db->getConnection()->lastInsertId();
    }
    public function findAll()
    {
        $pdo = $this->db->getConnection();
        $sql = "SELECT * FROM {$this->getTable()}";
        $stm = $pdo->query($sql);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    public function find(string $id): array|bool
    {

        $pdo = $this->db->getConnection();
        $sql = "SELECT * FROM {$this->getTable()} WHERE id = :id";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':id', $id, PDO::PARAM_STR);
        $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            throw new PageNotFoundException("The item not found");
        }
        return $row;
    }
    public function create(array $data): bool
    {
        $this->validate($data);
        if (! empty($this->errors)) {
            return false;
        }

        $pdo = $this->db->getConnection();
        $columns = implode(", ", array_keys($data));
        $placeholders =  implode(", ", array_fill(0,count($data),"?"));
        $sql = "INSERT INTO {$this->getTable()} ($columns) VALUES ($placeholders)";
        $stm = $pdo->prepare($sql);
        $i=1;
        foreach ($data as $value) {
            $type = match (gettype($value)) {
                'string' => PDO::PARAM_STR,
                'integer' => PDO::PARAM_INT,
                'boolean' => PDO::PARAM_BOOL,
                default => PDO::PARAM_STR,
            };
            $stm->bindValue($i++, $value, $type);
        }
        return $stm->execute();
    }
    public function update(string $id ,array $data):bool{
        $this->validate($data);
        if (! empty($this->errors)) {
            return false;
        }
        $sql = "UPDATE {$this->getTable()} SET ";
        unset($data['id']);
        $assignments = array_keys($data);
        array_walk($assignments,function(&$value){
            $value = "$value= ?";
        });
        $sql .= implode(", ", $assignments) ." WHERE id = ?";
        $pdo = $this->db->getConnection();
        $stm = $pdo->prepare($sql);
        $i=1;
        foreach ($data as $value) {
            $type = match (gettype($value)) {
                'string' => PDO::PARAM_STR,
                'integer' => PDO::PARAM_INT,
                'boolean' => PDO::PARAM_BOOL,
                default => PDO::PARAM_STR,
            };
            $stm->bindValue($i++, $value, $type);
        }
        $stm->bindValue($i, $id, PDO::PARAM_INT);

        return $stm->execute();
    }
    public function delete(string $id):bool{
        $sql ="DELETE FROM {$this->getTable()} WHERE id =:id";
        $conn = $this->db->getConnection();
        $stm = $conn->prepare($sql);
        $stm->bindValue(':id',$id ,PDO::PARAM_INT);
        return $stm->execute();
    }
    public function numRows(){
        $sql = "SELECT COUNT(*) AS total FROM {$this->getTable()}";
        $stm = $this->db->getConnection()->query($sql);
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return (int) $row['total'];
    }
    public function findBy(string $field, string $value): array|bool
    {
        $sql = "SELECT * FROM {$this->getTable()} WHERE $field = :value";
        $stm = $this->db->getConnection()->prepare($sql);
        $stm->bindValue(':value', $value, PDO::PARAM_STR);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_ASSOC) ?: false;
    }
}
