<?php

namespace App\Storage;

use PDO;
use App\Models\Task;
use App\Storage\Contracts\TaskStorageInterface;


class MySqlDbTaskStorage implements TaskStorageInterface
{
    protected $db;
    
    /**
     * 
     */
    public function __construct(PDO $db){
        $this->db = $db;
    }

    /**
     * 
     */
    public function store(Task $task){
        
        $stmt = $this->db->prepare("
            INSERT INTO tasks (description, due, complete)
            VALUES (:description, :due, :complete)
        ");
        $stmt->execute($this->buildColumns($task));
        return $this->get($this->db->lastInsertId());
    }

    /**
     * 
     */
    public function update(Task $task){
        //var_dump($task);
        $stmt = $this->db->prepare("
            UPDATE tasks
            SET description = :description,
                due = :due,
                complete = :complete
            WHERE id = :id
        ");
        $stmt->execute($this->buildColumns($task, ["id" => $task->getId()]));
        return $this->get($task->getId());
    }

    /**
     * @Return Task Model
     */
    public function get($id){
        $stmt = $this->db->prepare("
            SELECT id, description, due, complete 
            FROM tasks 
            WHERE id = :id");
        $stmt->setFetchMode(PDO::FETCH_CLASS, Task::class);
        $stmt->execute(["id" => $id]);
        return $stmt->fetch();
    }

    /**
     * 
     */
    public function all(){
        $stmt = $this->db->prepare("SELECT id, description, due, complete FROM tasks");
        $stmt->setFetchMode(PDO::FETCH_CLASS, Task::class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    /**
     * Refacto to DRY code
     */
    public function buildColumns(Task $task, array $additional = []){
        
        return array_merge([
            "description" => $task->getDescription(),
            "due" =>         $task->getDue()->format('Y-m-d H:i:s'),
            "complete" =>    $task->getComplete() ? 1 : 0,
        ], $additional);
    }

}