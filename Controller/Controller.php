<?php
include("Model/User.php");
include("Model/Topic.php");
include("Model/Entry.php");
include("View/View.php");
include("Model/DBModel.php");

/**
 * Controls the data flow into an item object and updates the view whenever data changes.
 */
class Controller{

	private $model;
	private $view;

	/**
	 * Construct controller object.
	 */
	function __construct(){
		session_start();		// Start session.
		$this->model = new DBModel();	// Initiate DB.
		$this->view = new View();		// Initiate view.
	}

	/**
	 * Function to comparing topics for built-in sorting algorithm.
	 *
	 * @param      Topic   $a      First topic element found.
	 * @param      Topic   $b      Next topic element found.
	 *
	 * @return     integer  In order the topics should be sorted.
	 */
	static function cmp($a, $b){
		if($a->getTopicName() > $b->getTopicName()){
			return 1;
		} else if($a->getTopicName() < $b->getTopicName()){
			return -1;
		} else {
			return 0;
		}
	}

	/**
	 * Invoke is handler function for different functionalities.
	 */
	function invoke(){
		$topics = $this->model->getTopics();

		// Setting user preferences if COOKIE is set.
		if(isset($_COOKIE["Order"]) && $_COOKIE["Order"] == "Chronological"){
			usort($topics, array("Controller", "cmp"));
		} else if(isset($_COOKIE["Order"]) && $_COOKIE["Order"] == "Popularity"){
			$entriesPerTopicInLastWeek = $this->model->getEntriesAddedInLastWeekByTopicsId($topics);
			arsort($entriesPerTopicInLastWeek);
			$topics = $this->sortTopicsByPopularity($entriesPerTopicInLastWeek, $topics);
		}


		// Register user
		if(isset($_POST["registerUser"])){
			// Sanitize user input.
			$newUserName = filter_var($_POST['userr'], FILTER_SANITIZE_STRING);
			$newPassword = password_hash($_POST['password_1'], PASSWORD_DEFAULT);
			$newMail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
			$newFirstName = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
			$newLastName = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);

			// Create the user object.
			$newUser = new User($newFirstName, $newLastName, $newUserName, $newPassword, $newMail);

			$msg = $this->validateUserInfo($newUser); // Validate user info.

			// if no error message to be shown
			if($msg == ""){
				$this->model->registerUser($newUser);
	   			header("Refresh:0");
			} else {	// Show error message otherwise.
				echo $msg;
				$this->view->createPage("View/RegisterUser.php", []);
			}


		} else if(isset($_POST["loginButton"])){	// Authenticate user.
			$user = new User();
			// Fetch user credentials.
			$user->setUserName(filter_var($_POST["username"], FILTER_SANITIZE_STRING));
			$user->setPassword(filter_var($_POST["password"], FILTER_SANITIZE_STRING));

			// Authenticate user with DB.
			$resp = $this->model->authenticate($user);

			// If response was OK.
			if($resp["code"] == 200){
				$user = $resp["payload"];
				$_SESSION["user"] = $user;	// Set the user in session.
				header("Refresh:0");
			} else {						// otherwise, use error message and redirect back to login page.
				echo $resp["message"];
				$this->view->createPage("View/Login.php", []);
			}

		} else if(isset($_GET["register"])){	// Register button is clicked.
			$this->view->createPage("View/RegisterUser.php", []);

		} else if(isset($_GET["login"])){			// Login button is clicked.
			$this->view->createPage("View/Login.php", []);

		} else if(isset($_GET["logout"])){			// Logout button is clicked.
		    // Unset and destroy the current logged session.
			session_unset();
			session_destroy();
			$this->view->createPage("View/Home.php", [$topics]);

		} else if(isset($_GET["editprofile"])){			// Edit profile button is clicked.
			$this->view->createPage("View/EditProfile.php", [$_SESSION["user"]]);

		}  else if(isset($_POST["updateUser"])){		// Update button is clicked in Edit profile.
			$this->updateUserInfo();

		} else if(isset($_GET["usersList"]) && isset($_GET["updateUserId"]) && isset($_POST["adminUpdateUser"])){	// Admin update user info.
			$this->adminUpdateUserInfo($_GET["updateUserId"]);	// Update the user info based on user id.
			$usersList = $this->model->getUsersList();			// Get updated user list from the DB.
			$this->view->createPage("View/UsersList.php", [$usersList]);	// View the updated list on the user list page.

		} else if(isset($_GET["usersList"]) && isset($_GET["deleteUserId"])){	// Delete the user.
			$this->model->deleteUserById($_GET["deleteUserId"]);	// Delete the user based on user id.
			$usersList = $this->model->getUsersList();				// Get the new user list from DB.

			$this->view->createPage("View/UsersList.php", [$usersList]); 	// View the new list on the user list page.

		} else if(isset($_GET["usersList"])){				// Get and view the user list when User list button is clicked.
			$usersList = $this->model->getUsersList();
			$this->view->createPage("View/UsersList.php", [$usersList]);

		} else if(isset($_GET["createTopic"])){				// When create topic button is clicked.
			$this->view->createPage("View/CreateTopic.php", [$_SESSION["user"]]);

		} else if(isset($_POST["addTopic"])){	// Add topic button is clicked within Create Topic.
			$this->addNewTopic([$topics]);

		} else if(isset($_GET["topicEntries"]) && !array_key_exists("deleteEntry", $_GET)){		// When a certain topic is clicked-
			$entries = $this->model->getEntriesByTopicId($_GET["topicEntries"]);	// Fetch the entries within a topic based on topic id.

			$this->view->createPage("View/Home.php", [$topics, $entries]);	// Update home page with entries.

		} else if(isset($_GET["deleteTopic"])){			// Delete the topic.
			$this->model->deleteTopic((int)$_GET["deleteTopic"]);
			header("Location:index.php");

		} else if(isset($_GET["createEntry"])){			// When create entry button is clicked.
			$this->view->createPage("View/AddEntry.php", [$topics]);

		} else if(isset($_POST["addEntry"])){			// When add entry button is clicked.
			$this->addNewEntry([$topics]);

		} else if(isset($_GET["deleteEntry"]) && isset($_GET["topicEntries"])){		// When delete entry button is clicked.
			$this->model->deleteEntry((int)$_GET["deleteEntry"]);
			header("Location:index.php?topicEntries=".$_GET["topicEntries"]);

		} else if(isset($_GET["summary"])){		// When summary of topics button is clicked.
			// Fetch all entries with each topic.
			$topicsMap = array();
			foreach ($topics as $topic) {
				$topicsMap[$topic->getTopicName()] = $this->model->getNrOfEntriesByTopicId($topic->getID());
			}
			$this->view->createPage("View/Summary.php", [$topicsMap]); // View summary with topic name and nr of entries within it.

		} else if(isset($_POST["orderBy"])) { 		// When user has picked a specific ordering.
			setcookie("Order", $_POST["orderBy"]);		// Set the cookie for feature uses.

			header("Refresh:0");

		} else if(isset($_POST["submitSearch"])) {		// When a keyword is entered through search bar.
			$topicsMatch = array();
			$entriesMatch = array();
			// Check if search field was not empty and category was topics.
			if($_POST["searchField"] != "" && $_POST["categoryToSearch"] == "topics"){
				$topicsMatch = $this->model->searchMatchingTopics(filter_var($_POST["searchField"], FILTER_SANITIZE_STRING));

			} else if($_POST["searchField"] != "" && $_POST["categoryToSearch"] == "entries"){ 		// Otherwise category was entries.
				$entriesMatch = $this->model->searchMatchingEntries(filter_var($_POST["searchField"], FILTER_SANITIZE_STRING));

			}
			// update the home page with search result.
			$this->view->createPage("View/Home.php", [$topics, null, $topicsMatch, $entriesMatch]);

		} else {	// By default show home page with topics found in DB.
			$this->view->createPage("View/Home.php", [$topics]);
		}

	}

	/**
	 * Adds a new topic.
	 *
	 * @param      array  $displayObjs  Items that should be displayed on home page.
	 */
	function addNewTopic($displayObjs){

		// Checks if user is either admin or author.
		if($_SESSION["user"]->getUserType() == "author" || $_SESSION["user"]->getUserType() == "admin"){
			$topicName = $_POST["tName"]; // Fetch the posted topic name in form by user.

			$newTopic = new Topic($topicName, $_SESSION["user"]->getID());

			$this->model->insertTopic($newTopic); // Insert topic object into database.
	   		header("Refresh:0");
	   	} else {
			$this->view->createPage("View/Home.php", $displayObjs);
	   	}
	}

	/**
	 * Adds a new entry.
	 *
	 * @param      array  $displayObjs  Items that should be displayed on home page.
	 */
	function addNewEntry($displayObjs){

		// Checks if user is admin or author.
		if($_SESSION["user"]->getUserType() == "author" || $_SESSION["user"]->getUserType() == "admin"){

			// Fetch the fields posted in form by the user.
			$entryName = $_POST["eName"];
			$entryDesc = $_POST["eDesc"];
			$topicId = $_POST["topicsSelection"];

			$newEntry = new Entry($entryName, $entryDesc, $topicId, $_SESSION["user"]->getID(), date("Y/m/d", time()));
			$this->model->insertEntry($newEntry); // Insert entry object into database.
	   		header("Refresh:0");
	   	} else {
			$this->view->createPage("View/Home.php", $displayObjs);
	   	}
	}

	/**
	 * function validates user info and then updates the user.
	 *
	 * @param      int  $id     The identifier.
	 */
	function adminUpdateUserInfo($id){
		$user = $this->model->getUserById($id); // Fetch user by his id.

		// Validate fields.
		if($_POST["fname"] != ""){
			$user->setFirstName($_POST["fname"]);
		}

		if($_POST["lname"] != "") {
			$user->setLastName($_POST["lname"]);
		}

		if($_POST["email"] != "") {
			$user->setEmail($_POST["email"]);
		}

		// Check if old password match and it not a empty string.
		if($_POST["newPass"] != ""){
			$user->setPassword(password_hash($_POST["newPass"], PASSWORD_DEFAULT));
		}

		// Update user in DB.
		$this->model->updateUser($user);
	}

	/**
	 * Update the user information.
	 */
	function updateUserInfo(){
		// Get current logged in user.
		$loggedUser = $_SESSION["user"];

		// Validate fields.
		if($_POST["fname"] != ""){
			$loggedUser->setFirstName($_POST["fname"]);
		}

		if($_POST["lname"] != "") {
			$loggedUser->setLastName($_POST["lname"]);
		}

		if($_POST["email"] != "") {
			$loggedUser->setEmail($_POST["email"]);
		}

		// Check if old password match and it not a empty string.
		if(password_verify($_POST["oldPass"], $loggedUser->getPassword()) && $_POST["newPass"] != ""){
			$loggedUser->setPassword(password_hash($_POST["newPass"], PASSWORD_DEFAULT));
		}

		// Update user in DB.
		$this->model->updateUser($loggedUser);

		// Update user in the session variable.
		$_SESSION["user"] = $loggedUser;
		header("Refresh:0");
	}

	/**
	 * Validates user information.
	 *
	 * @param      user object  $newUser  The new user
	 *
	 * @return     string  Error message.
	 */
	function validateUserInfo($newUser){
		$message = "";
		$passMatch = true;

		// Check if both fields match.
		if($_POST['password_1'] != $_POST['password_2']){
			$message = "<script type='text/javascript'> alert('Both password fields must match') </script>";
			$passMatch = false;
		}

		// if pass 1 and 2 matches check if user exist in DB.
		if($passMatch == true && $this->model->existUser($newUser)){
			$message = "<script type='text/javascript'> alert('User exists already in the system.') </script>";
		}

		return $message;
	}

	/**
	 * Sort topics by popolarity.
	 *
	 * @param      array  $arrayToBaseOn  The array to base on.
	 * @param      array  $arrayToSort    The array to sort.
	 *
	 * @return     array   sorted array of topics.
	 */
	function sortTopicsByPopularity($arrayToBaseOn, $arrayToSort){
		$resultSortedArray = array();

		// Loops through the order array that sorted array should be based on.
		foreach ($arrayToBaseOn as $topicId => $nrOfEntries) {

			// Loops through each element in array to be sort.
			foreach ($arrayToSort as $topic) {

				// if id match with the order array id.
				if($topic->getID() == $topicId){
					// push in a new array, which will be the sorted array.
					array_push($resultSortedArray, $topic);
				}
			}
		}

		return $resultSortedArray;
	}


}
?>