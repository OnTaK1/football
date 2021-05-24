<?php
session_start();
require ('database.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
require ('header.php');
?>
<main>
<form method="post" action="login.php">
    <input type="text" name="name" placeholder="Введите имя">
    <input type="password" name="pass" placeholder="Введите пароль"><br>
    <input type="text" name="surname" placeholder="Введите фамилию"><br>
    <input type="text" name="phone" placeholder="Введите телефон"><br>
    <input type="text" name="email" placeholder="Введите e-mail"><br>
    <input type="date" name="date" placeholder="Введите дату рождения"><br>
    <input type="text" name="login" placeholder="Введите login"><br>
    <input type= "submit" value="Отправить"> <br>

</form>
</main>
</body>
</html>
<?php

$name= htmlspecialchars(addslashes($_POST['name']));
$surname= htmlspecialchars(addslashes($_POST['surname']));
$phone= htmlspecialchars(addslashes($_POST['phone']));
$pass = htmlspecialchars(addslashes($_POST['pass']));
$email = htmlspecialchars(addslashes($_POST['email']));
$date = htmlspecialchars(addslashes($_POST['date']));
$log = htmlspecialchars(addslashes($_POST['login']));

$query = "INSERT INTO `users` (`name`, `surname`, `birth`, `phone`, `email`, `password`, `login`) VALUES ('$name', '$surname', '$date', '$phone', '$email', '$pass', '$log')";
mysqli_query($db, $query);
