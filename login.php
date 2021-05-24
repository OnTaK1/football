<?php
session_start();
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
<h1>Добро пожаловать, <?= $_SESSION['login']; ?>
    <?= $_SESSION['type']; ?></h1>
<form method="post" >

    <input type="text" name="login" placeholder="Введите логин">
    <input type="password" name="password" placeholder="Введите пароль"><br>

    <input type= "submit" value="Отправить">
</form>
</main>
</body>
<p>Ещё не зарегестрированы? Вы можете сделать это <a href="registration.php">здесь</a></p>
</html>

<?php
require ('database.php');

$log = htmlspecialchars(addslashes($_POST['login']));
$pass = htmlspecialchars(addslashes($_POST['password']));

if (!empty($log) && !empty($pass)) {

    //$pass= md5(md5($pass));

    $user = mysqli_query($db, "SELECT * FROM users WHERE login = '$log' AND password = '$pass'");
    $ok = mysqli_fetch_assoc( $user);
    $on = $ok['type'];
    echo $on;
    if (mysqli_num_rows($user) !== 0) {
        echo 'ВЫ ВОШЛИ';
        $_SESSION['login'] = $log;
        $_SESSION['password'] = $pass;
        $_SESSION['type'] = $on;
        $_SESSION['id'] = $ok['id'];
        header('Location: /football/index.php');
    } else {
        echo 'Вы не вошли';
    }
}

?>
