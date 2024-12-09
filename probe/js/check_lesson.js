
function lesson (){
    query = 'https://innovations.kh.ua/probe/back/lesson_actions/index.php?lesson_id=1';
    console.log(query);
    fetch(query).then(response => response.json())
    .then(function (quiz) {
        wrapper.innerHTML = '';
     console.log(quiz);
     console.log(quiz.arr);    
    var actions_arr = [[]];
    var student_id_arr = [];
    var task_id_arr=[];
    quiz.arr.forEach( function(currentValue, index, arr ){
        let elem = document.createElement("div");
        console.log(quiz.arr);
        elem.classList = 'line';
        elem.innerHTML = "Elements";
        currentValue.forEach( function(currentValue1, index, arr ){
            
            console.log(index,currentValue1);
            let elem1 = document.createElement("div");

            elem1.innerHTML=currentValue1 ;
            if (currentValue1 =='0'){
             elem1.classList = 'd red';
            } else {
                elem1.classList = 'd green';
            }
            elem.appendChild(elem1); 
        });
   
   
        wrapper.appendChild(elem);
        

        console.log(actions_arr);
    } ); 
    console.log(Math.max(student_id_arr));
    console.log(Math.max(task_id_arr));
    });
    
    let el = document.createElement("div");
    el.innerHTML = "Lesson";
    wrapper.appendChild(el);

}

btn.addEventListener("click", lesson);