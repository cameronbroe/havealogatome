<?php

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

    private $seed;
    private $wordFile;
    private $wordList;
    private $letterFrequencies = array();
    private $lengthFrequencies = array();

    /**
     * Constructor for Generator class.
     * @param int $seed The seed for the logatome generation, this will determine the maximum length of substrings to use in algorithm
     * @param string $wordFile The path to the file of words to use for generation
     */
    public function __construct($seed = 3, $wordFile) {
        $this->seed = $seed;
        $this->wordFile = $wordFile;
        $this->loadWordList();
        $this->calculateLengthFrequencies();
        for ($i = 1; $i <= $seed; $i++) {
            $this->letterFrequencies[$i] = $this->calculateLetterFrequencies($i);
        }
    }

    private function loadWordList() {
        if (file_exists($this->wordFile)) {
            $words = file_get_contents($this->wordFile);
            $this->wordList = explode("\n", $words);
        } else {
            echo "The file could not be found!";
        }
    }

    private function calculateLengthFrequencies() {
        $minLength = 9999;
        $maxLength = 0;
        $wordCount = 0;
        foreach ($this->wordList as $word) {
            $length = strlen($word);
            $minLength = min(array($length, $minLength));
            $maxLength = max(array($length, $maxLength));
            if (!isset($this->lengthFrequencies[$length])) {
                $this->lengthFrequencies[$length] = 0;
            }
            $this->lengthFrequencies[$length]++; // Increment the counter for word of length n
            $wordCount++;
        }
        for ($i = $minLength; $i <= $maxLength; $i++) {
            if (isset($this->lengthFrequencies[$i])) {
                $temp = $this->lengthFrequencies[$i];
                $this->lengthFrequencies[$i] = $temp / $wordCount;
            }
        }
    }

    private function calculateLetterFrequencies($seed) {
        $freqList = array();
        foreach ($this->wordList as $word) {
            for ($wordPos = 0; $wordPos <= (strlen($word) - $seed); $wordPos++) {
                $substring = substr($word, $wordPos, $seed);
                $letter = substr($word, $wordPos + $seed, 1);
                if (strlen($letter) == 1) {
                    if (!isset($freqList[$substring])) {
                        $freqInit = array();
                        $freqList[$substring] = $freqInit;
                        $freqList[$substring]["total"] = 0;
                    }
                    if (!isset($freqList[$substring][$letter])) {
                        $freqList[$substring][$letter] = 0;
                    }
                    $freqList[$substring][$letter] += 1;
                    $freqList[$substring]["total"] += 1;
                }
            }
        }
        foreach ($freqList as $substring => $letter) {
            $subTotal = $freqList[$substring]["total"];
            foreach ($letter as $key => $count) {
                if (!($key == "total")) {
                    $freqList[$substring][$key] /= $subTotal;
                }
            }
        }
        return $freqList;
    }

    private static function generateRandomKey($freqArray) {
        $tempList = array();
        foreach ($freqArray as $key => $value) {
            if (!($key == "total")) {
                for ($i = 0; $i < ceil($value * 100); $i++) {
                    $tempList[] = $key;
                }
            }
        }
        $index = rand(0, count($tempList) - 1);
        return $tempList[$index];
    }
    
    private function generateWordLength() {
        return Generator::generateRandomKey($this->lengthFrequencies);
    }
    
    public function generateWord() {
        $alphabet = "abcdefghijklmnopqrstuvwxyz";
        $wordLength = $this->generateWordLength();
        $word = "";
        $firstLetterIndex = rand(0, strlen($alphabet) - 1);
        $word .= $alphabet[$firstLetterIndex];
        
        $letterFreqGen = 1;
        for($i = 1; $i < $wordLength; $i++) {
            $letterFreqList = $this->letterFrequencies[$letterFreqGen];
            if($letterFreqGen < $this->seed) {
                $letterFreqGen++;
            }
            $substring = null;
            if(strlen($word) < $this->seed) {
                $substring = $word;
            } else {
                $substring = substr($word, ($i - $this->seed), $this->seed + 1);
            }
            if(isset($letterFreqList[$substring])) {
                $letter = Generator::generateRandomKey($letterFreqList[$substring]);
                $word .= $letter;
            } else {
                return $word;
            }
        }
        return $word;
    }

    public function debug() {
        echo $this->generateWord();
    }

}

$test = new Generator(3, "EnglishWords.txt");
$test->debug();
?>
