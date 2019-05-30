<?php

/**
 * Class for user.
 */
class User{
	private $id;
	private $firstName;
	private $lastName;
	private $userName;
	private $password;
	private $email;
	private $userType;

	/**
	 * Construct user object.
	 *
	 * @param      string  $firstName  The first name
	 * @param      string  $lastName   The last name
	 * @param      string  $userName   The user name
	 * @param      string  $password   The password
	 * @param      string  $email      The email
	 * @param      string  $userType   The user type
	 */
	function __construct($firstName = "", $lastName = "", $userName = "", $password = "", $email = "", $userType = "author"){

		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->userName = $userName;
		$this->password = $password;
		$this->email = $email;
		$this->userType = $userType;
	}

	/**
	 * Gets the id.
	 *
	 * @return     integer  The id.
	 */
	function getID(){
		return $this->id;
	}

	/**
	 * Gets the first name.
	 *
	 * @return     string  The first name.
	 */
	function getFirstName(){
		return $this->firstName;
	}

	/**
	 * Gets the last name.
	 *
	 * @return     string  The last name.
	 */
	function getLastName(){
		return $this->lastName;
	}

	/**
	 * Gets the user name.
	 *
	 * @return     string  The user name.
	 */
	function getUserName(){
		return $this->userName;
	}

	/**
	 * Gets the password.
	 *
	 * @return     string  The password.
	 */
	function getPassword(){
		return $this->password;
	}

	/**
	 * Gets the email.
	 *
	 * @return     string  The email.
	 */
	function getEmail(){
		return $this->email;
	}

	/**
	 * Gets the user type.
	 *
	 * @return     string  The user type.
	 */
	function getUserType(){
		return $this->userType;
	}

	/**
	 * Sets the id.
	 *
	 * @param      integer  $id     The identifier
	 */
	function setID($id){
		$this->id = $id;
	}

	/**
	 * Sets the first name.
	 *
	 * @param      string  $firstName  The first name
	 */
	function setFirstName($firstName){
		$this->firstName = $firstName;
	}

	/**
	 * Sets the last name.
	 *
	 * @param      string  $lastName  The last name
	 */
	function setLastName($lastName){
		$this->lastName = $lastName;
	}

	/**
	 * Sets the user name.
	 *
	 * @param      string  $userName  The user name
	 */
	function setUserName($userName){
		$this->userName = $userName;
	}

	/**
	 * Sets the password.
	 *
	 * @param      string  $password  The password
	 */
	function setPassword($password){
		$this->password = $password;
	}

	/**
	 * Sets the email.
	 *
	 * @param      string  $email  The email
	 */
	function setEmail($email){
		$this->email = $email;
	}

	/**
	 * Sets the user type.
	 *
	 * @param      string  $userType  The user type
	 */
	function setUserType($userType){
		$this->userType = $userType;
	}
}
?>