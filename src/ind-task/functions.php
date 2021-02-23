<?php
/**
 * Connect to DB
 */
/** @var \PDO $pdo */
require_once './pdo_ini.php';

$sth = $pdo->prepare('SELECT title,is_done FROM tasks ORDER BY created_at ASC');
$sth->setFetchMode(\PDO::FETCH_ASSOC);
$sth->execute();
$tasks = $sth->fetchAll();


if(isset($_GET['addTask'])) {
//    $tasks[] = $_GET['addTask'];
}