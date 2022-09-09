<?php
include 'func.php';

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Notebook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
          integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col mt-1">
            <button class="btn btn-success mb-1" data-toggle="modal" data-target="#Modal1"><i
                        class="fa fa-user-plus"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <table class="table shadow, table-active, table-striped">
                <thead class="table-dark">
                <tr style="text-align: center">
                    <th>ФИО</th>
                    <th>Компания</th>
                    <th>Телефон</th>
                    <th>Email</th>
                    <th>День рождения<br>(гггг-мм-дд)</th>
                    <th>Фото</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                <?php
                require_once 'func.php';

                // формируем пагинацию
                if ($str_pag > 1) {
                    echo "Страницы: ";
                    for ($i = 1; $i <= $str_pag; $i++) {
                        echo "<a href=?page=" . $i . "> " . $i . " </a>";
                    }
                }
                do {
                    echo "<tr style='text-align: center;height: 64px;'>";
                    echo "<td>" . $prod['FIO'] . "</td>";
                    echo "<td>" . $prod['Company'] . "</td>";
                    echo "	<td>" . $prod['Phone'] . "</td>";
                    echo "	<td>" . $prod['Email'] . "</td>";
                    echo "	<td>" . $prod['Birth'] . "</td>";
                    echo "	<td>";
                    echo '<img src = "data:image/jpeg;base64,' . base64_encode($prod['Photo']) . '" height = "50px">';
                    echo "</td>";
                    echo "<td>";
                    echo '<a href="?delete=' . $prod["idNotebook"] . '" class="btn btn-danger btn-sm" data-toggle="modal" 
					            data-target="#deleteModal' . $prod["idNotebook"] . '"><i class="fa fa-trash" ></i></a> ';
                    ?>
                    <!-- DELETE MODAL -->
                    <div class="modal fade" id="deleteModal<?= $prod['idNotebook'] ?>" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content shadow">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Удалить запись</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5>&quot;<?= $prod['FIO'] ?>&quot;</h5>
                                </div>
                                <div class="modal-footer">
                                    <br>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                                    <form action="?id<?= $prod['idNotebook'] ?>" method="post">
                                        <div hidden>
                                            <input type="text" class="form-control" name="idNotebook"
                                                   value="<?= $prod['idNotebook'] ?>">
                                        </div>
                                        <button type="submit" name="delete_submit" class="btn btn-danger">Удалить
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    echo " </td>";
                    echo " </tr>";
                } while ($prod = mysqli_fetch_assoc($result1)); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="Modal1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title">Добавить запись</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="func.php" method="post" enctype="multipart/form-data">
                    <div>
                        <i style="color: orange">*</i><i style="color: gray"> - обязательно для заполнения</i><br>
                    </div>
                    <div class="form-group">
                        <i style="color: orange">*</i> ФИО<input type="text" class="form-control" name="FIO" value=""
                                                                 required="required"
                                                                 placeholder="ФИО">
                    </div>
                    <br>
                    <div class="form-group">
                        &nbsp;Компания<input type="text" class="form-control" name="Company" value=""
                                             placeholder="Компания">
                    </div>
                    <br>
                    <div class="form-group">
                        <i style="color: orange">*</i> Телефон(формата: 8**********)<input type="tel"
                                                                                           class="form-control"
                                                                                           name="Phone" value=""
                                                                                           pattern="8[0-9]{10}"
                                                                                           required="required"
                                                                                           placeholder="8**********">
                    </div>
                    <br>
                    <div class="form-group">
                        <i style="color: orange">*</i> Email<input type="email" class="form-control" name="Email"
                                                                   value="" required="required"
                                                                   placeholder="Email">
                    </div>
                    <br>
                    <div class="form-group">
                        &nbsp;День рождения: <input type="date" class="form-control" name="Birth" value=""
                                                    placeholder="День рождения">
                    </div>
                    <br>
                    <div class="form-group">
                        &nbsp;Фото(до 16Мб): <input type="file" name="Photo">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>

                        <button type="submit" name="submit1" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
            integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
            integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
            crossorigin="anonymous"></script>
</body>
</html>
