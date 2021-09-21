<?php 
	require_once("../../vendor/autoload.php");
	use App\Controller\PessoaController;
	//Header
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: GET, POST, PUT DELETE");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	//Fim Header

	$controller = null;
	$id = null;
	$data = null;
	$method = $_SERVER["REQUEST_METHOD"]; //POST, PUT, DELETE e GET	
	$uri = $_SERVER["REQUEST_URI"];
	$unsetCount = 4;
	//trata a uri
	$ex = explode("/", $uri);

	for($i = 0; $i < $unsetCount; $i++){
		unset($ex[$i]);
	}

	$ex = array_filter(array_values($ex));

	if(isset($ex[0])){
		$controller = $ex[0];
	}

	if(isset($ex[1])){
		$id = $ex[1];
	}
	
	parse_str(file_get_contents('php://input'), $data);
	//fim tratamento da uri

	$pessoaController = new PessoaController();

	switch($method) {
		case 'GET':
			if($controller != null && $id == null){
				echo $pessoaController->readAll();				
			} else if($controller != null && $id != null){
				echo $pessoaController->readById($id);				
			} else {
				echo json_encode(["result"=>"invalid"]);
			}
			break;
		case 'POST':
			if($controller != null){
				echo $pessoaController->create($data);
			} else {
				echo json_encode(["result"=>"invalid"]);
			}
			break;
		case 'PUT':
			if($controller != null && $id != null){				
				echo $pessoaController->update($id, $data);				
			} else {
				echo json_encode(["result"=>"invalid"]);
			}
			break;
		case 'DELETE':
			if($controller != null && $id != null){
				echo $pessoaController->delete($id);
			} else {
				echo json_encode(["result"=>"invalid"]);
			}
			break;
		default:
			echo json_encode(["result"=>"invalid request"]);
			break;

	}
	
	
?>