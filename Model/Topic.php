<?php

class Topic{
	private $id;
	private $topicName;
	private $userId;

	function __construct($topicName, $userId, $id = -1){
		$this->id = $id;
		$this->topicName = $topicName;
		$this->userId = $userId;
	}

	function getID(){
		return $this->id;
	}

	function getTopicName(){
		return $this->topicName;
	}

	function getUserID(){
		return $this->userId;
	}

	function setID($id){
		$this->id = $id;
	}

	function setTopicName($topicName){
		$this->topicName = $topicName;
	}

	function setUserID($id){
		$this->userId = $id;
	}

}
?>