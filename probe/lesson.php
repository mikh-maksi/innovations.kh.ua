<?php
    if (isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];
    } else{
        $id = 0;
    }
    if (isset($_REQUEST['name'])){
        $name = $_REQUEST['name'];
    } else{
        $name = '';
    }
    echo $name;
    echo $id;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <h2>Задание №1</h2>
    <p>Описание задания №1</p>
    <button id = "btn1">Выполнено</button>

    <h2>Задание №2</h2>
    <p>Описание задания №2</p>
    <button id = "btn2">Выполнено</button>

    <h2>Задание №3</h2>
    <p>Описание задания №3</p>
    <button id = "btn3">Выполнено</button>
    <script>
    
        var arr = [1,2,3,4];
        var tel = '+380631312876';
        
        var obj= {};
        async function f(ob) {
            console.log(ob);
                fetch('lesson_back.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8'
                    },
                    body: JSON.stringify(ob)
                }).then(re => re.json())
                .then(function (quiz) {
                    console.log("---");
                    console.log(quiz);
                    console.log("---");
                    
                });
             return '';
            }

        //sndresFnc();
        function clck(){
            console.log("clck");
        }
    
        function onFulfilled(dta){
            console.log("onFulfilled");
            console.log(dta);
        }
    
    function sndFnc(task_id){
        console.log("btn"+task_id);
        let element = document.getElementById("btn"+task_id);
        element.classList.add("green");
        obj.name = "<?php echo $name;?>";
        obj.student_id = "<?php echo $id;?>";
        obj.task_id = task_id;
        let resp = f(obj);
        resp.then(onFulfilled);

    }
    function sndFnc2(){
        console.log("btn2");
        btn2.classList.add("green");
    }
    function sndFnc3(){
        console.log("btn3");
        btn3.classList.add("green");
    }

        btn1.addEventListener("click",() => sndFnc(1));
        btn2.addEventListener("click",() => sndFnc(2));
        btn3.addEventListener("click",() => sndFnc(3));
        </script>


</body>
</html>