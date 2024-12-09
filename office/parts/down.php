
	</div>

</body>
</html>
<script type="text/javascript">
	
	show_btn.addEventListener("click",show_b);
	show_btn_t.addEventListener("click",show_t);
	function show_b (){
		if (gra.classList.contains('hide')){
			gra.className="show";
			show_btn.innerHTML="Спрятать график";
		}
			else
			{gra.className="hide";
			show_btn.innerHTML="Показать график";

		}
		console.log(gra.classList.contains('hide'));
	}

	function show_t (){
		if (mainTable.classList.contains('hide')){
			mainTable.className="show";
			show_btn_t.innerHTML="Спрятать таблицу";
		}
			else
			{mainTable.className="hide";
			show_btn_t.innerHTML="Показать таблицу";

		}
	}
	function hide_add_t()
{
	var x = document.getElementsByClassName("add");
	var i;
	for (i = 0; i < x.length; i++) {
		if (x[i].className=="add"){ 
    		x[i].className="add hide";
    	}else{x[i].className="add";
    	}
		console.log(x[i].style.display);

	}
	if (hide_btn_add.innerHTML == "Показать дополнительные данные"){
		hide_btn_add.innerHTML="Скрыть дополнительные данные";		
	}
	else{hide_btn_add.innerHTML="Показать дополнительные данные";}
	}

</script>	