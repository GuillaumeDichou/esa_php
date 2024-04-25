<?php

$word = readline("Enter a word : ");;

$reversedWord = strrev($word);
    
if ($word == $reversedWord) {
    echo "$word is a palindrome.";
} else {
    echo "$word is not a palindrome.";
}
