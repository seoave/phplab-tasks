<?php
/**
 * Connect to DB
 */
/** @var \PDO $pdo */
require_once './pdo_ini.php';

session_start();

// new user registration
if ($_POST['newlogin'] && $_POST['newpass']) {
    $sth = $pdo->prepare('SELECT username FROM users WHERE username = :username');
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute([':username' => $_POST['newlogin']]);
    $newUserName = $sth->fetch();
    if (!$newUserName) {
        $sth = $pdo->prepare('INSERT INTO users (username, pass) VALUES (:username, :pass) ');
        $sth->execute([':username' => $_POST['newlogin'], ':pass' => $_POST['newpass']]);
        $_SESSION['userId'] = $pdo->lastInsertId();
        $_SESSION['username'] = $_POST['newlogin'];
        $errorMessage = 'You are registered successfully';
        $errorMessage .= '<br>Follow <a href="./index.php">link</a> to use your todo list';
    } else {
        $errorMessage = "Sorry, username \"{$_POST['newlogin']}\" is not available";
    }
} else {
    if ($_POST['newlogin'] && !$_POST['newpass'] || !$_POST['newlogin'] && $_POST['newpass']) {
        $errorMessage = "Please, fill all fields for registration";
    }
}

// user login
if ($_POST['login'] && $_POST['pass']) {
    // looking for username
    $sth = $pdo->prepare('SELECT username FROM users WHERE username = :username');
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute([':username' => $_POST['login']]);
    $userName = $sth->fetch();

    // looking for pass
    if ($userName) {
        $sth = $pdo->prepare('SELECT pass,id FROM users WHERE username = :username');
        $sth->setFetchMode(\PDO::FETCH_ASSOC);
        $sth->execute([':username' => $_POST['login']]);
        $pass = $sth->fetch();

        if ($_POST['pass'] == $pass['pass']) {
            $_SESSION['userId'] = $pass['id'];
            $_SESSION['username'] = $_POST['login'];
            $errorMessage = 'You login successfully';
            $errorMessage .= '<br>Follow <a href="./index.php">link</a> to use your todo list';
        } else {
            $errorMessage = "Sorry, your password is wrong";
        }

    } else {
        $errorMessage = "Sorry, username \"{$_POST['login']}\" is not exists";
        $errorMessage .= '<br>Enter other username or <a class="register" href="./registration.php">register</a>';
    }

} else {
    if ($_POST['login'] && !$_POST['pass'] || !$_POST['login'] && $_POST['pass']) {
        $errorMessage = "Please, fill all fields";
    }
}

// on logout clean $_SESSION
if ($_GET['logout'] == 1) {
    $_SESSION = [];
}

// tasks

if (!$_SESSION['list_id'] && $_SESSION['userId']) {
    // check if user has list_id
    $sth = $pdo->prepare('SELECT id FROM lists WHERE user_id = :user_id');
    $sth->execute([':user_id'=>$_SESSION['userId']]);
    $listID = $sth->fetch();

    if(!$listID) {
        $sth = $pdo->prepare('INSERT INTO lists (created_at,user_id) VALUES (NOW(),:user_id)');
        $sth->execute([':user_id'=>$_SESSION['userId']]);
        $_SESSION['list_id'] = $pdo->lastInsertId();
    } else {
        $_SESSION['list_id'] = $listID;
    }
}

function getAllTasks($pdo)
{
    require_once './pdo_ini.php';
    $sth = $pdo->prepare('SELECT id,title,is_done FROM tasks WHERE list_id = :list_id ORDER BY created_at DESC');
    $sth->execute([':list_id'=>$_SESSION['list_id']]);
    $tasks = $sth->fetchAll();

    return $tasks;
}

if (isset($_GET['addTask']) && !$_GET['addTask'] == '') {
    $newTask = $_GET['addTask'];
    $sth = $pdo->prepare('INSERT INTO tasks (list_id, title, is_done, created_at) VALUES (:list_id,:task,0, NOW())');
    $sth->execute([':list_id' => $_SESSION['list_id'], ':task' => $newTask]);
    header("location: index.php");
}

if (isset($_GET['delete'])) {
    $deleteTask = $_GET['delete'];
    $sth = $pdo->prepare('DELETE FROM tasks WHERE id = :id ');
    $sth->execute([':id' => $deleteTask]);
    header("location: index.php");
}

if (isset($_GET['done'])) {
    $doneTask = $_GET['done'];
    $sth = $pdo->prepare('UPDATE tasks SET is_done = 1 WHERE id = :id ');
    $sth->execute([':id' => $doneTask]);
    header("location: index.php");
}