<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="row">
           <?php include "elements/asidehr.php" ?>
            <main class="col-xl-8 ">
                <div class="row">
                    <div class="col-10"></div>
                    <button class = "btn btn-sm btn-outline-info col-2 ">Добавить</button>
                </div>       

                <div class="row">
                <div class="col-1"></div>
                <div class="col-10 d-flex justify-content-center statistics">
                <div class="btn-group btn-group-toggle col-10" data-toggle="buttons" >
                    <label class="btn btn-outline-dark">
                        <input type="radio" name="options" id="option1"> Интерес
                    </label>
                    <label class="btn btn-outline-warning">
                        <input type="radio" name="options" id="option2"> Собеседование
                    </label>
                    <label class="btn btn-outline-primary">
                        <input type="radio" name="options" id="option3"> Стажировка
                    </label>
                    <label class="btn btn-outline-success">
                        <input type="radio" name="options" id="option4"> Найм
                    </label>
                    </div>
                  
                </div>
                <div class="col-1"></div>
                </div>

                <div class = "row mt-3">
                <?php include "elements/student.php"; ?>
                <?php include "elements/student.php"; ?>
                <?php include "elements/student.php"; ?>
                <?php include "elements/student.php"; ?>
                <?php include "elements/student.php"; ?>
                </div>
                <div class="row">
                    
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>