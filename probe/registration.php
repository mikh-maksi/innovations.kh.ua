<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <label for="name">Имя:</label><input type="text" name="name" id="name_id"><br>
        <label for="name">Курс:</label><select name="course" id="course_id">
            <option value="1">Roblox</option>
        </select><br>
        <button id = "btn">Зарегистрироваться</button>
    </div>
    <div id="el"></div>
    <script>
var arr = [1,2,3,4];
var tel = '+380631312876';

var obj= {};
async function f(ob) {
    console.log(ob);
        let response = fetch('registration_back.php', {
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

function sndFnc(task_id){
    let element = document.getElementById("el");
    element.innerHTML = "green";
    console.log(element);
    element.classList.add("green");
    obj.name = name_id.value;
    obj.course_id = course_id.value;
    obj.task_id = task_id;
    let resp = f(obj);
    resp.then(onFulfilled);

}
function onFulfilled(dta){
    console.log("onFulfilled");
    console.log(dta);
}


btn.addEventListener("click",() => sndFnc(1));

        </script>
</body>
</html>