<?php
	
namespace Models;

class Topic{
	public int $ID;
	public $topicName;
	public $creadBy_User;
	public $createdAt;

	public function __construct($name, $user, $create_at){
		$this->topicName = $name;
		$this->creadBy_User = $user;
		$this->createAt = $create_at;
	}
}
