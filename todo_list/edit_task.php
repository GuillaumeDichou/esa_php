<?php
$taskIndex = $_POST['task_index'];
$taskName = $_POST['task_name'];
$difficulty = $_POST['difficulty'];
$frequency = $_POST['frequency'];

// Load data from csv file
$csvFile = 'tasks.csv';
$tasks = [];

$file = fopen($csvFile, 'r');

while (($task = fgetcsv($file)) !== false) {
    $tasks[] = $task;
}

fclose($file);

$completed = $tasks[$taskIndex][3];
$tasks[$taskIndex] = [$taskName, $difficulty, $frequency, $completed];

// Write updated tasks to csv file
$file = fopen($csvFile, 'w'); {
    foreach ($tasks as $task) {
        fputcsv($file, $task);
    }
    fclose($file);
}

// Redirect to main page
header('Location: index.php');
exit();

?>