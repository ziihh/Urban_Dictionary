<?php

/**
 *
 */
class DBModel {

	private $db;

	function __construct() {
		try {
			$this->db = new PDO("mysql:host=localhost;dbname=urban_dictionary;", "root", "");
		} catch(PDOException $e){
			echo "Error ocurred! " . $e->getMessage();
		}
	}

	function registerUser($newUser){
		$query = $this->db->prepare("INSERT INTO users(userName, password, email, firstName, lastName, type) VALUES(:user, :pass, :mail, :nm, :snm, :typ)");

        $query->bindValue(':user', 	$newUser->getUserName(),	PDO::PARAM_STR);
        $query->bindValue(':pass', 	$newUser->getPassword(), 	PDO::PARAM_STR);
        $query->bindValue(':mail', 	$newUser->getEmail(),		PDO::PARAM_STR);
        $query->bindValue(':nm', 	$newUser->getFirstName(),	PDO::PARAM_STR);
        $query->bindValue(':snm', 	$newUser->getLastName(),	PDO::PARAM_STR);
        $query->bindValue(':typ', 	$newUser->getUserType(),	PDO::PARAM_STR);
        $query->execute();

        $newUser->setID($this->db->lastInsertId());
	}

	function existUser($newUser){
		$result = null;

		$query = $this->db->prepare("SELECT * FROM `users` WHERE userName = :user OR email = :mail");
		$query->bindValue(':user', 	$newUser->getUserName(),	PDO::PARAM_STR);
		$query->bindValue(':mail', 	$newUser->getEmail(),		PDO::PARAM_STR);

		$query->execute();

		$result = $query->fetchAll(PDO::FETCH_ASSOC);

		if(isset($result)){
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Gets the user.
	 *
	 * @param      object  $user   The user
	 *
	 * @return     object    The user.
	 */
	function getUser($user){
		$query = $this->db->prepare("SELECT * FROM 'users' WHERE userNme = :user AND password = :password");
		$query->bindValue(':user', $newUser->getUserName(), PDO::PARAM_STR);
		$query->bindValue(':password', $newUser->getPassword(), PDO::PARAM_STR);
		$query->execute();

		$result= $query->fetchAll(PDO::FETCH_ASSOC);
		$userObj = new User($result['firstName'], $result['lastName'], $result['userName'], $result['password'], $result['email']);

		return $userObj;
	}

}


?>