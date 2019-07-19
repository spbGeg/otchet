<?php

// преобразуем массив с персоналом из БД в ассоциативный
$i = 0;
$arr_personal = [];
while ($employees = mysqli_fetch_array($sql_employees)) {
    $arr_personal[$i]['id'] = $employees['id'];
    $arr_personal[$i]['name'] = $employees['name'];
    $arr_personal[$i]['email'] = $employees['email'];
    $arr_personal[$i]['employer'] = $employees['employer'];
    $arr_personal[$i]['info'] = $employees['info'];
    $i++;
    }
print_r($arr_personal);
echo "<br/>";
// преобразуем массив со временем из БД в ассоциативный
$arr_timesheet = [];
$i = 0;
while($timesheet = mysqli_fetch_array($sql_timesheet)){

    $arr_timesheet[$i]['employeeid'] = $timesheet['employeeid'];
    $arr_timesheet[$i]['time'] = $timesheet['time'];
    $arr_timesheet[$i]['date'] = $timesheet['date'];
    $i++;
}



// складываем время работы сотрудников
print_r($arr_timesheet);
//создаем финальный массив для подсчета и внесения в него всех часов сотрудника
$arr_timesheet_count = [];
for($i = 0; $i< count($arr_timesheet); $i++) {
    if ($arr_timesheet[$i]['count'] != "count") {
        echo "<br/>Count не существует <br/>";
            $arr_timesheet_count[$i] = $arr_timesheet[$i];
            // задаем параметр данный индекс посчитан
            $arr_timesheet[$i]['count'] = "count";
            //преобразовали время в секунды
            $sec = explode(":", $arr_timesheet[$i]['time']);
        $arr_timesheet_count[$i]['time'] = $sec[0] * 3600 + $sec[1] * 60 + $sec[2];
            //пробегаем по массиву ищем совпадение по employeeid
            for ($j = 0; $j < count($arr_timesheet); $j++) {
                if ($arr_timesheet_count[$i]['employeeid'] == $arr_timesheet[$j]['employeeid'] && $arr_timesheet[$j]['count'] != "count") {
                    $arr_timesheet[$j]['count'] = "count";
                    $sec = explode(":", $arr_timesheet[$j]['time']);
                    $arr_timesheet_count[$i]['time'] += $sec[0] * 3600 + $sec[1] * 60 + $sec[2];

                    echo "Прибавили <br/>";
                }
            }

        } else {
        echo "Count существует <br/>";
        continue;
        }



    echo " Время сотрудника {$arr_timesheet_count[$i]['employeeid']} равно: {$arr_timesheet_count[$i]['time']}";


}

// переводим секунды с часы минуты секунды
function timeConverter($time) {
    $sec = $time % 60;
    if (strlen($sec) == 1) $sec = '0' . $sec;
    $time = floor($time / 60);
    $min = $time % 60;
    if (strlen($min) == 1) $min = '0' . $min;
    $time = floor($time / 60);
    if (strlen($time) == 1) $time = '0' . $time;
    $time = $time . ":" . $min . ":" . $sec;
    return $time;
}

// проверка на недоработку


?>