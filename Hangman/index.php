<?php

include 'dessin.php';

// Function to choose a random word from the file
function choose_random_word($file) {
    $words = file($file, FILE_IGNORE_NEW_LINES);
    $random_word = $words[array_rand($words)];
    return strtoupper($random_word); // Convert to uppercase for easier comparison
}

// Check if the proposed letter is in the word
function check_letter($letter, $word, &$letters_found, &$mistakes) {
    $letter = strtoupper($letter); // Convert to uppercase for easier comparison
    if (strpos($word, $letter) !== false) {
        // If the letter is found in the word
        $letters_found[] = $letter;
    } else {
        // If the letter is not found
        $mistakes++;
    }
}

//Display the current word
function display_current_word($word, $letters_found) {
    $current_word = '';
    for ($i = 0; $i < strlen($word); $i++) {
        if (in_array($word[$i], $letters_found)) {
            $current_word .= $word[$i] . ' ';
        } else {
            $current_word .= '_ ';
        }
    }
    echo PHP_EOL . $current_word . PHP_EOL;
}

//Display letters_found, letters_tried
function display_letters_found_and_tried($letters_found, $letters_tried) {
    echo "Letters found: ";
    for ($i = 0; $i < count($letters_found); $i++) {
        echo $letters_found[$i] . " ";
    }
    echo PHP_EOL;

    echo "Letters tried: ";
    for ($i = 0; $i < count($letters_tried); $i++) {
        echo $letters_tried[$i] . " ";
    }
    echo PHP_EOL;
}

// Check end game
function check_end_game($word, $letters_found, $mistakes) {
    // Check if all letters are found in the word
    $word_letters = str_split($word); // Convert the word into an array of letters
    $word_letters = array_unique($word_letters); // Remove duplicate letters
    sort($word_letters); // Sort the letters alphabetically
    sort($letters_found); // Sort the found letters alphabetically
    if ($word_letters == $letters_found) {
        return true; // All letters found, game won
    }

    // Check if the number of mistakes reached the limit
    if ($mistakes > 8) {
        return true; // Too many mistakes, game lost
    }

    return false; // Game continues
}

// Initializing the game
$word = choose_random_word('mots.txt');
$letters_found = [];
$letters_tried = [];
$mistakes = 0;
$end_game = false;

while ($mistakes <= 8 and !$end_game) {
    if ($mistakes > 0) {
        // Display the hangman drawing
        echo dessinPendu(8-$mistakes);
    }

    //Display the current word
    display_current_word($word, $letters_found);

    //Display letters_found, letters_tried
    display_letters_found_and_tried($letters_found, $letters_tried);

    //Ask a letter
    $letter = readline("Guess a letter: ");
    $letters_tried[] = strtoupper($letter);

    //check letter
    check_letter($letter, $word, $letters_found, $mistakes);

    //check end game
    $end_game = check_end_game($word, $letters_found, $mistakes);
}

if ($mistakes > 8) {
    echo "Game over !";
} else {
    echo "GG !";
}