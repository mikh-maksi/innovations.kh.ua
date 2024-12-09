<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<?php 
    if (isset($_GET['type'])) $type = $_GET['type'];
    else $type = 0;
    $typeNames[1] = "QA";
    $typeNames[2] = "JS";
    $typeNames[3] = "Java";
    $typeNames[4] = "Python";
?>

<body>
    <div class="container">
        <div class="row">
           <?php include "elements/aside.php" ?>
            <main class="col-xl-8 ">
                <?php include "elements/stat.php"?>
                <div class="row">
                <h1 class="text-center col-3"><?php echo $typeNames[$type]; ?></h1>
                <input type="text" placeholder = "фильтр" class="form-control mt-3 col-9">
                </div>
                
                <table class = "table table-bordered table-hover rounded text-center">
                    <tr>
                        <th>ID</th>    
                        <th>Общий</th>
                        <th>комп 1</th>
                        <th>комп 2</th>
                        <th>комп 3</th>
                        <th>комп 4</th>
                        <th>Дата сдачи</th>
                    </tr>
                    <tr>
                        <td><a href = "">ID</a></td>    
                        <td>70</td>
                        <td>50</td>
                        <td>80</td>
                        <td>80</td>
                        <td>70</td>
                        <td>28.02.20</td>
                    </tr>
                    <tr>
                        <td><a href = "">ID</a></td>    
                        <td>70</td>
                        <td>50</td>
                        <td>80</td>
                        <td>80</td>
                        <td>70</td>
                        <td>28.02.20</td>
                    </tr>
                    <tr>
                        <td><a href = "">ID</a></td>    
                        <td>70</td>
                        <td>50</td>
                        <td>80</td>
                        <td>80</td>
                        <td>70</td>
                        <td>28.02.20</td>
                    </tr>
                    <tr>
                        <td><a href = "">ID</a></td>    
                        <td>70</td>
                        <td>50</td>
                        <td>80</td>
                        <td>80</td>
                        <td>70</td>
                        <td>28.02.20</td>
                    </tr>
                </table>

              
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>