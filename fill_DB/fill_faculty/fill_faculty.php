<?php
if (isset($_POST['query_type']))
{
    if ($_POST['query_type'] == "fill_faculty")
    {
        $HN = 'innova14.mysql.ukraine.com.ua';
        $DB = 'innova14_rating';
        $UN = 'innova14_rating';
        $PW = '6693';

        $conn = new mysqli($HN, $UN, $PW, $DB);

        $faculty = $_POST['faculty'];
        $specialty = $_POST['specialty'];
        $group_original = $_POST['group'];

        $report = 0;
        for ($course = 1; $course < 5; ++$course)
        {
            $group = str_replace("*",$course,$group_original);

            $query = "INSERT INTO site_data_sort_stud (faculty,course,specialty,groupp) VALUES ('$faculty','$course','$specialty','$group')";
            $result = $conn->query($query);

            if (($result == 1) && empty($conn->error))
            {
                ++$report;
            }
            else
            {
                echo "error create course (".$course.") : ".$conn->error;
                exit;
            }
        }

        if ($report == 5)
        {
            echo "200";
            exit;
        }
        else
        {
            echo $conn->error;
            exit;
        }
    }
}
else
{
    include_once "fill_faculty.html";
}

include_once "fill_faculty.html";

?>