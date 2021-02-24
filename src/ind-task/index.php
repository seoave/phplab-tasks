<?php
$tasks = []; // all tasks array

require_once './functions.php';

echo 'debug<br>';
var_dump($_REQUEST);
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

<!--<h1>To-do List</h1>-->

<form id="addForm" action="" class="addForm">
    <input id="add-task" class="task" name="addTask" type="text">
    <input type="submit" value="+">
</form>

<form id="updateForm" class="updateForm">
    <ul class="tasks">
        <?php if (getAllTasks($pdo)) {

            foreach (getAllTasks($pdo) as $task) {
                $statusClass = $task['is_done'] ? 'done' : ""; ?>
                <li class="<?= $statusClass ?>">
                    <button class="done-btn">
                        <a href="?done=<?= $task['id'] ?>">Done</a>
                        <span class="disable">Done</span>
                    </button>
                    <span><?= $task['title'] ?></span>
                    <button class="delete-button"><a href="?delete=<?= $task['id'] ?>">Delete</a></button>
                </li>
            <?php }

        } else {
            echo '<li><span class="info">Your task list is empty</span></li>';
        }
        ?>
    </ul>
</form>

</body>
</html>




