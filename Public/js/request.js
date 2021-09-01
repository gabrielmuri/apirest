$(document).ready(function(){
	console.clear();
	readAll();
})

function sendForm(){
	var obj = {
		id : $("#id").val(),
		nome : $("#nome").val(),
		telefone : $("#telefone").val(),
		email : $("#email").val(),
		whatsapp : $("#whatsapp").val()
	};

	if(obj.id == undefined){
		create(obj);
	} 
}

function createTable(data){
	
	var row = document.getElementById("resposta");
  	row.innerHTML = "";
	//var dt = JSON.parse(data.responseText);
	//console.log(Object.values(dt)[0])
	for(var i = 0; i < data.length; i++){
		var teste ="<tr>"+ 
				   "<th scope='row' id='id'>"+ data[i].id_pessoa +"</th>"+
                   "<td id='txtnome'>"+ data[i].nome +"</td>"+
                   "<td id='txttelefone'>"+ data[i].telefone +"</td>"+
                   "<td id='txtemail'>"+ data[i].email +"</td>"+
                   "<td id='txtwhatsapp'>"+ data[i].whatsapp +"</td>"+
                   "<td>"+
                   "<button id='btnEditar' onclick='editar()'>"+
                   "<img src='img/editar-arquivo.png' title='Editar'>"+
                   "</button>"+
                   "<button style='margin-left: 5px;'>"+
                   "<img src='img/excluir.png' title='Exclui'>"+
                   "</button>"+
                    "</td>"+
                    "<tr>";
        row.innerHTML += teste;
	}
}

//AJAX
function create(obj){
	$.ajax({
		url: "api/pesssoa",
		type: "POST",
		data: obj,
		dataType: "json",
		beforeSend: function(){

		},
		sucess: function(data){
			
		},
		erro: function(error){
			alert("Erro ao cadastrar a pessoa!")
		},
		complete: function(){
			
		}
	});
}

function readAll(){
	$.ajax({
		url: "api/pessoa/",
		type: "GET",
		data: {},
		dataType: "json",
		sucess: function(data){
					
		},
		erro: function(error){
			console.log(error);
		},
		complete: function(data){
			var dt = JSON.parse(data.responseText);			
			data = Object.values(dt);			
			createTable(data);
		}
	});
}
