<?php
header('Content-Type: text/html; charset=utf-8');
require_once "login.php";
$conn = new mysqli($hm, $un, $pw, $db);
$conn->set_charset("1251");
if ($conn->connect_error) die ($conn->connect_error);
if (isset($_FILES['file']))
{
    $file_name_tmp = $_FILES['file']['tmp_name'];
    if(is_uploaded_file($file_name_tmp))
    {
        switch ($_FILES['file']['type'])
        {
            case 'application/vnd.ms-excel' :
                $ext = 'scv';
                break;
            default :
                $ext = "";
                break;
        }
        $tmp = $_FILES['file']['type'];
        if (($ext == 'scv') && ($_FILES['file']['size']) <= 1000000)
        {
            $file_name = $_FILES['file']['name'];
            $file = save_file_to_uploads($file_name);
            $query = "DROP TABLE students";
            $conn->query($query);
            $query = "CREATE TABLE students(
                        id SMALLINT NOT NULL AUTO_INCREMENT,
                        surname VARCHAR (32) NOT NULL,
                        firstname VARCHAR (32) NOT NULL,
                        curs SMALLINT NOT NULL,
                        point FLOAT NOT NULL,
                        PRIMARY KEY (id)) ENGINE MyISAM";
            $conn->query($query);
                while (($row = fgetcsv($file, 1000, ';')) != false)
                {
                    if ((count($row)) == 5) {
                        $firstname = mysql_entities_fix_string($conn, $row[2]);
                        $surname = mysql_entities_fix_string($conn, $row[1]);
                        $curs = mysql_entities_fix_string($conn, $row[3]);
                        $point = mysql_entities_fix_string($conn, $row[4]);
                        $query = "INSERT INTO students(surname,firstname,curs,point) VALUES ('$surname','$firstname','$curs','$point')";
                        $conn->query($query);
                        $query = "ALTER TABLE students ADD FULLTEXT (surname,name)";
                        $conn->query($query);
                    }
                }
            fclose($file);
            $conn->close();
            }
    }
}
echo <<<_END
<form method="post" action="html_start_page.php">
    <input type="submit" value="Go to start_page" >
</form>
_END;


function mysql_entities_fix_string($conn, $string)
{
    return htmlentities(mysql_fix_string($conn, $string));
}
function mysql_fix_string($conn, $string)
{
    if (get_magic_quotes_gpc()) $string = stripcslashes($string);
    $string = strip_tags($string);
    return $conn->real_escape_string($string);
}
function save_file_to_uploads($file_name)
{
    $file_name = strtolower(mb_ereg_replace("[^A-Za-z0-9.]", "", $file_name));
    $file_name_array = str_split($file_name);
    for ($j = 0; $j < 4; ++$j)
    {
        array_pop($file_name_array);
    }
    $file_name_new = implode('',$file_name_array);
    $localtime_array = localtime();
    $localtime = $localtime_array[0]."_".$localtime_array[1]."_".$localtime_array[2]."_".$localtime_array[3]."_".$localtime_array[4]."_".($localtime_array[5]+1900);
    $file_name_new .= "_$localtime.csv";
    copy($_FILES['file']['tmp_name'],"uploads/".basename($file_name_new));
    return fopen("uploads/$file_name_new",'r+');
}
?>