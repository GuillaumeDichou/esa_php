<?php

$taskIndex = $_POST['task_index'];

// Load task data from csv file
$csvFile = 'tasks.csv';
$tasks = [];


$file = fopen($csvFile, 'r');

while (($task = fgetcsv($file)) !== false) {
    $tasks[] = $task;
}

fclose($file);


// Delete task at specified index

unset($tasks[$taskIndex]);

// Reindex the table
$tasks = array_values($tasks);

// Write updated tasks to csv file
$file = fopen($csvFile, 'w');

foreach ($tasks as $task) {
    fputcsv($file, $task);
}

fclose($file);


// Redirect to main page
header('Location: index.php');
exit();

?>
