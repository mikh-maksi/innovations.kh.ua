<?php
    if (isset($_GET["id"]))   $id = $_GET["id"];
    else $id =0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
    var arr = [1,2,3,4];
    var tel = '+380631312876';
    
    var obj= {};
    async function f(ob) {
        
            let response = fetch('https://innovations.kh.ua/probe/back/clients/', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify(ob)
            });
            let resp = await response;
            return resp;
        }
    let resp = f(obj);

    // resp.then(onFulfilled);
    resp.then( result => console.log( result));
    
        function onFulfilled(dta){
        // console.log("onFulfilled");
        console.log(dta);
    }
    console.log(resp);
    </script>
</body>
</html>