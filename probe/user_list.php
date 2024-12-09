<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul id="lst"></ul>
    <script>
function answers(k){
  query = 'https://innovations.kh.ua/probe/back/users/';
  console.log(query);
  fetch(query).then(response => response.json())
  .then(function (users) {
      for (let i = 0;i<users.length;i++){
          console.log(users[i]);
          let li_elem = document.createElement('li');
          let a_elem = document.createElement('a');
          a_elem.innerText = users[i].name;
          a_elem.target = "_blank";
          a_elem.href = "https://innovations.kh.ua/probe/lesson.php?id="+users[i].id;
          li_elem.append(a_elem);
          lst.append(li_elem);
      }
   
    console.log(users);
      
  });
}
answers(1);
</script>

</body>
</html>