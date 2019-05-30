<?php

/**
 * Class for db model.
 */
class DBModel {

	private $db;

	/**
	 * Construct the DBModel object.
	 */
	function __construct() {
		try {
			// Creates a PDO object.
			$this->db = new PDO("mysql:host=localhost;dbname=urban_dictionary;", "root", "");
		} catch(PDOException $e){
			echo "Error ocurred! " . $e->getMessage();
		}
	}

	/**
	 * Resigster user.
	 *
	 * @param      User  $newUser  The new user.
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

	/**
	 * Check if user exists in the DB.
	 *
	 * @param      User   $newUser  The new user
	 *
	 * @return     boolean  true if it does, false otherwise.
	 */
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

	/**
	 * Update the user with new info.
	 *
	 * @param      User  $user   The user with new info.
	 */
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

	/**
	 * Gets the user by identifier.
	 *
	 * @param      integer  $id     The identifier
	 *
	 * @return     User    The user by identifier.
	 */
	function getUserById($id){
		$query = $this->db->prepare("SELECT * FROM `users` WHERE userId = :id");
        $query->bindValue(':id', $id,	PDO::PARAM_INT);

		$query->execute();

		$result = $query->fetch(PDO::FETCH_ASSOC);
		$user = new User($result["firstName"], $result["lastName"], $result["userName"], $result["password"], $result["email"], $result["type"]);
		$user->setID($result["userId"]);

		return $user;
	}

	/**
	 * Delete the user by identifier.
	 *
	 * @param      integer  $id     The identifier
	 */
	function deleteUserById($id){
		$this->deleteEntryByUserId($id);
		$this->deleteTopicByUserId($id);

		$query = $this->db->prepare("DELETE FROM `users` WHERE userId = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);

		$query->execute();
	}

	/**
	 * Delete an entry by user identifier.
	 *
	 * @param      integer  $id     The identifier
	 */
	function deleteEntryByUserId($id){
		$query = $this->db->prepare("DELETE FROM entries WHERE userId=:id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);

		$query->execute();
	}

	/**
	 * Delete a topic by user identifier.
	 *
	 * @param      integer  $id     The identifier
	 */
	function deleteTopicByUserId($id){
		$query = $this->db->prepare("DELETE FROM topics WHERE userId=:id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);

		$query->execute();
	}

	/**
	 * Gets the users list.
	 *
	 * @return     array  The users list.
	 */
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

	/**
	 * Insert a new topic into DB.
	 *
	 * @param      Topic  $newTopic  The new topic
	 */
	function insertTopic($newTopic){
		$query = $this->db->prepare("INSERT INTO topics(topicName, userId) VALUES(:topicName, :userId)");

        $query->bindValue(':topicName', $newTopic->getTopicName(),	PDO::PARAM_STR);
        $query->bindValue(':userId', 	$newTopic->getUserID(),		PDO::PARAM_INT);

		$query->execute();

		$newTopic->setID($this->db->lastInsertId());
	}

	/**
	 * Insert a new entry into DB.
	 *
	 * @param      Entry  $newEntry  The new entry
	 */
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

	/**
	 * Delete an entry based on entry identifier.
	 *
	 * @param      integer  $entryId  The entry identifier
	 */
	function deleteEntry($entryId){
		$query = $this->db->prepare("DELETE FROM entries WHERE entryId=:entryId");
        $query->bindValue(':entryId', $entryId, PDO::PARAM_INT);

		$query->execute();
	}

	/**
	 * Gets the nr of entries by topic identifier.
	 *
	 * @param      integer  $id     The identifier
	 *
	 * @return     integer  The nr of entries by topic identifier.
	 */
	function getNrOfEntriesByTopicId($id){
		$query = $this->db->prepare("SELECT COUNT(*) FROM `entries` WHERE topicId=:id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);

		$query->execute();

		$res = $query->fetch();

		return $res[0];
	}

	/**
	 * Gets the topics.
	 *
	 * @return     array  The topics.
	 */
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
	 * Delete topic based on topic identifier
	 *
	 * @param      integer  $topicId  The topic identifier
	 */
	function deleteTopic($topicId){
		$this->deleteAllEntriesByTopicId($topicId);
		$query = $this->db->prepare("DELETE FROM topics WHERE topicId=:topicId");
        $query->bindValue(':topicId', $topicId, PDO::PARAM_INT);

		$query->execute();
	}

	/**
	 * Delete all entries within a topic based on topic identifier.
	 *
	 * @param      integer  $topicId  The topic identifier
	 */
	function deleteAllEntriesByTopicId($topicId){
		$query = $this->db->prepare("DELETE FROM entries WHERE topicId=:topicId");
        $query->bindValue(':topicId', $topicId, PDO::PARAM_INT);

		$query->execute();
	}

	/**
	 * Gets the entries by topic identifier.
	 *
	 * @param      integer  $topicId  The topic identifier
	 *
	 * @return     array   The entries by topic identifier.
	 */
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
	 * Find the matching result from DB based on search key.
	 *
	 * @param      string  $searchKey  The search key
	 *
	 * @return     array   array of Topic object matching the search key.
	 */
	function searchMatchingTopics($searchKey){
		$topics = array();
		$query = $this->db->prepare("SELECT * FROM topics WHERE topicName LIKE :topicName");
        $query->bindValue(':topicName', '%'.$searchKey.'%', PDO::PARAM_STR);

		$query->execute();

		$result = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach ($result as $row) {
			$topic = new Topic($row["topicName"], $row["userId"], $row["topicId"]);
			array_push($topics, $topic);
		}

		return $topics;
	}

	/**
	 * Find the matching result from DB bases on search key.
	 *
	 * @param      string  $searchKey  The search key
	 *
	 * @return     array   array of Entry object matching the search key.
	 */
	function searchMatchingEntries($searchKey){
		$entries = array();
		$query = $this->db->prepare("SELECT * FROM entries WHERE entryName LIKE :entryName");
        $query->bindValue(':entryName', '%'.$searchKey.'%', PDO::PARAM_STR);

		$query->execute();

		$result = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach ($result as $row) {
			$entry = new Entry($row["entryName"], $row["entryDescription"], $row["topicId"], $row["userId"], $row["entryDate"], $row["entryId"]);
			array_push($entries, $entry);
		}

		return $entries;
	}

	/**
	 * Gets the entries added in last week by topics identifier.
	 *
	 * @param      array  $topics  The topics
	 *
	 * @return     array   The entries added in last week by topics identifier.
	 */
	function getEntriesAddedInLastWeekByTopicsId($topics){
		$entriesPerTopicInLastWeek = array();

		// Loop through each topic within topics array.
		foreach ($topics as $topic) {
			$entries = array();
			// Get all the entries added in DB in last 7 days.
			$query = $this->db->prepare("SELECT * FROM entries WHERE DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= entryDate && topicId = :topicId");
	        $query->bindValue(':topicId', $topic->getID(), PDO::PARAM_INT);

			$query->execute();

			$result = $query->fetchAll(PDO::FETCH_ASSOC);

			/**
			 * Create entry object for each result fetched from DB.
			 */
			foreach ($result as $row) {
				$entry = new Entry($row["entryName"], $row["entryDescription"], $row["topicId"], $row["userId"], $row["entryDate"], $row["entryId"]);
				array_push($entries, $entry);
			}

			// Store the nr of entries on index topic identifier.
			$entriesPerTopicInLastWeek[$topic->getID()] = sizeof($entries);
		}
		// Return the map created.
		return $entriesPerTopicInLastWeek;
	}

	/**
	 * Handles the authentication of user.
	 *
	 * @param      User  $user   The user
	 *
	 * @return     array   array containing the response if user authenticated on not along with a message.
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