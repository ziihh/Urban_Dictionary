<?php

/**
 * Class for entry.
 */
class Entry{
	private $id;
	private $entryName;
	private $entryDescription;
	private $topicId;
	private $userId;
	private $date;

	/**
	 * Construct entry object.
	 *
	 * @param      string  	$entryName         The entry name
	 * @param      string  	$entryDescription  The entry description
	 * @param      integer  $topicId           The topic identifier
	 * @param      integer  $userId            The user identifier
	 * @param      string  	$date              The date
	 * @param      integer  $id                The identifier
	 */
	function __construct($entryName, $entryDescription, $topicId, $userId, $date, $id = -1){
		$this->id = $id;
		$this->entryName = $entryName;
		$this->entryDescription = $entryDescription;
		$this->topicId = $topicId;
		$this->userId = $userId;
		$this->date = $date;
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
	 * Gets the entry name.
	 *
	 * @return     string  The entry name.
	 */
	function getEntryName(){
		return $this->entryName;
	}

	/**
	 * Gets the entry description.
	 *
	 * @return     string  The entry description.
	 */
	function getEntryDescription(){
		return $this->entryDescription;
	}

	/**
	 * Gets the topic id.
	 *
	 * @return     integer  The topic id.
	 */
	function getTopicID(){
		return $this->topicId;
	}

	/**
	 * Gets the user id.
	 *
	 * @return     integer  The user id.
	 */
	function getUserID(){
		return $this->userId;
	}

	/**
	 * Gets the date.
	 *
	 * @return     string  The date.
	 */
	function getDate(){
		return $this->date;
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
	 * Sets the entry name.
	 *
	 * @param      string  $entryName  The entry name
	 */
	function setEntryName($entryName){
		$this->entryName = $entryName;
	}

	/**
	 * Sets the entry description.
	 *
	 * @param      string  $entryDescription  The entry description
	 */
	function setEntryDescription($entryDescription){
		$this->entryDescription = $entryDescription;
	}

	/**
	 * Sets the topic id.
	 *
	 * @param      integer  $topicId  The topic identifier
	 */
	function setTopicID($topicId){
		$this->topicId = $topicId;
	}

	/**
	 * Sets the user id.
	 *
	 * @param      integer  $id     The identifier
	 */
	function setUserID($id){
		$this->userId = $id;
	}

	/**
	 * Sets the date.
	 *
	 * @param      string  $date   The date
	 */
	function setDate($date){
		$this->date = $date;
	}

}
?>