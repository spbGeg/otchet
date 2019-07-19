<?php

//$mysqli = new mysqli("127.0.0.1", "root", "","report");
//
//$mysqli->query("SET NAMES 'utf-8' ");
//$employees = $mysqli->query("SELECT * FROM 'employees' ORDER BY id");
//
//$mysqli->close();

$host = "127.0.0.1";
$user = 'root';
$pass = '';
$db_name = "report";
$link = mysqli_connect($host, $user, $pass, $db_name);

if(!$link){
    echo "Не могу сединиться с БД. Код ошибки: " . mysqli_connect_errno(). "Ошибка " . mysqli_connect_error();
    exit();
}
$sql_employees = mysqli_query($link, "SELECT * FROM employees ORDER BY employer");


$sql_timesheet = mysqli_query($link, "SELECT * FROM timesheet");

//while($timesheet = mysqli_fetch_array($sql)){
//    echo "Подчиненность: {$timesheet['employeeid']} Время: {$timesheet['time']} Дата: {$timesheet['date']}<br/>";
//}
//while ($employees = mysqli_fetch_array($sql)){
//    echo "Подчиненность {$employees['id']} Имя: {$employees['name']} email: {$employees['email']} Подчиненность: {$employees['employer']} Информация: {$employees['info']}<br/>";
//}

