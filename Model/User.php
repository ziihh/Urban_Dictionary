<?php

class User{
	private $id;
	private $firstName;
	private $lastName;
	private $userName;
	private $password;
	private $email;
	private $userType;

	function __construct($firstName = "", $lastName = "", $userName = "", $password = "", $email = "", $userType = "author"){

		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->userName = $userName;
		$this->password = $password;
		$this->email = $email;
		$this->userType = $userType;
	}

	function getID(){
		return $this->id;
	}

	function getFirstName(){
		return $this->firstName;
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
		$this->firstName = $firstName;
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