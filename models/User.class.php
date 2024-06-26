<?php
	
namespace Models;

class User{
	private int $ID;
	private string $password;
	
	public string $username;
	public $lastLogin;
	public $firstTimeLogin;
	public bool $activeNow;


	public function getPassword(){
		return $this->password;
	}


	public function setID($id_){
		return $this->ID = $id_;
	}

	public function getID(){
		return $this->$ID;
	}

	public function __construct($name, $password){
		$this->password = $password;
		$this->username = $name;
	}

	private function hashPassword($password){
		$hash = password_hash($password, PASSWORD_BCRYPT);
		$this->password = $hash;
	}


	public function save(){
		$this->hashPassword($this->password);
	}

}
