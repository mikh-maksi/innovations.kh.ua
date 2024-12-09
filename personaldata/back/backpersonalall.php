 <?php
    include "../config.php";
    include "../connect.php";

    class user{
        var $name;
        var $lastname;
        var $picture;
        var $age;
        var $course;
        var $tel;
        var $email;
    }

    $usr = new user;
  //  $rcpts = [];
    $usrId = $_REQUEST['usrId'];

    $sql = 'SELECT * FROM users';
     if ($result = $mysqli->query($sql)) { 
         while($row = $result->fetch_row() ){
            $usr = new user; 
            $usr->id = $row[0];
            $usr->name = $row[1];
            $usr->lastname = $row[2];
            $usr->picture = $row[3];
            $usr->age = $row[4];
            $usr->course = $row[5];
            $usr->tel = $row[6];
            $usr->email = $row[7];
            $usr->datetime = $row[8];
            $usrs[]=$usr;
             } 
         $result->close(); 
     }
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json; charset=utf-8');
    
    echo json_encode($usrs);
?>