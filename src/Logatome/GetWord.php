<?php
// This file should be accessed by AJAX only
// Can take parameters through $_GET to get different types of words
require_once 'Generator.php';

// Parameters
$fileName = $_GET["word_file"];
$seed = $_GET["seed"];

// Global variables
$generator = new Logatome\Generator(); // Default options

// Generate word and output it
$word = $generator->generateWord();
$data = array(
    'word' => $word,
    'fileName' => $generator->getWordFile(),
    'seed' => $seed
);
echo json_encode($data);
?>
