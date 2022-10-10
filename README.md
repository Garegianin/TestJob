Выполнено с использованием mysql и OpenServer для бд.

БД называется - testjob1, а таблица - notebook.

1. SQL-файлы находятся в директории(папке) - sql
2. SQL-файл с заполненной бд - называется notebook.sql
3. SQL-файл с незаполненной бд - называется testjob1(empty).sql

Подключение к бд находиться в файле - config.php

Проверка index.php(с front-частью) в браузере была через Яндекс браузер.

Пагинация на сайте создаётся автоматически каждые 10 записей(11ая запись на новой странице). При использовании
запроса "http://testjob1/index.php?page=q" - (вместо "q" написать число) выводит на экран выбранную страницу(если
имеется).

Само API:

1. Функции находятся в директории(папке) - api в файле - json.php;
2. "Обращения" к функциям находятся в файле - func.php с 55 строки.

Проверка самого API - через Postman:

1. При использовании Get-запроса "http://testjob1/posts" - выводит на экран все записи в json формате;
2. При использовании Get-запроса "http://testjob1/posts/q" - (вместо "q" написать число) выводит на экран определённую(
   выбранное число) запись в json формате(если такой записи нет, выводит null);
3. При использовании Get-запроса "http://testjob1/str/q" - (вместо "q" написать число) выводит на экран записи
   определённой(выбранное число) страницы в json формате(если такой страницы нет, выводит null);
4. При использовании Post-запроса "http://testjob1/posts" - выводит на экран добавленную запись в json формате(если не
   введены FIO, Phone, Email или Birt введён в неправильном формате, то вылезет ошибка);
5. При использовании Delete-запроса "http://testjob1/posts/q" - (вместо "q" написать число) удаляет выбранную запись по
   номеру в списке(а не по id) и выводит на экран все остальные записи в json формате;
