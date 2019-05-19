<?php

class View{


	function __construct(){

	}

	function createPage($contentFilePath, $data){
		include 'View/includes/header.php';
		include $contentFilePath;
		include 'View/includes/footer.php';
	}

}


?>