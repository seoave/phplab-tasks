<?php
$tasks = []; // all tasks array

require_once './functions.php';

echo 'debug<br>';
var_dump($tasks);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<h1>To-do List</h1>

<form id="addForm" action="" class="addForm">
    <input id="add-task" class="task" name="addTask" type="text">
    <input type="submit" value="+">
</form>

<form id="updateForm" class="updateForm">
    <ul>
        <?php foreach ($tasks as $task) { ?>
        <li>
            <input type="checkbox" name="" id="task-id-0">
            <label for="task-id-0"><?= $task['title'] ?></label>
            <span class="delete-button"><a href="?delete=1">X</a> </span>
        </li>
        <?php } ?>
    </ul>
</form>

</body>
</html>




