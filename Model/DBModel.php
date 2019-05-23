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

		$query->bindValue(':firstName', $user->getFirstName(),	PDO::PARAM_STR);
        $query->bindValue(':lastName', 	$user->getLastName(), 	PDO::PARAM_STR);
        $query->bindValue(':email', 	$user->getEmail(),		PDO::PARAM_STR);
        $query->bindValue(':password', 	$user->getPassword(),	PDO::PARAM_STR);
        $query->bindValue(':userId', 	$user->getID(),			PDO::PARAM_INT);
        $query->bindValue(':userName', 	$user->getUserName(),	PDO::PARAM_STR);

		$query->execute();

	}

	function getUserById($id){
		$query = $this->db->prepare("SELECT * FROM `users` WHERE userId = :id");
        $query->bindValue(':id', $id,	PDO::PARAM_INT);

		$query->execute();

		$result = $query->fetch(PDO::FETCH_ASSOC);
		$user = new User($result["firstName"], $result["lastName"], $result["userName"], $result["password"], $result["email"], $result["type"]);
		$user->setID($result["userId"]);

		return $user;
	}

	function deleteUserById($id){
		$this->deleteEntryByUserId($id);
		$this->deleteTopicByUserId($id);

		$query = $this->db->prepare("DELETE FROM `users` WHERE userId = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);

		$query->execute();
	}

	function deleteEntryByUserId($id){
		$query = $this->db->prepare("DELETE FROM entries WHERE userId=:id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);

		$query->execute();
	}

	function deleteTopicByUserId($id){
		$query = $this->db->prepare("DELETE FROM topics WHERE userId=:id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);

		$query->execute();
	}

	function getUsersList(){
		$users = array();
		$query = $this->db->prepare("SELECT * FROM `users`");

		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach ($result as $row) {
			$user = new User($row["firstName"], $row["lastName"], $row["userName"], $row["password"], $row["email"], $row["type"]);
			$user->setID($row["userId"]);
			array_push($users, $user);
		}
		return $users;
	}

	function insertTopic($newTopic){
		$query = $this->db->prepare("INSERT INTO topics(topicName, userId) VALUES(:topicName, :userId)");

        $query->bindValue(':topicName', $newTopic->getTopicName(),	PDO::PARAM_STR);
        $query->bindValue(':userId', 	$newTopic->getUserID(),		PDO::PARAM_INT);

		$query->execute();

		$newTopic->setID($this->db->lastInsertId());
	}

	function insertEntry($newEntry){
		$query = $this->db->prepare("INSERT INTO entries(entryName, entryDescription, topicId, userId, entryDate) VALUES(:entryName, :entryDescription, :topicId, :userId, :entryDate)");

        $query->bindValue(':entryName',			$newEntry->getEntryName(),			PDO::PARAM_STR);
        $query->bindValue(':entryDescription',	$newEntry->getEntryDescription(),	PDO::PARAM_STR);
        $query->bindValue(':topicId', 			$newEntry->getTopicID(),			PDO::PARAM_INT);
        $query->bindValue(':userId', 			$newEntry->getUserID(),				PDO::PARAM_INT);
        $query->bindValue(':entryDate', 		$newEntry->getDate(),				PDO::PARAM_STR);

		$query->execute();

		$newEntry->setID($this->db->lastInsertId());
	}

	function deleteEntry($entryId){
		$query = $this->db->prepare("DELETE FROM entries WHERE entryId=:entryId");
        $query->bindValue(':entryId', $entryId, PDO::PARAM_INT);

		$query->execute();
	}

	function getNrOfEntriesByTopicId($id){
		$query = $this->db->prepare("SELECT COUNT(*) FROM `entries` WHERE topicId=:id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);

		$query->execute();

		$res = $query->fetch();

		return $res[0];
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

	function deleteTopic($topicId){
		$this->deleteAllEntriesByTopicId($topicId);
		$query = $this->db->prepare("DELETE FROM topics WHERE topicId=:topicId");
        $query->bindValue(':topicId', $topicId, PDO::PARAM_INT);

		$query->execute();
	}

	function deleteAllEntriesByTopicId($topicId){
		$query = $this->db->prepare("DELETE FROM entries WHERE topicId=:topicId");
        $query->bindValue(':topicId', $topicId, PDO::PARAM_INT);

		$query->execute();
	}

	function getEntriesByTopicId($topicId){
		$entries = array();

		$query = $this->db->prepare("SELECT * FROM entries WHERE topicId = :topicId ORDER BY entryDate DESC");
        $query->bindValue(':topicId', $topicId, PDO::PARAM_INT);
		$query->execute();

		$result = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach ($result as $row) {
			$entry = new Entry($row["entryName"], $row["entryDescription"], $row["topicId"], $row["userId"], $row["entryDate"], $row["entryId"]);
			array_push($entries, $entry);
		}

		return $entries;
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