<?php

class User{
	private $id;
	private $firstname;
	private $lastName;
	private $userName;
	private $password;
	private $email;
	private $userType;

	function __construct($firstname, $lastName, $userName, $password, $email, $userType = "author"){
		$this->firstname = $firstname;
		$this->lastName = $lastName;
		$this->userName = $userName;
		$this->password = $password;
		$this->email = $email;
		$this->userType = $userType;
	}

	function __construct($userName, $password){
		$this->userName = $userName;
		$this->password = $password;
	}

	function getID(){
		return $this->id;
	}

	function getFirstName(){
		return $this->firstname;
	}

	function getLastName(){
		return $this->lastName;
	}

	function getUserName(){
		return $this->userName;
	}

	function getPassword(){
		return $this->password;
	}

	function getEmail(){
		return $this->email;
	}

	function getUserType(){
		return $this->userType;
	}

	function setID($id){
		$this->id = $id;
	}

	function setFirstName($firstName){
		$this->firstname = $firstname;
	}

	function setLastName($lastName){
		$this->lastName = $lastName;
	}

	function setUserName($userName){
		$this->userName = $userName;
	}

	function setPassword($password){
		$this->password = $password;
	}

	function setEmail($email){
		$this->email = $email;
	}

	function setUserType($userType){
		$this->userType = $userType;
	}

}
?>