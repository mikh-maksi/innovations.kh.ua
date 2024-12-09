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
        });
        let resp = await response;
        console.log(resp);
        return resp;
    }


function sndFnc(task_id){
    let element = document.getElementById("el");
    element.innerHTML = "green";
    console.log(element);
    element.classList.add("green");
    obj.name = "<?php echo $name;?>";
    obj.student_id = "<?php echo $id;?>";
    obj.task_id = task_id;
    let resp = f(obj);
    resp.then(onFulfilled);

}
function onFulfilled(dta){
    console.log("onFulfilled");
    console.log(dta);
}


btn.addEventListener("click",() => sndFnc(1));