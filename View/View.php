<?php

/**
 * Visualization of the data that model contains.
 */
class View{


	function __construct(){

	}

	/**
	 * Creates a page.
	 *
	 * @param      string  	$contentFilePath  The content file path
	 * @param      array  	$data             The data can contain many arrays of different
	 * 											data to be displayed and is handeld within individual $contentFilePath.
	 */
	function createPage($contentFilePath, $data){
		include 'View/includes/header.php';
		include $contentFilePath;
		include 'View/includes/footer.php';
	}

}


?>