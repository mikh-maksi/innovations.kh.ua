<?php
    header('Content-Type: text/html; charset=utf-8');
    include "config.php";
    include "connect.php";
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
</head>
<body>
    <?php 
    ?>
   <!-- <form action="back/fop.php" method="get">-->
    <div class="wrapper">
        <h2>Регистрация</h2>
        <table class = "table">
        <tr>
                <td>П.І.Б.</td>
                <td><input type="text" id = "name"></td>
            </tr>
            <tr>
                <td>Zoho Code</td>
                <td><input type="text" id = "inn"></td>
            </tr>
            <tr>
                <td>Вік дитини</td>
                <td><input type="text" id = "child_age" ></td>
            </tr>



            <tr>
                <td colspan = 2>  <button id ="send">Send</button>
                <!--<input type="submit" value = "send">-->
                </td>
            </tr>
        </table>
        <div id="output"></div>
        <!-- </form> -->

    </div>
</body>
</html>