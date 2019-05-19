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
	/**
	 * { function_description }
	 *
	 * @param      <type>  $newUser  The new user
	 */
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

		$result = $query->fetch(PDO::FETCH_ASSOC);

		if($result["userName"] && $result["userName"] == $newUser->getUserName()){
			return true;
		} else {
			return false;
		}
	}

	function updateUser($user){
		$query = $this->db->prepare("UPDATE users SET firstName = :firstName, lastName = :lastName, email = :email, password = :password WHERE userId = :userId AND userName = :userName");

		$query->bindValue(':firstName', 	$user->getFirstName(),	PDO::PARAM_STR);
        $query->bindValue(':lastName', 	$user->getLastName(), 		PDO::PARAM_STR);
        $query->bindValue(':email', 	$user->getEmail(),			PDO::PARAM_STR);
        $query->bindValue(':password', 	$user->getPassword(),		PDO::PARAM_STR);
        $query->bindValue(':userId', 	$user->getID(),				PDO::PARAM_INT);
        $query->bindValue(':userName', 	$user->getUserName(),		PDO::PARAM_STR);

		$query->execute();

	}

	function insertTopic($newTopic){
		$query = $this->db->prepare("INSERT INTO topics(topicName, userId) VALUES(:topicName, :userId)");

        $query->bindValue(':topicName', $newTopic->getTopicName(),	PDO::PARAM_STR);
        $query->bindValue(':userId', 	$newTopic->getUserID(),		PDO::PARAM_INT);

		$query->execute();

		$newTopic->setID($this->db->lastInsertId());
	}

	function getTopics(){
		$topics = array();

		$query = $this->db->prepare("SELECT * FROM topics");
		$query->execute();

		$result = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach ($result as $row) {
			$topic = new Topic($row["topicName"], $row["userId"], $row["topicId"]);

			array_push($topics, $topic);
		}

		return $topics;
	}

	/**
	 * Handles the authentication of user.
	 *
	 * @param      <type>  $user   The user
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	function authenticate($user){
		$response = array();

		$query = $this->db->prepare("SELECT * FROM `users` WHERE userName = :user");
		$query->bindValue(':user', $user->getUserName(), PDO::PARAM_STR);
		$query->execute();

		$result= $query->fetch(PDO::FETCH_ASSOC);
		if($result){
			$userObj = new User($result['firstName'], $result['lastName'], $result['userName'], $result['password'], $result['email'], $result['type']);
			$userObj->setID($result["userId"]);

			if(password_verify($user->getPassword(), $result['password'])){
				$response["message"] = "Authenticated";
				$response["payload"] = $userObj;
				$response["code"] = 200;
			} else {
				$response["message"] = "<script>alert('Username or password is incorrect!')</script>";
				$response["payload"] = null;
				$response["code"] = 401;
			}
		} else {
			$response["message"] = "<script>alert('Username or password is incorrect!')</script>";
			$response["payload"] = null;
			$response["code"] = 401;
		}

		return $response;
	}

}


?>