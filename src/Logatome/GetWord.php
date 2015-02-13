<?php
	// This file should be accessed by AJAX only
	// Can take parameters through $_GET to get different types of words
	require_once 'Generator.php';

	// Parameters
	if(isset($_GET["word_file"])) {
		$fileName = $_GET["word_file"];
	} else {
		$fileName = NULL;
	}

	if(isset($_GET["seed"])) {
		$seed = $_GET["seed"];
	} else {
		$seed = NULL;
	}

	// Global variables
	$generator = new Logatome\Generator(); // Default options

	// Fill in word file and seed if they are provided
	if(!is_null($fileName)) {
		$generator->setWordFile($fileName);
	}

	if(!is_null($seed)) {
		$generator->setSeed($seed);
	}

	// Generate word and output it
	$word = $generator->generateWord();
	$data = array(
	    'word' => $word,
	    'fileName' => $generator->getWordFile(),
	    'seed' => $generator->getSeed(),
	    'cwd' => getcwd()
	);
	echo json_encode($data);
?>
