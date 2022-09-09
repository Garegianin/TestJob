<?php
function jsonr()//вывод всего
{
    header('Content-type: application/json');
    require 'config.php';
    $i = 0;
    $result1 = mysqli_query($conn, "SELECT * FROM `notebook`");// Запрос и вывод записей

    while ($row = mysqli_fetch_assoc($result1)) {
        $i += 1;
        if (substr((string)$i, -1) == '1') {
            if ((int)(substr((string)$i, -2)) >= 2) {
                $j += 1;
            }
        }
        $posts = array(
            'idNotebook' => $row['idNotebook'],
            'FIO' => $row['FIO'],
            'Company' => $row['Company'],
            'Phone' => $row['Phone'],
            'Email' => $row['Email'],
            'Birth' => $row['Birth'],
            'Photo' => 'Есть проблемы с форматом blob'//$row['Photo'] //из-за неподходящих токенов при перекодировании изображения в blob эти данные нельзя записать в массив
        );
        $idf[$i] = $posts;
    };

    http_response_code(200);// устанавливаем код ответа - 200 OK
    die(json_encode($idf));

}

function getpost($id)//вывод 1
{
    header('Content-type: application/json');
    require 'config.php';
    $id1 = $id - 1;
    $result2 = mysqli_query($conn, "SELECT * FROM `notebook` limit " . $id1 . ",1");// Запрос и вывод записи
    while ($row = mysqli_fetch_assoc($result2)) {
        $posts = array(
            'idNotebook' => $row['idNotebook'],
            'FIO' => $row['FIO'],
            'Company' => $row['Company'],
            'Phone' => $row['Phone'],
            'Email' => $row['Email'],
            'Birth' => $row['Birth'],
            'Photo' => 'Формат blob не хочет быть utf8_general_ci, а json так не хочет его принимать'//$row['Photo'] //из-за неподходящих токенов при перекодировании изображения в blob эти данные нельзя записать в массив
        );
        $idf[$id] = $posts;
    };
    http_response_code(200);// устанавливаем код ответа - 200 OK
    die(json_encode($idf));
}


function getstr($page)//вывод всего с определённой страницы
{
    header('Content-type: application/json');
    require 'config.php';


    $art = ($page * 10) - 10;//начальная запись на странице
    $result1 = mysqli_query($conn, "SELECT * FROM `notebook` LIMIT " . $art . "," . 10);// Запрос и вывод записей
    if ($art != 0) {
        $i = $art;
    } else {
        $i = 1;
    }

    while ($row = mysqli_fetch_assoc($result1)) {
        $posts = array(
            'idNotebook' => $row['idNotebook'],
            'FIO' => $row['FIO'],
            'Company' => $row['Company'],
            'Phone' => $row['Phone'],
            'Email' => $row['Email'],
            'Birth' => $row['Birth'],
            'Photo' => 'Есть проблемы с форматом blob'//$row['Photo'] //из-за неподходящих токенов при перекодировании изображения в blob эти данные нельзя записать в массив
        );
        $idf[$i] = $posts;
        $i += 1;
    };
    http_response_code(200);// устанавливаем код ответа - 200 OK
    die(json_encode($idf));
}



function addPost($data)//ввод
{
    header('Content-type: application/json');
    require 'config.php';
    $res = mysqli_query($conn, "SELECT COUNT(*) FROM `notebook`");
    $row = mysqli_fetch_row($res);
    $total = $row[0] + 1; // всего записей
    $FIO = $data['FIO'];
    $Company = $data['Company'];
    $Phone = $data['Phone'];
    $Email = $data['Email'];
    $Birth = $data['Birth'];
    if ($FIO != null && $Phone != null && $Email != null) {
        if ($Birth != null) {
            if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $Birth) != false) {

                http_response_code(200);// устанавливаем код ответа - 200 OK
                die('Birth неверного формата');
            } else {
                $conn->query("INSERT INTO `notebook` (`FIO`, `Company`, `Phone`, `Email`,`Birth`) VALUES 
                                                                                            ('$FIO', '$Company','$Phone', '$Email', 
                                                                                             '$Birth')");
                getpost($total);

            }
        } else {
            $conn->query("INSERT INTO `notebook` (`FIO`, `Company`, `Phone`, `Email`,`Birth`) VALUES 
                                                                                            ('$FIO', '$Company','$Phone', '$Email', 
                                                                                             '$Birth')");
            getpost($total);
        }
    } else {
        http_response_code(200);// устанавливаем код ответа - 200 OK
        die('Обязательные данные(FIO, Phone, Email) не введены');
    }
}

function DELETE($id)//вывод 1
{
    header('Content-type: application/json');
    require 'config.php';
    $id1 = $id - 1;
    $result2 = mysqli_query($conn, "SELECT * FROM `notebook` limit " . $id1 . ",1");// Запрос и вывод записи
    $row = mysqli_fetch_assoc($result2);
    $ids = $row['idNotebook'];
    $conn->query("DELETE FROM `notebook` WHERE `idNotebook` = '$ids'");
    jsonr();
}