<?php
$tasks = []; // all tasks array
require_once './functions.php';
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
<main>
    <article>

        <?php include './header.php' ?>

        <h1>To-do List</h1>

        <?php if (!$_SESSION['userId']) { ?>
            <p>Please, login or register to use todo list</p>
        <?php } ?>

        <section class="body">
            <div class="task-wrapper">
                <form id="addForm" class="addForm">
                    <input id="add-task" class="task" name="addTask" type="text" placeholder="Add new task">
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
                                    <span class="text"><?= $task['title'] ?></span>
                                    <button class="delete-button"><a href="?delete=<?= $task['id'] ?>">Delete</a>
                                    </button>
                                </li>
                            <?php }

                        } else {
                            echo '<li><span class="info">Your task list is empty</span></li>';
                        }
                        ?>
                    </ul>
                </form>
            </div>
            <div class="lists wrapper">
                <form id="addListForm" class="addlist-form">
                    <input id="add-list" class="list" name="addList" type="text" placeholder="Add new list">
                    <input type="submit" value="+">
                </form>
                <form id="updateListForm" class="updateListForm">
                    <ul class="lists">
                        <?php if (getAllLists($pdo)) {

                            foreach (getAllLists($pdo) as $list) {
                                if ($list['id'] == $_SESSION['list_id']) {
                                    $activeList = 'active-list';
                                } else {
                                    $activeList = '';
                                }
                                ?>
                                <li class="list-item <?= $activeList ?>">
                                    <button class="rename-btn">
                                        <a href="?rename=<?= $list['id'] ?>">Rename</a>
                                    </button>
                                    <a href="?setList=<?= $list['id'] ?>">
                                        <span class="list-name"><?= $list['list_name'] ?></span>
                                    </a>
                                    <button class="delete-button"><a href="?deletelist=<?= $task['id'] ?>">Delete</a>
                                    </button>
                                </li>
                            <?php }

                        } else {
                            echo '<li><span class="info">Your have no list yet</span></li>';
                        }
                        ?>
                    </ul>
                </form>
            </div>
        </section>
    </article>
</main>
</body>
</html>




