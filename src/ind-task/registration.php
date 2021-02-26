<?php
$errorMessage = '';
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
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
<main>
    <article>
        <?php include './header.php' ?>
        <h1>Registration</h1>

        <?php if ($errorMessage) {
            echo '<p class="error-msg">' . $errorMessage . '</p>';
        }
        ?>

        <form class="registration" method="post">
            <input type="text" name="newlogin" id="newlogin" placeholder="Enter your username">
            <input type="password" name="newpass" id="newpass" placeholder="Enter your password">
            <input type="submit" value="Register">
        </form>
    </article>
</main>
</body>
</html>
