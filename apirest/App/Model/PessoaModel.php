<?php 
	namespace App\Model;
	use App\Entity\Pessoa;
	use App\config\DataBase;

	class PessoaModel{

		private $fileName;
		private $listPessoa = [];

		public function __construct(){
			$this->load();
		}

		public function create(Pessoa $pessoa){
			$conection = new DataBase;
			
			$sql = $conection->request("INSERT INTO tb_pessoa (nome, telefone, email, whatsapp) VALUES (?,?,?,?)");
			$sql->execute(array($pessoa->getNome(),$pessoa->getTelefone(),$pessoa->getEmail(),$pessoa->getWhatsapp()));

			$response = $sql->fetchAll();

			return $response;

			$this->listPessoa[] = $pessoa;
			$this->save();

			return "ok";
		}

		public function update(Pessoa $pessoa){
			$conection = new DataBase;

			$sql = $conection->request("UPDATE tb_pessoa SET nome = ?, telefone = ?, email = ?, whatsapp = ? WHERE id_pessoa = ?");
			$sql->execute(array($pessoa->getNome(),$pessoa->getTelefone(),$pessoa->getEmail(),$pessoa->getWhatsapp(),$pessoa->getId()));

			$response = $sql->fetchAll();

			return $response;

			$this->listPessoa[] = $pessoa;
			$this->save();

			return "ok";
		}

		public function delete(Pessoa $pessoa){
			$conection = new DataBase;

			$sql = $conection->request("DELETE FROM tb_pessoa WHERE id_pessoa = ?");
			$sql->execute(array($pessoa->getId()));

			$response = $sql->fetchAll();

			return $response;
		}

		public function read(Pessoa $pessoa){
			$conection = new DataBase;

			$sql = $conection->request("SELECT * FROM tb_pessoa WHERE id_pessoa = ?");
			$sql->execute(array($pessoa->getId()));
			
			$response = $sql->fetchAll();


			return print_r($response);

			
		}

		public function readAll(Pessoa $pessoa){
			$conection = new DataBase;

			$sql = $conection->request("SELECT * FROM tb_pessoa");
			$sql->execute();

			$response = $sql->fetchAll();

			return var_dump($response);
		}

		private function save(){
			$temp = [];

			foreach ($this->listPessoa as $p) {
				$temp[] = [
					"id" => $p->getId(),
					"nome" => $p->getNome(),
					"telefone" => $p->getTelefone(),
					"email" => $p->getEmail(),
					"whatsapp" => $p->getWhatsapp()
				];

				$string = json_encode($temp);
				echo $string;
			}
		}

		private function load(){

		}
	}
?>