<?php
/**
 * @package Logatome
 */
namespace Logatome;

/**
 * Base class for the logatome generator.
 * 
 * A class to generate logatomes based off real words. The algorithm simply counts
 * the frequency of words of different lengths to generate the length of the logatome
 * to generate. After that, it takes a seed _n_ to use for substring lengths.
 * The algorithm determines which letters follow specific substrings up to length _n_
 * and counts the frequency they occur throughout the words. Using these frequencies,
 * the algorithm randomly picks a letter to add to the logatome until it is at the desired
 * length.
 * 
 * @author Cameron Roe
 * 
 * @version dev
 */
class Generator {
    /** @var int Seed for logatome generation */ private $seed;
    /** @var string Filename for words to use for generation */ private $wordFile;
    /** @var array Associative arrays for letter frequencies */ private $letterFrequencies = array();
    /** @var array Associative array for word length frequencies */ private $lengthFrequencies = array();
    
    /**
     * Constructor for Generator class.
     * @param int $seed The seed for the logatome generation, this will determine the maximum length of substrings to use in algorithm
     * @param string $wordFile The path to the file of words to use for generation
     */
    public function __construct($seed = 3, $wordFile) {
        $this->seed = $seed;
        $this->wordFile = $wordFile;
    }
    
    private function createDictWordLengths() {
        
    }
}

?>
