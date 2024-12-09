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
          <div class="border rounded">
              <div class="row">
                <div class="col-5"> <img src="./img/man.png" alt="" class="photo rounded-circle border w-100"></div>
                <div class="col-2"> </div>
                <div class="col-5"> 
                        <div class="border rounded mt-1 mr-1 text-center">Имя</div>
                        <div class="border rounded mt-1 mr-1 text-center">Фамилия</div>
                        <div class="border rounded mt-1 mr-1 text-center">Компания</div>
                    </div>
              </div>
              <div class="row">
                <div class="col-1"></div>
                <div class ="col-10 border rounded mt-2 text-center">+380631312876</div>
                <div class="col-1"></div>
                </div>
                <div class="row">
                <div class="col-1"></div>
                <div class ="col-10 border rounded mt-2 text-center">mailmail@gmail.com</div>
                <div class="col-1"></div>
                </div>
                <!--
                <div class="row mt-2">
                <div class="col-1"></div>
                <button class="col-4 btn btn-outline-danger" data-toggle="button" aria-pressed="false">Отклонить</button>
                <div class="col-2"></div>
                <button class="col-4 btn btn-outline-success" data-toggle="button" aria-pressed="false">Верифицировать</button>
                <div class="col-1"></div>
                </div>
-->
                <div class="row mt-4 mb-4">
                <div class="col-1"></div>
                    <div class="btn-group btn-group-toggle col-10" data-toggle="buttons" >
                    <label class="btn btn-outline-danger">
                        <input type="radio" name="options" id="option1"> Отклонить
                    </label>
                    <label class="btn btn-outline-success">
                        <input type="radio" name="options" id="option2"> Верифицировать
                    </label>
                    </div>
                    <div class="col-1"></div>
                </div>
          </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script>
        $().button('toggle')
    </script>
</body>

</html>