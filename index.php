<?php

// подключаем файл с настройками и хедер
require_once 'settings.php';
require_once 'inc/header.php';

// настраиваем подключение к БД
$link = mysqli_connect($hostname,$username,$password,$database);
mysqli_set_charset($link, "utf8");

// Если передана строка, сохраняем её в БД
if (isset($_POST['str']) && !empty($_POST['str'])) {
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $str = $_POST['str'];
    mysqli_query($link, "INSERT INTO strings (string,created_at) VALUES ('$str',now())");
}

// получаем из БД список строк и выаодим его
$query = 'SELECT string FROM strings ';
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result)) {
    echo '<b>В БД  записаны следующие строки:</b><br>';
}
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['string'].'<br>';
}

// подключаем футер
require_once 'inc/footer.php';