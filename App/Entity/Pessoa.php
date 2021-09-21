<?php
	
	namespace App\Entity;

	class Pessoa{
		
		private $idPessoa;
		private $nome;
		private $telefone;
		private $email;
		private $whatsaap;

		//Construtor
		public function __construct($idPessoa = 0, $nome = '', $telefone = '', $email = '', $whatsapp = ''){
			$this->idPessoa = $idPessoa;
			$this->nome = $nome;
			$this->telefone = $telefone;
			$this->email = $email;
			$this->whatsapp = $whatsapp;
		}
		//Setters
		public function setId($id){
			$this->idPessoa = $id;
		}

		public function setNome($nome){
			$this->nome = $nome;
		}

		public function setTelefone($telefone){
			$this->telefone = $telefone;
		}

		public function setEmail($email){
			$this->email = $email;
		}

		public function setWhatsapp($wpp){
			$this->whatsapp = $wpp;
		}
		//Getters
		public function getId(){
			return $this->idPessoa;
		}

		public function getNome(){
			return $this->nome;
		}

		public function getTelefone(){
			return $this->telefone;
		}

		public function getEmail(){
			return $this->email;
		}

		public function getWhatsapp(){
			return $this->whatsapp;
		}
	}
?>