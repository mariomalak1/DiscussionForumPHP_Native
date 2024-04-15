<?php
	
namespace Models;

class UserSite{
	private int $ID;
	private string $password;
	
	public string $username;
	public $lastLogin;
	public $firstTimeLogin;
	public bool $activeNow;


	public function getPassword(){
		return $this->password;
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
