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
           <?php include "elements/aside.php" ?>
            <main class="col-xl-6 ">
                <h1 class="text-center">Регистрация</h1>
                <input type="text" placeholder="ФИО" class="form-control mt-3" id = "name">
                <input type="text" placeholder="Компания" class="form-control mt-3" id = "company">
                <div class="custom-file mt-3">
                    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Фото</label>
                </div>
                <input type="text" placeholder="Телефон" class="form-control mt-3" id = "tel">
                <input type="email" placeholder="email" class="form-control mt-3" id = "email">
                <input type="password" placeholder="Пароль" class="form-control mt-3" id = "password">
                <button type="button" class="btn btn-primary btn-block mt-3" id = "btnreg">Зарегистрироваться</button>
            </main>
        </div>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script>
    $('#btnreg').on('click', function() {
    var file_data = $('#inputGroupFile01').prop('files')[0];
    var nameVal = $('#name').val();
    var companyVal = $('#company').val();
    var telVal = $('#tel').val();
    var emailVal = $('#email').val();
    var passwordVal = $('#password').val();

    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('name', nameVal);
    form_data.append('company', companyVal);
    form_data.append('tel', telVal);    
    form_data.append('email', emailVal);
    form_data.append('password', passwordVal);

    console.log(form_data);
    jQuery.ajax({
                url: '/hse/back/uploadReg.php',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(php_script_response){
                    console.log(php_script_response);
                   // $('#comments').val('');
                   // $('#counter').val('');
                   // $('#picture').val('');
                }
     });
});
</script>
</body>

</html>