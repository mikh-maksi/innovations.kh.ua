<?php
      header('Content-Type: text/html; charset=utf-8');
      include "../config.php";
      include "../connect.php";
      include "../functions.php";
       
      dbIn("TRUNCATE users",$mysqli); // ! Змінюємо на назву своєї таблиці
      dbIn("TRUNCATE usercompetitions",$mysqli); // ! Змінюємо на назву своєї таблиці
      
      $fp = fopen('csv/hse.csv', 'r');// ! Змінюємо на назву свого файлу
      $flag = -1; 		// ? це напевно номер поля в таблиці
      
      $yearOut = 0; 	// * Рік 
      $mounth = '';   // * Місяць
      $value = 0;     // * Значення
  
      
      // * Перебір таблиці відбувається проходом по строці а потім перехід на наступну
      if ($fp) {
          while (!feof($fp)) {
              $mytext = fgets($fp, 999);// * кількість полів які беруться з таблиці
              $flag++; // number of row
              if ($flag<2){ continue;} //Количество строчек, которые пропускаем.
              $mytext = iconv('windows-1251', 'utf-8', $mytext); // * Отримуэмо текст
              $mytext = str_replace(",", ".",$mytext ); // * переробля з 3.14  в 3,14 
              //  echo $mytext."<br><br>";
                $out = explode (";", $mytext); // * робить з '3,14;2.71' => ['3,14','2,71']
              print_r ($out);
              echo "<br><br>";
              echo $out[0]." ".$out[1]."<br><br>";

                $sql = "INSERT INTO users (`date`,`id`,`fio`,`email`,`tel`,`cv`,`school`,`photo`,`sertificate`,`comments`,`competitionType`)	VALUES('".$out[0]."',".$out[1].",'".$out[2]."','".$out[3]."','".$out[4]."','".$out[5]."','".$out[6]."','".$out[7]."','".$out[8]."','".$out[9]."','".$out[10]."');";
                dbIn($sql,$mysqli);
               

                $key = $out[10];
                echo  $out[10];
                switch ($key) {
                    case 'QA':
                        for($i=1;$i<=7;$i++){
                            $sql = "INSERT INTO usercompetitions (`userId`,`competitionId`,`value`)VALUES(".$out[1].",".$i.",'".$out[10+$i]."');";
                            echo $sql;
                            dbIn($sql,$mysqli);
                        }
                      break;
                        case 'JAVA':
                          for($i=1;$i<=7;$i++){
                              $sql = "INSERT INTO usercompetitions (`userId`,`competitionId`,`value`)VALUES(".$out[1].",".$i.",'".$out[10+$i]."');";
                              echo $sql;
                              dbIn($sql,$mysqli);
                          }
                        break;
                          case 'Python':
                            for($i=1;$i<=7;$i++){
                                $sql = "INSERT INTO usercompetitions (`userId`,`competitionId`,`value`)VALUES(".$out[1].",".$i.",'".$out[10+$i]."');";
                                echo $sql;
                                dbIn($sql,$mysqli);
                            }
                    break;
                   default:
                   
                  }
                


             
          echo "<br>";
            }
      } else { 
          echo "Ошибка при открытии файла";
          
      }
      
      fclose($fp);// * закриваємо доступ до файлу
      $mysqli->close();
  ?>
    <b>Новые записи добавлены успешно</b>
    <br> <a href = 'select.php'>Вернуться на страницу вывода данных</a>