<?php
header('Content-Type: text/html; charset=utf-8');
echo "йцукенгшщзqwerty123";
require_once 'login.php';
$conn = new mysqli($hm,$un,$pw,$db);   //з'єднуємося з БД
$conn->set_charset("1251");
if ($conn->connect_error) die ($conn->connect_error);
$query = "SELECT * FROM students";
$result = $conn->query($query);        //відправляємо запит до БД та витягуємо ВСІ дані з таблиці students
if (!$result) die ($conn->error);
$rows = $result->num_rows;             //визначаємо кількість рядків у БД
$name_file = "tmp/students.csv";
$file = fopen("$name_file",'w') or die ("Не вдалося відкрити файл!");   //створюємо\відкриваємо csv файл для запису даних
if (flock($file,LOCK_EX))              //блокуємо доступ до файлу, поки буде йти запис
{
    for ($j = 0; $j < $rows; ++$j)     //цикл для проходу по всім рядкам таблиці
    {
        $result->data_seek($j);        //переміщаємо вказівник на рядок $j
        $row = $result->fetch_array(MYSQLI_NUM); //перетворюємо рядок у нумерований масив
        if (!fputcsv($file,$row,";")) echo "Помилка запису даних!";  //перетворюємо масив на рядок Exel
    }
    flock($file,LOCK_UN);              //розблоковуємо файл
}
$result->close();  //закриваємо результуючий об'єкт
$conn->close();    //закриваємо об'єект з'єднання з БД
fclose($file);     //закриваємо об'єект роботи з файлом
echo <<<_END
<!DOCTYPE html>
<html lang="ukr">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>download_csv</title>
</head>
<body>
<form method="post" action="html_start_page.php">
    <a href="tmp/students.csv">
        Файл
    </a>
    <br><br>
    <input type="submit" value="Go to start_page" >
</form>
</body>
</html>
_END;
?>