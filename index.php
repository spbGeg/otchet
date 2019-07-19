<?php require_once "admin/db.php" ?>
<?php require_once "admin/report.php" ?>
<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
    <link rel="stylesheet" href="css/bootstrap.css">

    <link rel="stylesheet" href="css/main.css" type="text/css">
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.js"> </script>

    <title>Форма учета рабочего времени</title>
</head>
<body>

<div class="main container">
    <div class="gitLink"><img src="img/github-logo.png" alt=""><a href="#">Ссылка на репозиторий</a></div>
    <h1 class="text-center">Форма учета рабочего времени</h1>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="poster">
                <div class="descr">
                    Какой-то текст который должен быть в блоке<br>
                    <a href="#">Интересная ссылка</a>
                </div>
            </div>
            <table class="otchet">
                <tr>
                    <th style="width: 10%">№п/п</th>
                    <th style="width: 20%">Иерархия подчиненности</th>
                    <th>Кол-во своих часов за период</th>
                    <th>Кол-во своих + подчиненных часов за период</th>
                    <th style="width: 10%">Email</th>
                    <th style="whidth: 20%">Недоработка</th>
                </tr>
                <?php

                for ($j = 0; $j < count($arr_personal); $j++) {
                    echo "<tr>
                            <td> {$arr_personal[$j]['id']}</td> ";
                        echo "<td>";
                        if($arr_personal[$j]['employer'] == 0) echo "-";
                         else echo $arr_personal[$j]['employer'];
                    echo "</td>";
                    // вывод суммы всех часов сотрудника
                    echo "<td>";
                    for ($i = 0; $i < count($arr_timesheet_count); $i++) {
                        if ($arr_personal[$j]['id'] == $arr_timesheet_count[$i]['employeeid']) {
                            $time = $arr_timesheet_count[$i]['time'];
                            $time = timeConverter($time);
                            echo $time;
                        }
                    }

                    echo "</td>";
                    //вывод всех часо сотрудника + часов подчиненных
                    echo "<td>";
                    $time_all_employer = 0;
                    for ($i = 0; $i < count($arr_timesheet_count); $i++) {
                        if ($arr_personal[$j]['id'] == $arr_timesheet_count[$i]['employeeid']) {
                            $time_all_employer += $arr_timesheet_count[$i]['time'];
                        }
                        if ($arr_personal[$j]['id'] == $arr_personal[$i]['employer']) {
                            $time_all_employer += $arr_timesheet_count[$i]['time'];
                        }

                    }
                    if ($time_all_employer) {
                        $time_all_employer = timeConverter($time_all_employer);
                        echo $time_all_employer;
                        $time_all_employer = 0;
                    }
                    echo "</td>";
                    $email = $arr_personal[$j]['email'];
                    if (preg_match('/^((([0-9A-Za-zА-Яа-я]{1}[-0-9A-zА-Яа-я\.]{1,}[0-9A-Za-zА-Яа-я]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-zА-Яа-я]{1,}\.){1,2}[-A-Za-zА-Яа-я]{2,})$/u', $email))
                    {
                        echo "<td> $email </td>";
                    }else echo "<td style='color: #ff0000;'> $email </td>";

                    echo "
                            <td></td>
                          </tr>";
                } ?>

            </table>
        </div>
        <div class="col-lg-2"></div>
        <?php require_once "admin/report.php" ?>
        <?php

        echo $sec;
        echo "<br/>";

        print_r($arr_timesheet);

        ?>

    </div>


</div>
<?php mysqli_close($link) ?>
</body>
</html>