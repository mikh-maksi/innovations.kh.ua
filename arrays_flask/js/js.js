let question_arr = ["Согласно закону Оукэна, двухпроцентное превышение фактического уровня безработицы над его естественным уровнем означает, что отставание фактического объема ВВП от реального составляет:","Инфляция издержек развивается при:","Кривая, показывающая связь между уровнем безработицы и годовым темпом, роста цен — это:","Государственный долг—это:","Фискальная политика может быть:"]
let a1_arr = ["2%","умеренном росте объемов денежной массы","кривая Лоренца","задолженность населения, фирм, банков и зарубежных государств передправительством данной страны","стимулирующей"]
let a2_arr = ["4%","росте цен на ресурсы","кривая Лаффера"," задолженность правительства перед населением страны","сдерживающей"]
let a3_arr = ["3%","росте цен на потребительские товары и услуги","кривая Филлипса","задолженность правительства данной страны перед иностранными государствами","автоматической"]
let a4_arr = ["5%","снижении учетной ставки"," кривая спроса","задолженность правительства перед всеми хозяйствующими субъектами как данной страны, так и зарубежных стран","все ответы верны"]
let answer_arr = ["5%","росте цен на ресурсы","кривая Филлипса","задолженность правительства перед всеми хозяйствующими субъектами как данной страны, так и зарубежных стран","все ответы верны"]
let n_right_answer_arr = [4,2,3,4,4]
// let n_right_answer = 1;
let right_answers = 0;
let n_answer = 4;


right_answer_n = 0;

k = Number(n_question.value);
console.log(k);


point = 1;



btn.addEventListener("click", answers);


function answers(){
  query = 'https://mikhmaksi2.pythonanywhere.com/quiz';
  console.log(query);
  fetch(query).then(response => response.json())
  .then(function (quiz) {
    question.innerHTML=quiz.question_arr[0];
    title.innerHTML = quiz.title_arr[0];
    a1.innerHTML = quiz.a1_arr[0];
    a2.innerHTML = quiz.a2_arr[0];
    a3.innerHTML = quiz.a3_arr[0];
    a4.innerHTML = quiz.a4_arr[0];
    answer.innerHTML = quiz.answer_arr[0];
    
    n_right_answer = quiz.n_right_answer_arr[0];
    n_question.value = quiz.total_n;
    console.log(quiz);
      
  });
}

answers();

question.innerHTML=question_arr[n_question.value];
a1.innerHTML = a1_arr[n_question.value];
a2.innerHTML = a2_arr[n_question.value];
a3.innerHTML = a3_arr[n_question.value];
a4.innerHTML = a4_arr[n_question.value];
answer.innerHTML = answer_arr[n_question.value];

n_right_answer = n_right_answer_arr[n_question.value];
console.log(n_question.value)
btn.addEventListener("click", f_out);
btn1.addEventListener("click", f_out1);
btn2.addEventListener("click", f_out2);
  function f_out (){
        console.log(y1.checked);
        console.log(y2.checked);
        console.log(y3.checked);
        console.log(y4.checked);

        if (y1.checked){ n_a = 1;}
        if (y2.checked){ n_a = 2;}
        if (y3.checked){ n_a = 3;}
        if (y4.checked){ n_a = 4;}
        console.log(n_a);
        
        if (n_a == n_right_answer){
        right_answers += 1;
        right_div.classList.remove("hidden");
        wrong_div.classList.add("hidden");
        console.log("n_question.value = "+n_question.value);
        console.log("n_answer = "+n_answer);
        if (n_question.value == n_answer){
            btn2.classList.add("hidden");
            let el1 = document.createElement("p");
            el1.innerHTML = "<b>"+right_answers+"</b>";
            right_div.appendChild(el1);
        }
        }
        else{
        right_answers-=1;
        right_div.classList.add("hidden");
        wrong_div.classList.remove("hidden");
        }
  }
  function f_out1 (){
    answer.classList.toggle("hidden");
    btn1.classList.toggle("opend");
  }
  function f_out2 (){
    right_div.classList.add("hidden");
    k = Number(n_question.value);
    k+=1;
    n_question.value = k;
    console.log(n_question)
    question.innerHTML=question_arr[n_question.value];
    a1.innerHTML = a1_arr[n_question.value];
    a2.innerHTML = a2_arr[n_question.value];
    a3.innerHTML = a3_arr[n_question.value];
    a4.innerHTML = a4_arr[n_question.value];
    answer.innerHTML = answer_arr[n_question.value];
    
    n_right_answer =n_right_answer_arr[n_question.value];
    
  }