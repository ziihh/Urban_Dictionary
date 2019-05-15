<?php
include("Model/User.php");
include("View/View.php");
include("Model/DBModel.php");

class Controller{

	private $model;
	private $view;

	function __construct(){
		$this->model = new DBModel();
		$this->view = new View();
	}

	function invoke(){

		if(isset($_POST["registerUser"])){

			$newUserName = filter_var($_POST['userr'], FILTER_SANITIZE_STRING);
			$newPassword1 = password_hash($_POST['password_1'], PASSWORD_DEFAULT);
			$newPassword2 = password_hash($_POST['password_2'], PASSWORD_DEFAULT);
			$newMail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
			$newFirstName = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
			$newLastName = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);

			$newUser = new User($newFirstName, $newLastName, $newUserName, $newPassword1, $newMail);

			$msg = $this->validateUserInfo($newUser);

			if($msg == ""){
				$this->model->registerUser($newUser);
	   			header("Refresh:0");
			} else {
				echo $msg;
				$this->view->createPage("View/RegisterUser.php", []);
			}


		} else if(isset($_GET["register"])){
			$this->view->createPage("View/RegisterUser.php", []);

		} else if(isset($_GET["login"])){
			$this->view->createPage("View/Login.php", []);

		} else if(isset($_POST["loginButton"])){
			$username = $_POST["username"];
			$password = $_POST["password"];

			$user = new User($userName, $password);
			$DBuser = $this->model->getUser($user);

			if($username == $DBuser->getuserName() && passowrd_verify($password, $DBuser->getPassword()){

			}

		}
		else {
			$this->view->createPage("View/Home.php", []);
		}






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