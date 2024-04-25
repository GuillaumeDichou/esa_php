<?php

/*
Ask data required
*/

$nombre1 = readline("Enter a number : ");
while (is_numeric($nombre1) == False) {
	$nombre1 = readline("Enter a real number : ");
}

$tab = ['+','-','/','*','%'];
$operation = readline("Enter an operation (+,-,/,*,%) : ");
while (in_array($operation, $tab) == False) {
	$operation = readline("Enter an operation (+,-,/,*,%) : ");
}

$nombre2 = readline("Enter a number : ");
while (is_numeric($nombre2) == False) {
	$nombre2 = readline("Enter a real number : ");
}

/*
Calculate
*/

if ($operation == '+') {
	$resultat = ((int)$nombre1 + $nombre2);
} elseif ($operation == '-') {
	$resultat = ((int)$nombre1 - $nombre2);
} elseif ($operation == '/') {
	if ($nombre2 == '0') {
		echo 'Impossible';
		exit;
	} else {
		$resultat = ((int)$nombre1 / $nombre2);
	}
} elseif ($operation == '*') {
	$resultat = ((int)$nombre1 * $nombre2);
} else {
	$resultat = ((int)$nombre1 % $nombre2);
}

echo $nombre1 . $operation . $nombre2 . '=' . $resultat;

// match is better than if elseif
// Need a check but === is better than ==