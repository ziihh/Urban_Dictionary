<?php
include("Model/User.php");
include("Model/Topic.php");
include("Model/Entry.php");
include("View/View.php");
include("Model/DBModel.php");

class Controller{

	private $model;
	private $view;

	function __construct(){
		session_start();
		$this->model = new DBModel();
		$this->view = new View();
	}

	function invoke(){
		$topics = $this->model->getTopics();

		if(isset($_POST["registerUser"])){

			$newUserName = filter_var($_POST['userr'], FILTER_SANITIZE_STRING);
			$newPassword = password_hash($_POST['password_1'], PASSWORD_DEFAULT);
			$newMail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
			$newFirstName = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
			$newLastName = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);

			$newUser = new User($newFirstName, $newLastName, $newUserName, $newPassword, $newMail);

			$msg = $this->validateUserInfo($newUser);

			if($msg == ""){
				$this->model->registerUser($newUser);
	   			header("Refresh:0");
			} else {
				echo $msg;
				$this->view->createPage("View/RegisterUser.php", []);
			}


		} else if(isset($_POST["loginButton"])){
			$user = new User();
			$user->setUserName($_POST["username"]);
			$user->setPassword($_POST["password"]);
			$resp = $this->model->authenticate($user);

			if($resp["code"] == 200){
				$user = $resp["payload"];
				$_SESSION["user"] = $user;
				header("Refresh:0");
			} else {
				echo $resp["message"];
				$this->view->createPage("View/Login.php", []);
			}

		} else if(isset($_GET["register"])){
			$this->view->createPage("View/RegisterUser.php", []);

		} else if(isset($_GET["login"])){
			$this->view->createPage("View/Login.php", []);

		} else if(isset($_GET["logout"])){
			session_unset();
			session_destroy();
			$this->view->createPage("View/Home.php", [$topics]);

		} else if(isset($_GET["editprofile"])){
			$this->view->createPage("View/EditProfile.php", [$_SESSION["user"]]);

		} else if(isset($_POST["updateUser"])){
			$this->updateUserInfo();

		} else if(isset($_GET["createTopic"])){
			$this->view->createPage("View/CreateTopic.php", [$_SESSION["user"]]);

		} else if(isset($_POST["addTopic"])){
			$this->addNewTopic([$topics]);

		} else if(isset($_GET["topicEntries"])){
			$entries = $this->model->getEntriesByTopicId($_GET["topicEntries"]);
			$this->view->createPage("View/Home.php", [$topics, $entries]);

		}else if(isset($_GET["createEntry"])){
			$this->view->createPage("View/AddEntry.php", [$topics]);

		} else if(isset($_POST["addEntry"])){
			$this->addNewEntry([$topics]);

		} else if(isset($_GET["deleteEntry"])){
			$this->model->deleteEntry($_GET["deleteEntry"]);

		} else {
			$this->view->createPage("View/Home.php", [$topics]);
		}

	}

	function addNewTopic($displayObjs){
		if($_SESSION["user"]->getUserType() == "author" || $_SESSION["user"]->getUserType() == "admin"){
			$topicName = $_POST["tName"];

			$newTopic = new Topic($topicName, $_SESSION["user"]->getID());

			$this->model->insertTopic($newTopic);
	   		header("Refresh:0");
	   	} else {
			$this->view->createPage("View/Home.php", $displayObjs);
	   	}
	}

	function addNewEntry($displayObjs){
		if($_SESSION["user"]->getUserType() == "author" || $_SESSION["user"]->getUserType() == "admin"){
			$entryName = $_POST["eName"];
			$entryDesc = $_POST["eDesc"];
			$topicId = $_POST["topicsSelection"];

			$newEntry = new Entry($entryName, $entryDesc, $topicId, $_SESSION["user"]->getID(), date("Y/m/d", time()));
			$this->model->insertEntry($newEntry);
	   		header("Refresh:0");
	   	} else {
			$this->view->createPage("View/Home.php", $displayObjs);
	   	}
	}

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

		// Check if old password match.
		if(password_verify($_POST["oldPass"], $loggedUser->getPassword())){
			$loggedUser->setPassword(password_hash($_POST["newPass"], PASSWORD_DEFAULT));
		}

		// Update user in DB.
		$this->model->updateUser($loggedUser);

		// Update user in the session variable.
		$_SESSION["user"] = $loggedUser;
   		header("Refresh:0");
	}

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


}
?>