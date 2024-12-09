<?php 
    if (isset($_GET['type'])) $type = $_GET['type'];
    else $type = 0;
    $types[$type] = "underline";

?>
<aside class="col-xl-4 border mainaside">
                <div class="m-3">
                    <div class="row">
                        <div class="col-5"> <img src="./img/man.png" alt="" class="photo rounded-circle border"></div>
                        <div class="d-flex flex-column justify-content-center text-center border col-7 ">
                            <div><a href="">Фамилия Имя</a></div>
                            <div><a href="">lastname@gmail.com</a></div>
                        </div>
                    </div>

                    <a href="http://google.com" class="elem button btn btn-outline-primary col-12 mt-3">Профиль</a>

                    <a href="http://google.com" class="elem button btn btn-outline-primary col-12 mt-3">Мои студенты</a>
                    <h4 class="text-center mt-3">Подобрать студента</h4>
                    <a href="?type=1" class="elem button btn btn-outline-secondary col-12 mt-3  <?php echo $types[1];?>">QA</a>
                    <a href="?type=2" class="elem button btn btn-outline-secondary col-12 mt-3  <?php echo $types[2];?>">JS</a>
                    <a href="?type=3" class="elem button btn btn-outline-secondary col-12 mt-3  <?php echo $types[3];?>">Java</a>
                    <a href="?type=4" class="elem button btn btn-outline-secondary col-12 mt-3  <?php echo $types[4];?>">Python</a>

                </div>
            </aside>