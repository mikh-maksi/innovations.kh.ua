 <?php
    include "../config.php";
    include "../connect.php";

    class course{
        var $id;
        var $name;
        var $description;
    }

    $crs = new course;
  //  $rcpts = [];
    $usrId = $_REQUEST['usrId'];

    $sql = 'SELECT * FROM courses';
     if ($result = $mysqli->query($sql)) { 
         while($row = $result->fetch_row() ){
            $crs = new course; 
            $crs->id = $row[0];
            $crs->name = $row[1];
            $crs->description = $row[2];
            $crss[]=$crs;
             } 
         $result->close(); 
     }
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json; charset=utf-8');
    
    echo json_encode($crss);
?>