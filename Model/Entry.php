<?php
class Entry{
	private $id;
	private $entryName;
	private $entryDescription;
	private $topicId;
	private $userId;
	private $date;

	function __construct($entryName, $entryDescription, $topicId, $userId, $date, $id = -1){
		$this->id = $id;
		$this->entryName = $entryName;
		$this->entryDescription = $entryDescription;
		$this->topicId = $topicId;
		$this->userId = $userId;
		$this->date = $date;
	}

	function getID(){
		return $this->id;
	}

	function getEntryName(){
		return $this->entryName;
	}

	function getEntryDescription(){
		return $this->entryDescription;
	}

	function getTopicID(){
		return $this->topicId;
	}

	function getUserID(){
		return $this->userId;
	}

	function getDate(){
		return $this->date;
	}

	function setID($id){
		$this->id = $id;
	}

	function setEntryName($entryName){
		$this->entryName = $entryName;
	}

	function setEntryDescription($entryDescription){
		$this->entryDescription = $entryDescription;
	}

	function setTopicID($topicId){
		$this->topicId = $topicId;
	}

	function setUserID($id){
		$this->userId = $id;
	}

	function setDate($date){
		$this->date = $date;
	}

}
?>