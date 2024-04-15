<?php


namespace Repostories;



class SqlConnector{

	public static function executeQueryOnDataBase($sql, $s, $params){
		mysqli_report(MYSQLI_REPORT_OFF);
		$conn = mysqli_connect("localhost", "root", "", "discussionforumnativephp") or die("Could not connect: " . mysqli_error($conn));
		$stmt = mysqli_stmt_init($conn);

		if (! $stmt){
			echo "Something happen error" . "<br>";
			exit();
		}

    	if (mysqli_stmt_prepare($stmt,$sql)) { 
        	try{
	        	mysqli_stmt_execute($stmt, $params);
        	}
        	catch(Exception $e){
        		echo "error while execution " . "<br>";
        		exit();
        	}

        	$result = mysqli_stmt_get_result($stmt);
        	return $result;
    	}else{
    		echo "Sql Query is wrong, please type write one";
    	}




		return $stmt;
	}
}


class UserRepostory{

	public static function createUser($user){
		$sql = "SELECT `username` FROM `users` WHERE `username` = ?";
		$s = "s";

		$result = SqlConnector::executeQueryOnDataBase($sql, $s, array($user->username));

		if ($result->fetch_row()) {
			echo "username is already taken before";
			exit();
		}


		$sql = "INSERT INTO `users`(`username`, `firstTimeLogin`, `password`) VALUES (?, ?, ?)";

    	$firstTimeLogin = date("Y-m-d H:i:s");    	
    	$pass = $user->getPassword();
    	$username = $user->username;

    	$params = array($username, $firstTimeLogin, $pass);
    	$s = "sss";
    
	    SqlConnector::executeQueryOnDataBase($sql, $s, $params);
	}


	public static function updateUserName($username1, $username2){
		$sql = "SELECT `username` FROM `users` WHERE `username` = ?";
		$s = "s";

		$result = SqlConnector::executeQueryOnDataBase($sql, $s, array($username1));

		if (!$result->fetch_row()) {
			echo "the user is not regestier before<br>";
			exit();
		}else{
			$result = SqlConnector::executeQueryOnDataBase($sql, $s, array($username2));
			if ($result->fetch_row()) {
				echo "username is already taken before<br>";
				exit();
			}else{
				$sql = "UPDATE `users` SET `username`= '?' WHERE `username` = ?";
				$s = "ss";
				$result = SqlConnector::executeQueryOnDataBase($sql, $s, array($username2, $username1));
			}

		}
	}

	public static function updateUserOtherData($username, $activeNow){
		$lastLogin = date('Y/m/d H:i:s');
		$sql = "UPDATE `users` SET `lastLogin`= ?, `activeNow` = ? WHERE `username` = ?";
		$s = "sss";
		$result = SqlConnector::executeQueryOnDataBase($sql, $s, array($lastLogin, $activeNow, $username));
	}

	public static function updateUserPassword($user){
		$username = $user->username;
		$newPassword = $user->getPassword();
		$sql = "UPDATE `users` SET `password`= ?, WHERE `username` = ?";
		$s = "sss";
		$result = SqlConnector::executeQueryOnDataBase($sql, $s, array($newPassword, $username));
	}


	public static function getAllUsersLikeUsername($username){
		$sql = "SELECT * FROM `users` WHERE `username` LIKE ?";
		$s = "s";
		$result = SqlConnector::executeQueryOnDataBase($sql, $s, array("%" . $username . "%"));
		$users = array();
        while ($row = $result->fetch_assoc() ) {
        	$user = new \Models\User($row["username"], $row["password"]);
        	$user->setID($row["userID"]);
        	$user->lastLogin = $row["lastLogin"];
        	$user->firstTimeLogin = $row["firstTimeLogin"];
        	$user->activeNow = $row["activeNow"] ? true : false;
        	array_push($users, $user);
        }
        return $users;
	}

	public static function getSpecificUserMatchUsername($username){
		$sql = "SELECT * FROM `users` WHERE `username` = ?";
		$s = "s";
		$result = SqlConnector::executeQueryOnDataBase($sql, $s, array($username));
		$row = $result->fetch_assoc();
		if ($row) {
			$user = new \Models\User($row["username"], $row["password"]);
			$user->setID($row["userID"]);
        	$user->lastLogin = $row["lastLogin"];
        	$user->firstTimeLogin = $row["firstTimeLogin"];
        	$user->activeNow = $row["activeNow"] ? true : false;
        	print_r($user);
        	return $user;
		}else{
			echo "no user found with this username";
			return null;
		}
	}
}

?>