<?php

namespace App\Storage\Contracts;

use App\Models\Task;


/**
 * Desc
 * Todo
 */
interface TaskStorageInterface
{
    public function store(Task $task);
    public function update(Task $task);
    public function get($id);
    public function all();   
}