<?php
header('Content-Type: text/html; charset=utf-8');
echo "����������qwerty123";
require_once 'login.php';
$conn = new mysqli($hm,$un,$pw,$db);   //�'�������� � ��
$conn->set_charset("1251");
if ($conn->connect_error) die ($conn->connect_error);
$query = "SELECT * FROM students";
$result = $conn->query($query);        //����������� ����� �� �� �� �������� �Ѳ ��� � ������� students
if (!$result) die ($conn->error);
$rows = $result->num_rows;             //��������� ������� ����� � ��
$name_file = "tmp/students.csv";
$file = fopen("$name_file",'w') or die ("�� ������� ������� ����!");   //���������\��������� csv ���� ��� ������ �����
if (flock($file,LOCK_EX))              //������� ������ �� �����, ���� ���� ��� �����
{
    for ($j = 0; $j < $rows; ++$j)     //���� ��� ������� �� ��� ������ �������
    {
        $result->data_seek($j);        //��������� �������� �� ����� $j
        $row = $result->fetch_array(MYSQLI_NUM); //������������ ����� � ����������� �����
        if (!fputcsv($file,$row,";")) echo "������� ������ �����!";  //������������ ����� �� ����� Exel
    }
    flock($file,LOCK_UN);              //������������ ����
}
$result->close();  //��������� ������������ ��'���
$conn->close();    //��������� ��'���� �'������� � ��
fclose($file);     //��������� ��'���� ������ � ������
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
        ����
    </a>
    <br><br>
    <input type="submit" value="Go to start_page" >
</form>
</body>
</html>
_END;
?>