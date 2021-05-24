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
<?php
require ('database.php');
if (count($_POST) > 0) {
    updateMatch();
}
function getMatchById(): void
{
    global $db;
    $id = htmlspecialchars(addslashes($_GET['id']));
    if (!empty($id)) {
        $result = mysqli_query($db, "SELECT * FROM matches WHERE id = " . $id);
        if((mysqli_num_rows($result)) > 0) {
            $match = mysqli_fetch_assoc($result);
        } else {
            die ("Матч не найден");
        }


    }  else {
        die('Не задан id матча');
    }

}
if (count($_POST) > 0) {
    updateMatch();
}
function updateMatch():void {
    global $id;
    global $db;
    $id = htmlspecialchars(addslashes($_GET['id']));
    $stad= htmlspecialchars(addslashes($_GET['stad']));
    $teaml= htmlspecialchars(addslashes($_GET['team1']));
    $teamll= htmlspecialchars(addslashes($_GET['team2']));
    $cost = htmlspecialchars(addslashes($_GET['cost']));
    $date = htmlspecialchars(addslashes($_GET['date']));
    if(!empty($stad) && !empty ($teaml) && !empty($teamll) && !empty($cost) && !empty($date));
    {
        $query = "UPDATE matches SET name = '$stad', surname = '$teaml', date = '$teamll', phone = '$cost', email = '$date' WHERE id = " . $id;
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
</main>
</body>
</html>
