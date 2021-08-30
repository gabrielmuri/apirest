<?php 
	namespace App\Controller;
	use App\Entity\Pessoa;
	use App\Model\PessoaModel;

	class PessoaController{

		private $pessoaModel;

		public function __construct(){
			$this->pessoaModel = new PessoaModel();
		}
		
		//POST - Cria uma nova Pessoa
		public function create($data = null){
			$pessoa = $this->convertType($data);
			$result = $this->validacao($pessoa);

			if($result != ""){
				echo json_encode(["result"=>$result]);
			}
			
			$this->pessoaModel->create($pessoa);
		}

		//PUT - Altera uma Pessoa
		public function update($id = 0, $data = null){
			$pessoa = $this->convertType($data);			
			$pessoa->setId($id);

			$result = $this->validacao($pessoa, true);

			if($result != ""){
				echo json_encode(["result"=>$result]);
			}

			$this->pessoaModel->update($pessoa);
		}

		//DELETE - Deleta uma Pessoa
		public function delete($id = 0){
			$pessoa = new Pessoa();
			$pessoa->setId($id);
			$this->pessoaModel->delete($pessoa);
		}

		//GET - Retorna uma Pessoa
		public function readById($id = 0){
			$pessoa = new Pessoa();
			$pessoa->setId($id);			
			$this->pessoaModel->read($pessoa);
		}

		//GET _ Retorna todas as Pessoas
		public function readAll(){
			$pessoa = new Pessoa();
			$this->pessoaModel->readAll($pessoa);
		}

		private function convertType($data){
			return new Pessoa(
				null,
				(isset($data['nome']) ? $data['nome'] : null),
				(isset($data['telefone']) ? $data['telefone'] : null),
				(isset($data['email']) ? $data['email'] : null),
				(isset($data['whatsapp']) ? $data['whatsapp']  : null)
			);
		}

		private function validacao(Pessoa $pessoa, $update = false){
			
			if($update && $pessoa->getId() <= 0){
				return "invalid Id";
			}

			if(strlen($pessoa->getNome()) <= 2 || strlen($pessoa->getNome()) > 255){
				return "invalid Nome";
			}

			if(strlen($pessoa->getTelefone()) < 14 || strlen($pessoa->getTelefone()) > 15){
				return "invalid Telefone";
			}

			if(strlen($pessoa->getEmail()) < 10 || strlen($pessoa->getEmail()) > 255){
				return "invalid Email";
			}

			if(strlen($pessoa->getTelefone()) < 14 || strlen($pessoa->getTelefone()) > 15){
				return "invalid Whatsapp";
			}

			return "";
		}
	}
?>