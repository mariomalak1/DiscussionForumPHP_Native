<?php
	
	require "models\Repostories\UserRepostory.class.php";
	require_once "models\User.class.php";


	// $main = new UserRepostory\Repostory();


	// $user = new Models\User("malak", "mariomalak123");
	// $user->save();

	// Repostories\UserRepostory::createUser($user);
	Models\Repostories\UserRepostory::updateUserOtherData("mario", false);
	Models\Repostories\UserRepostory::getAllUsersLikeUsername("m");
	// print_r($main);
	// $ma = new UserFF\UserRepostory();
	// $ma->createUser();

//createUser();

?>