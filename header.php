<?php
if(isset($_GET['exit']))
{
    session_destroy();
    header('Location: /football/login.php');
    exit;
}
?>
<style>
ul {
    height: 50px;
    width: 1000px;
    margin: 10px;
    float: right;
    clear: both;
}
 main {
     clear: both;
 }
    li {
        float: right;
        margin-left: 10px;
        list-style: none;
    }

</style>

<header>
    <ul>
        <li><a href="?exit">Exit</a></li>
        <li><a href="index.php">Главная</a></li>
        <li><a href="login.php">Войти</a></li>
        <li><a href="myroom.php">Личный кабинет</a> </li>

    </ul>
</header>

