var obj= {};
async function f(ob) {
        let response = fetch('https://innovations.kh.ua/aspirin/request/', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(ob)
        });
        let resp = await response;
        return resp;
    }


function sndresFnc(slug,text ){
    obj.slug =  slug ;
    obj.text = text;
    let resp = f(obj);
    console.log(resp);
    console.log(obj);
}


function idea_save_fnc(){
    text_out = document.getElementById("idea").value
    sndresFnc("idea_save",text_out);
}

idea_save.addEventListener("click",idea_save_fnc);

answers();
function answers(){
    query = 'https://innovations.kh.ua/aspirin/info/';
    console.log(query);
    fetch(query).then(response => response.json())
    .then(function (quiz) {
    //     question.innerHTML=quiz.question_arr[0];
    //   title.innerHTML = quiz.title_arr[0];
    //   a1.innerHTML = quiz.a1_arr[0];
    //   a2.innerHTML = quiz.a2_arr[0];
    //   a3.innerHTML = quiz.a3_arr[0];
    //   a4.innerHTML = quiz.a4_arr[0];
    //   answer.innerHTML = quiz.answer_arr[0];
      
    //   n_right_answer = quiz.n_right_answer_arr[0];
    //   n_question.value = quiz.total_n;
      console.log(quiz);
        
    });
  }