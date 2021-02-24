<?php
/**
 * Connect to DB
 */
/** @var \PDO $pdo */
require_once './pdo_ini.php';

function getAllTasks($pdo)
{
    require_once './pdo_ini.php';
    $sth = $pdo->prepare('SELECT id,title,is_done FROM tasks ORDER BY created_at ASC');
    $sth->execute();
    $tasks = $sth->fetchAll();

    return $tasks;
}

if (isset($_GET['addTask']) && !$_GET['addTask'] == '') {
    $newTask = $_GET['addTask'];
    $sth = $pdo->prepare('INSERT INTO tasks (list_id, title, is_done, created_at) VALUES (1,:task,0, NOW())');
    $sth->execute([':task' => $newTask]);
    header("location: index.php");
}

if (isset($_GET['delete'])) {
    $deleteTask = $_GET['delete'];
    $sth = $pdo->prepare('DELETE FROM tasks WHERE id = :id ');
    $sth->execute([':id'=>$deleteTask]);
    header("location: index.php");
}

if (isset($_GET['done'])) {
    $doneTask = $_GET['done'];
    $sth = $pdo->prepare('UPDATE tasks SET is_done = 1 WHERE id = :id ');
    $sth->execute([':id'=>$doneTask]);
    header("location: index.php");
}