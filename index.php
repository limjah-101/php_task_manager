<?php

require 'vendor/autoload.php';
use App\Models\Task;
use App\Storage\MySqlDbTaskStorage;
use App\TaskManager;

echo "<pre>";
//var_dump(Task::class); // Return the full class Namespace

try{
    $db = new PDO('mysql:host=127.0.0.1;dbname=todo', 'root', '');
} catch(PDOException $e) {
    die($e->getMessage());
}

$storage = new MySqlDbTaskStorage($db);
$manager = new TaskManager($storage);

var_dump($manager->getTasks());

/**
 * Get all tasks
 */
//$tasks = $storage->all();

/**
 * Create new Task
 */
// $task = new Task;
// $task->setDescription("Learn OOP");
// $task->setDue(new DateTime());
// $storage->store($task);

/**
 * Get Task by ID
 */
//$task = $storage->get(4);

/**
 * UPDATE task by ID
 */
// $task->setDescription("Learn OOP the correct way, yep");
// $task->setDue(new DateTime());
// $task->setComplete(false);

// var_dump($storage->update($task));
