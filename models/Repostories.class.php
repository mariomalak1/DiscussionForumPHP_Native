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

	public function __construct(){
		echo "from constrct";
	}

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
}



?>