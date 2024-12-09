<?php 
    if (isset($_GET['admin'])) $admin = $_GET['admin'];
    else $admin = 0;
    $admins[$admin] = "underline";

?>
<aside class="col-xl-4 border mainaside">
                <div class="m-3">    
                    <a href="?admin=1" class="elem button btn btn-outline-secondary col-12 mt-3  <?php echo $admins[1];?>">HR</a>
                    <a href="?admin=2" class="elem button btn btn-outline-secondary col-12 mt-3  <?php echo $admins[2];?>">Студенты</a>
                    <a href="?admin=3" class="elem button btn btn-outline-secondary col-12 mt-3  <?php echo $admins[3];?>">Баланс</a>
                </div>
            </aside>