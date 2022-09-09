<?php
include 'config.php';
require 'api/json.php';

$idNotebook = $_POST['idNotebook'];
$FIO = $_POST['FIO'];
$Company = $_POST['Company'];
$Phone = $_POST['Phone'];
$Photo = $_POST['Photo'];
$Email = $_POST['Email'];
$Birth = $_POST['Birth'];


//header('Content-Type: application/json');

//Вывод
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
};
$col = 10;  // количество записей на 1 странице
$art = ($page * $col) - $col;//начальная запись на странице
// Определяем все количество записей в таблице
$res = mysqli_query($conn, "SELECT COUNT(*) FROM `notebook`");
$row = mysqli_fetch_row($res);
$total = $row[0]; // всего записей
$str_pag = ceil($total / $col);// Количество страниц
$result1 = mysqli_query($conn, "SELECT * FROM `notebook` LIMIT " . $art . "," . $col);// Запрос и вывод записей
$prod = mysqli_fetch_assoc($result1);


// Добавление
if (isset($_POST['submit1'])) {
    $img_type = substr($_FILES['Photo']['type'], 0, 5);
    $img_size = 16 * 1024 * 1024;

    if (!empty($_FILES['Photo']['tmp_name']) and $img_type === 'image' and $_FILES['Photo']['size'] <= $img_size) {
        $img = addslashes(file_get_contents($_FILES['Photo']['tmp_name']));
    } else {
        $img = 'Ошибка файла';
    }
    $conn->query("INSERT INTO `notebook` (`FIO`, `Company`, `Phone`, `Email`,`Birth`, `Photo`) VALUES 
                                                                                            ('$FIO', '$Company','$Phone', '$Email', 
                                                                                             '$Birth', '$img')");
    echo '<script> document.location.href="index.php"</script> ';
}

// Удаление
if (isset($_POST['delete_submit'])) {
    $conn->query("DELETE FROM `notebook` WHERE `idNotebook` = '$idNotebook'");
}


//Обращение json
$method = $_SERVER['REQUEST_METHOD'];
$q = $_GET['q'];
$params = explode('/', $q);
$type = $params[0];
$id = $params[1];

if ($method === 'GET') {
    if ($type === 'posts') {
        if (isset($id)) {
            getpost($id);
        } else {
            jsonr();
        }
    } elseif ($type = 'str') {
        if (isset($id)) {
            getSTR($id);
        }
    }
} elseif ($method === 'POST') {
    if ($type === 'posts') {
        addPost($_POST);
    }
} elseif ($method === 'DELETE') {
    if ($type === 'posts') {
        if (isset($id)) {
            DELETE($id);
        }
    }
}


