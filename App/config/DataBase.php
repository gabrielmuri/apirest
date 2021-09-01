<?php 
	namespace App\config;
	use PDO;

	class DataBase{
		
		private $conection;

		public function __construct(){
			$this->conection = new PDO('mysql:host=localhost;dbname=db_pessoas', 'root', '123Nmudar');
		}

		public function request($string){
			$sql = $this->conection->prepare($string);

			return $sql;
		}

		public static function pdoException($code){
			switch($code){
				case 2002:
					return "Problemas ao conectar ao Banco de Dados, verifique a sua conexão com a internet!";
					break;
				case 1049:
					return "Problemas ao  validar conexão com o Banco de Dados, verifique os parametros de conexão: ".$code;
					break;
				default:
					return "Erro na conexão com o Banco de Dados, código ".$code;
			}
		}
	}
?>