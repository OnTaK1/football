<?php
session_start();
require ('database.php');

$id = $_SESSION['id'];

if (count($_POST) > 0) {
    updateMatch();
}

function updateMatch():void {
    global $id;
    global $db;

    $name= htmlspecialchars(addslashes($_POST['name']));
    $surname= htmlspecialchars(addslashes($_POST['surname']));
    $birth= htmlspecialchars(addslashes($_POST['birth']));
    $phone = htmlspecialchars(addslashes($_POST['phone']));
    $email = htmlspecialchars(addslashes($_POST['email']));
    $password = htmlspecialchars(addslashes($_POST['password']));
    $login = htmlspecialchars(addslashes($_POST['login']));
    if(!empty($name) && !empty ($surname) && !empty($birth) && !empty($phone) && !empty($email)&& !empty($password)&& !empty($login))  {
        $query = "UPDATE users SET name = '$name', surname = '$surname', birth = '$birth', phone = '$phone', email = '$email', password = '$password', login = '$login' WHERE id = '$id'";
        mysqli_query($db, $query);
    }
}
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
<form method="post" action="">

    </select><br>
    <input type="text" name="name" placeholder="Введите новое имя"><br>
    <input type="text" name="surname" placeholder="Введите новую фамилию"><br>
    <input type="date" name="birth" placeholder="Введите дату рождения"><br>
    <input type="text" name="phone" placeholder="Введите новый номер телефона"><br>
    <input type="text" name="email" placeholder="Введите новую почту"><br>
    <input type="password" name="password" placeholder="Введите новый пароль"><br>
    <input type="text" name="login" placeholder="Введите новый логин"><br>
    <input type= "submit" value="Отправить"> <br>

</form>
</main>
</body>
</html>
