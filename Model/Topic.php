<?php

/**
 * Class for topic.
 */
class Topic{
	private $id;
	private $topicName;
	private $userId;

	/**
	 * Consrtuct topic object
	 *
	 * @param      string  	$topicName  The topic name
	 * @param      integer  $userId     The user identifier
	 * @param      integer  $id         The identifier
	 */
	function __construct($topicName, $userId, $id = -1){
		$this->id = $id;
		$this->topicName = $topicName;
		$this->userId = $userId;
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
	 * Gets the topic name.
	 *
	 * @return     string  The topic name.
	 */
	function getTopicName(){
		return $this->topicName;
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
	 * Sets the id.
	 *
	 * @param      integer  $id     The identifier
	 */
	function setID($id){
		$this->id = $id;
	}

	/**
	 * Sets the topic name.
	 *
	 * @param      string  $topicName  The topic name
	 */
	function setTopicName($topicName){
		$this->topicName = $topicName;
	}

	/**
	 * Sets the user id.
	 *
	 * @param      integer  $id     The identifier
	 */
	function setUserID($id){
		$this->userId = $id;
	}

}
?>