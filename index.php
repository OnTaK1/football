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
    <form method="get" action="">
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
    </body>
    </html>
<?php

$stad= htmlspecialchars(addslashes($_GET['stad']));
$teaml= htmlspecialchars(addslashes($_GET['team1']));
$teamll= htmlspecialchars(addslashes($_GET['team2']));
$cost = htmlspecialchars(addslashes($_GET['cost']));
$date = htmlspecialchars(addslashes($_GET['date']));

    $query = "INSERT INTO `matches` (`stadium_id`, `team_id`, `team2_id`, `cost`, `date`) VALUES ('$stad', '$teaml', '$teamll', '$cost', '$date')";
mysqli_query($db, $query);
$ghost = "SELECT * FROM matches ";
$result = mysqli_query($db,$ghost);
echo '<table border = "1" >'  . '<td>' . 'Стадион'. '</td>' . '<td>' . 'Команда 1'. '</td>' . '<td>' . 'Команда 2'. '</td>'. '<td>' . 'Стоимость'. '</td>'.'<td>'. ' Дата ' . '</td>' .  '</tr>';
for ($i = 0; $i<mysqli_num_rows($result); $i++) {
    $result_arr = mysqli_fetch_assoc($result);
    echo   '<td>'  . $result_arr['stadium_id'] . '</td>' . '<td>'  . $result_arr['team_id'] . '</td>' . '<td>' . $result_arr['team2_id'] . '</td>' . '<td>'  . $result_arr['cost']  . '</td>' . '<td>'  . $result_arr['date'] . '</td>'. '<td>' .' <p><a href = "useredit.php?id={id}">РЕДАКТИРОВАТЬ</a></p>'  .'</td>' . '</tr>' ;
}

echo '</table>';
?>

<?php } ?>
