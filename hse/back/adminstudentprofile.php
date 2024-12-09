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
           <?php include "asidehr.php" ?>
            <main class="col-xl-8 ">
                <div class="row">
                    <div class="col-6 text-center"><img src="./img/man.png" alt="" class="photo rounded-circle border w-50"></div>
                    <div class = "col-6">
                        <div class="col-12 border rounded mt-3">Контактная информация: имя, номер телефона</div>
                        <div class="col-12  border rounded mt-5">Дата сдачи</div>
                    </div>
                </div>       

                <div class="row mt-3">
                <div class="col-1"></div>
                <div class="col-10 d-flex justify-content-center statistics  border rounded">
                <h2>Результаты тестирования</h2>
                  
                </div>
                <div class="col-1"></div>
                </div>


                <div class = "row mt-3">
                <table class = "table table-bordered table-hover rounded text-center">
                    <tr>
                        <th>Общий</th>
                        <th>комп 1</th>
                        <th>комп 2</th>
                        <th>комп 3</th>
                        <th>комп 4</th>
                        <th>Дата сдачи</th>
                    </tr>
                    <tr>
                        <td>70</td>
                        <td>50</td>
                        <td>80</td>
                        <td>80</td>
                        <td>70</td>
                        <td>28.02.20</td>
                    </tr>
                </table> </div>
                <div class="row">
                      <div class="col-1"></div>
                     <div class="col-10 border rounded text-center">
                     История действия со студентом
                  
                     </div>
                <div class="col-1"></div>
                </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>