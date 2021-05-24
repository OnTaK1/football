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
    <h1>Мой профиль</h1>
    <?php
    $log = $_SESSION['login'];
    $pass = $_SESSION['password'];
    $ghost = "SELECT * FROM users WHERE login = '$log' AND password = '$pass' ";
    $result = mysqli_query($db,$ghost);
    echo '<table border = "1" >'  . '<td>' . 'Имя'. '</td>' . '<td>' . 'Фамилия'. '</td>' . '<td>' . 'Дата рождения'. '</td>'. '<td>' . 'Теефон'. '</td>'.'<td>'. ' Почта ' . '</td>'.'<td>'. ' Пароль ' . '</td>'.'<td>'. ' Логин ' . '</td>' .  '</tr>';
    for ($i = 0; $i<mysqli_num_rows($result); $i++) {
        $result_arr = mysqli_fetch_assoc($result);
        echo   '<td>'  . $result_arr['name'] . '</td>' . '<td>'  . $result_arr['surname'] . '</td>' . '<td>' . $result_arr['birth'] . '</td>' . '<td>'  . $result_arr['phone']  . '</td>' . '<td>'  . $result_arr['email'] . '</td>'. '<td>'  . $result_arr['password'] . '</td>'. '<td>'  . $result_arr['login'] . '</td>'. '<td>' .' <p><a href = "useredit.php?id=' . $_SESSION['id'] . '">РЕДАКТИРОВАТЬ</a></p>'  .'</td>' . '</tr>' ;
    }

    echo '</table>';
    ?>
</main>
</body>
</html>