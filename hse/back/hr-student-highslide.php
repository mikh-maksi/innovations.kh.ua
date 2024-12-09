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
    <div class="conteiner col-4">
        <div class="border rounded d-flex">
            <div class="leftcol">
            <div class="col-10"><img src="./img/man.png" alt="" class="photo rounded-circle border col-12"></div>
                <div class="col-10 border text-center">ID</div>
                <div class="col-10 border text-center mt-2">ФИО</div>
                <div class="col-10 border text-center mt-2">20.02.20</div>

            </div>
            <div class="rightcol">
                <table class = "table-bordered table-hover rounded">
                    <tr>
                        <td>Общий</td>
                        <td>комп 1</td>
                        <td>комп 2</td>
                        <td>комп 3</td>
                        <td>комп 4</td>
                        <td>Дата сдачи</td>
                    </tr>
                    <tr>
                        <td>70</td>
                        <td>50</td>
                        <td>80</td>
                        <td>80</td>
                        <td>70</td>
                        <td>28.02.20</td>
                    </tr>
                </table>
                <div class="border rounded mt-2 text-center ">
                    Комментарии
                </div>
                <div class="border rounded mt-2 text-center ">
                    Заинтересованный HR
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <button class = "btn btn-sm btn-outline-secondary">Напомнить</button>
                    <button class = "btn btn-sm btn-outline-secondary">Удалить</button>
                    <button class = "btn btn-sm btn-outline-secondary">Переместить</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>