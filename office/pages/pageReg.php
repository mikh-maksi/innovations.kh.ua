<?php
    include "configi.php";
    $mysqli = new mysqli($config['server'], $config['user'], $config['pass'], $config['db']);
    mysqli_set_charset ($mysqli,"utf8");
?>
<div class="wrapper">
        <h2>Регистрация</h2>
        <table class = "table">
            <tr>
                <td>Название</td>
                <td><input type="text" id = "name" value = "max">
                    <input type="hidden" name="id" value = "<?php echo $idid; ?>" id = "id">
                </td>
            </tr>
            <tr>
                <td>Организационная форма</td>
                <td>
                    <?php
                     $sql = "SELECT * FROM  business_types";
                     if (!$result = $mysqli->query($sql)) { echo "Ошибка: " . $mysqli->error . "\n";   exit;    }
                     echo "<select id = 'business_type'";
                     while ($row = $result->fetch_assoc()) {
                        printf ("<option value = %s>%s</option>", $row["id"], $row["name"]);
                    }
                    echo "</select>";
                    ?>        
                </td>
            </tr>
            <tr>
                <td>ІНН</td>
                <td><input type="text" id = "inn" value = 3132406950></td>
            </tr>

            <tr>
                <td>КВЕД</td>
                <td><input type="text" list = "kvedList" id = "kved">
                <datalist id="kvedList">
                <?php
                     $sql = "SELECT * FROM  kved_classes";
                     if (!$result = $mysqli->query($sql)) { echo "Ошибка: " . $mysqli->error . "\n";   exit;    }
                     while ($row = $result->fetch_assoc()) {
                        printf ("<option value = %s>%s</option>", $row["class"], $row["name"]);
                    }
                    ?>     
                </datalist> 
                    <button>+</button>
            </td>
            </tr>
            <tr>
                <td>Кол-во сотрудников</td>
                <td><input type="text" id = "nEmpl" value = 10></td>
            </tr>
            <tr>
                <td>Оборот</td>
                <td><input type="text" id  = "turnover" value = 10000></td>
            </tr>
            <tr>
                <td colspan = 2><button id ="send">Send</button>
                </td>
            </tr>
        </table>

           <script>
$('#send').on('click', function() {
    var name_data = $('#name').val();
    var id_data = $('#id').val();
    var business_type_data = $('#business_type').val();
    var inn_data = $('#inn').val();
    var kved_data = $('#kved').val();
    var nEmpl_data = $('#nEmpl').val();
    var turnover_data = $('#turnover').val();

    console.log(name_data);
    console.log(id_data);
    console.log(business_type_data);
    console.log(inn_data);
    console.log(kved_data);
    console.log(nEmpl_data);
    console.log(turnover_data);

    var form_data = new FormData();
    console.log( name_data);
    form_data.append('name',name_data);
    form_data.append('id',id_data);
    form_data.append('business_type',business_type_data);
    form_data.append('inn',inn_data);
    form_data.append('kved',kved_data);
    form_data.append('nEmpl',nEmpl_data);
    form_data.append('turnover',turnover_data);
   
    
    console.log(form_data);

    $.ajax({
                url: 'api/reg.php',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(php_script_response){
                 var res = JSON.parse(php_script_response)
                    console.log(res);
                }
     });
});
    </script>
    </div>
