
<?php
$db = mysqli_connect('localhost', 'football', 'football123', 'football');
if (mysqli_connect_errno()) {
    die('Ошибка подключния к базе');
} else {
    mysqli_query($db, "SET NAMES'utf8'");
}