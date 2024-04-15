<?php
	
	require "models\Repostories.class.php";
	require_once "models\User.class.php";


	// $main = new UserRepostory\Repostory();


	$user = new Models\User("mario", "mariomalak123");
	$user->save();
	Repostories\UserRepostory::createUser($user);

	// print_r($main);
	// $ma = new UserFF\UserRepostory();
	// $ma->createUser();

//createUser();

?>