<?php
session_start();
require ('database.php');

function getTeams(): array
{
    global $db;

    $teams = [];

    $query = mysqli_query($db, "SELECT * FROM team");
    for ($i=0; $i<mysqli_num_rows($query); $i++) {
        $teams[] = mysqli_fetch_assoc($query);
    }

    return $teams;
};
function getStad(): array
{
    global $db;

    $stadium = [];

    $query = mysqli_query($db, "SELECT * FROM stadium");
    for ($i=0; $i<mysqli_num_rows($query); $i++) {
        $stadium[] = mysqli_fetch_assoc($query);
    }

    return $stadium;
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
<h1>Заказ билетов</h1>
<h2>Выберите матч</h2>
<?php
    $ghost = "SELECT * FROM matches ";
    $result = mysqli_query($db,$ghost);
    echo '<table border = "1" >'  . '<td>' . 'Команда 1'. '</td>' . '<td>' . 'Команда 2'. '</td>' . '<td>' . 'Дата матча'. '</td>'. '<td>' . 'Стадион'. '</td>'.'<td>'. ' Цена ' . '</td>'.'<td>'. ' Кол-во оставшихся мест ' . '</td>'.'<td>'. ' Купить ' . '</td>' .  '</tr>';
    for ($i = 0; $i<mysqli_num_rows($result); $i++) {
        $result_arr = mysqli_fetch_assoc($result);
        $none = $result_arr['team_id'];
        $teamone = "SELECT name FROM team where id = '$none' ";
        $teamres = mysqli_query($db,$teamone);
        $teamone_arr = mysqli_fetch_assoc($teamres);
        $nane = $result_arr['team2_id'];
        $teamtwo = "SELECT name FROM team where id = '$nane' ";
        $teamt = mysqli_query($db,$teamtwo);
        $teamtwo_arr = mysqli_fetch_assoc($teamt);
        $st = $result_arr['stadium_id'];
        $stadium = "SELECT name FROM stadium where id = '$st' ";
        $stad = mysqli_query($db,$stadium);
        $stadium_arr = mysqli_fetch_assoc($stad);
        echo   '<td>'  . $teamone_arr['name'] . '</td>' . '<td>'  . $teamtwo_arr['name'] . '</td>' . '<td>' . $result_arr['date'] . '</td>' . '<td>'  . $stadium_arr['name']  . '</td>' . '<td>'  . $result_arr['cost'] . '</td>'. '<td>'  . $result_arr['password'] . '</td>'. '<td>'  .  '<form> <input type="text" name="num" placeholder="Введите кол-во билетов"><br><input type= "submit" value="Купить"></form>' . '</td>'. '</tr>' ;
    }

    echo '</table>';
    $num = htmlspecialchars(addslashes($_POST['num']));
    $query = "INSERT INTO `ticket` (`id`, `date`, `user_id`, `match_id`) VALUES ('$num', '$date') "
    ?>
</body>
</html>
<?php if ($_SESSION['type'] == 2) {?>
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
    <form method="post" action="">
        <select name="stad">
            <?php
            foreach (getStad() as $stad) {
                echo '<option value="' . $stad['id'] . '">' . $stad['name'] . '</option>';
            }
            ?>
        </select><br>
        <select name="team1">
            <?php
            foreach (getTeams() as $team) {
                echo '<option value="' . $team['id'] . '">' . $team['name'] . '</option>';
            }
            ?>
        </select><br>
        <select name="team2">
            <?php
            foreach (getTeams() as $team) {
                echo '<option value="' . $team['id'] . '">' . $team['name'] . '</option>';
            }
            ?>
        </select><br>
        <input type="date" name="date" placeholder="Введите дату матча"><br>
        <input type="text" name="cost" placeholder="Введите стоимость билета"><br>
        <input type= "submit" value="Отправить"> <br>

    </form>
    </main>
    </body>
    </html>
<?php

$stad= htmlspecialchars(addslashes($_POST['stad']));
$teaml= htmlspecialchars(addslashes($_POST['team1']));
$teamll= htmlspecialchars(addslashes($_POST['team2']));
$cost = htmlspecialchars(addslashes($_POST['cost']));
$date = htmlspecialchars(addslashes($_POST['date']));

    $query = "INSERT INTO `matches` (`stadium_id`, `team_id`, `team2_id`, `cost`, `date`) VALUES ('$stad', '$teaml', '$teamll', '$cost', '$date')";
mysqli_query($db, $query);
    $ghost = "SELECT * FROM matches ";

    $result = mysqli_query($db,$ghost);
    echo '<table border = "1" >'  . '<td>' . 'Команда 1'. '</td>' . '<td>' . 'Команда 2'. '</td>' . '<td>' . 'Дата матча'. '</td>'. '<td>' . 'Стадион'. '</td>'.'<td>'. ' Цена ' . '</td>'.  '</tr>';
    for ($i = 0; $i<mysqli_num_rows($result); $i++) {
        $result_arr = mysqli_fetch_assoc($result);
        $none = $result_arr['team_id'];
        $teamone = "SELECT name FROM team where id = '$none' ";
        $teamres = mysqli_query($db,$teamone);
        $teamone_arr = mysqli_fetch_assoc($teamres);
        $nane = $result_arr['team2_id'];
        $teamtwo = "SELECT name FROM team where id = '$nane' ";
        $teamt = mysqli_query($db,$teamtwo);
        $teamtwo_arr = mysqli_fetch_assoc($teamt);
        $st = $result_arr['stadium_id'];
        $stadium = "SELECT name FROM stadium where id = '$st' ";
        $stad = mysqli_query($db,$stadium);
        $stadium_arr = mysqli_fetch_assoc($stad);
        echo   '<td>'  . $teamone_arr['name'] . '</td>' . '<td>'  . $teamtwo_arr['name'] . '</td>' . '<td>' . $result_arr['date'] . '</td>' . '<td>'  . $stadium_arr['name']  . '</td>' . '<td>'  . $result_arr['cost'] . '</td>'. '<td>' . ' <p><a href = "matchedit.php?id={id}">РЕДАКТИРОВАТЬ</a></p>'  .'</td>' . '</tr>' ;
    }

    echo '</table>';
    ?>

<?php } ?>
