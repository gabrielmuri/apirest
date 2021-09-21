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
		if(!confirm("Deseja ir para página de Pesquisa?")){
			return
		}else{
			var page = (window.location.href = 'search.html'); 
    		page.onload();
		}
	}else{
		if(!confirm("Deseja realmente atualizar esta Pessoa?")){
			return;
		}

		update(obj);
	}
}

function deletePessoa(id){
	if(!confirm("Deseja realmente Remover esta Pessoa?")){
		return;
	}

	deleta(id);
}

function getPessoa(id){
	readById(id);
}

$("#btn-atualizar").click(function(){
	sendForm();	
})

function createFormEditar(data){
	for(var i = 0; i < data.length; i++){
		
		$("#id").val(data[i].id_pessoa);
		$("#nome").val(data[i].nome);
		$("#telefone").val(data[i].telefone);
		$("#email").val(data[i].email);
		$("#whatsapp").val(data[i].whatsapp);

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
                   "<button id='btnEditar' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#staticBackdrop' onclick='getPessoa("+ data[i].id_pessoa +")'>"+
                   "<img src='img/editar-arquivo.png' title='Clique aqui para EDITAR esta Pessoa.'>"+
                   "</button>"+
                   "<button class='btn-deletar' style='margin-left: 5px;' onclick='deletePessoa("+ data[i].id_pessoa +")'>"+
                   "<img src='img/excluir.png' title='Clique aqui para EXCLUIR esta Pessoa.'>"+
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

function readById(id){
	$.ajax({
		url: "api/pessoa/" + id,
		type: "GET",
		data: {},
		dataType: "json",
		success: function(data){
			
		},
		error: function(error){
			console.log("erro")
		},
		complete: function(data){		
			var dt = JSON.parse(data.responseText);			
			data = Object.values(dt);
			
			createFormEditar(data);
		}
	})
}

function deleta(id){
	$.ajax({
		url: "api/pessoa/" + id,
		type: "DELETE",
		dataType: "json",
		data: {},
		sucess: function(data){
			
		},
		error: function(error){
			console.log(error);
		},
		complete: function(data){
			if(data.statusText == "OK"){
				readAll();
			}
		}
	})
}

function update(obj){
	$.ajax({
		url: "api/pessoa/" + obj.id,
		type: "PUT",
		dataType: "json",
		data: obj,
		sucess: function(data){

		},
		error: function(error){
			console.log(error);
		},
		complete: function(data){
			
			if(data.statusText == "OK"){
				alert("Pessoa Atualizada com sucesso!");
				location.reload();
			} else {
				alert("Erro ao Editar Pessoa!");
			}
		}
	})
}
