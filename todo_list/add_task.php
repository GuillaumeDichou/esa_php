<?php

$taskName = $_POST['task_name'];
$difficulty = $_POST['difficulty'];
$frequency = $_POST['frequency'];

// Add the new task to the csv file
$csvFile = 'tasks.csv';
$file = fopen($csvFile, 'a');
fputcsv($file, [$taskName, $difficulty, $frequency, 0]);
fclose($file);

// Redirect to main page
header('Location: index.php');
exit();

?>