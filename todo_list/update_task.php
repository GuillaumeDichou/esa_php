<?php

$taskIndex = $_POST['task_index'];
$completed = isset($_POST['completed']) ? 1 : 0;

// Load data from csv file
$csvFile = 'tasks.csv';
$tasks = [];

$file = fopen($csvFile, 'r');

while (($task = fgetcsv($file)) !== false) {
    $tasks[] = $task;
}

fclose($file);


// Update job status at specified index

// Check if the task is checked
$tasks[$taskIndex][3] = $completed;

// Write updated tasks to csv file
$file = fopen($csvFile, 'w');

foreach ($tasks as $task) {
    fputcsv($file, $task);
}

fclose($file);

// Calculate XP earned for this task only if the task has been checked or unchecked
if ($completed) {
    $difficulty = $tasks[$taskIndex][1];
    $frequency = $tasks[$taskIndex][2];
    $xpEarned = 0;

    if ($difficulty == 'easy') {
        switch ($frequency) {
            case 'daily':
                $xpEarned = 1;
                break;
            case 'weekly':
                $xpEarned = 7;
                break;
            case 'monthly':
                $xpEarned = 30;
                break;
            case 'yearly':
                $xpEarned = 365;
            case 'one shot':
                $xpEarned = 5;
                break;
        }
    } elseif ($difficulty == 'medium') {
        switch ($frequency) {
            case 'daily':
                $xpEarned = 2;
                break;
            case 'weekly':
                $xpEarned = 14;
                break;
            case 'monthly':
                $xpEarned = 60;
                break;
            case 'yearly':
                $xpEarned = 730;
            case 'one shot':
                $xpEarned = 100;
                break;
        }
    } elseif ($difficulty == 'hard') {
        switch ($frequency) {
            case 'daily':
                $xpEarned = 3;
                break;
            case 'weekly':
                $xpEarned = 21;
                break;
            case 'monthly':
                $xpEarned = 90;
                break;
            case 'yearly':
                $xpEarned = 1095;
            case 'one shot':
                $xpEarned = 2000;
                break;
        }
    }

    // Load task data from csv file
    $file = fopen("profile.csv", "r");

    while(!feof($file)) {
        $contentFile[] = fgetcsv($file);
    }

    fclose($file);

    $level = $contentFile[0][0];
    $rank = $contentFile[1][0];
    $xp = $contentFile[2][0];

    // Setting League of Legends ranks
    $ranks = [
        'Iron 4', 'Iron 3', 'Iron 2', 'Iron 1',
        'Bronze 4', 'Bronze 3', 'Bronze 2', 'Bronze 1',
        'Silver 4', 'Silver 3', 'Silver 2', 'Silver 1',
        'Gold 4', 'Gold 3', 'Gold 2', 'Gold 1',
        'Platinum 4', 'Platinum 3', 'Platinum 2', 'Platinum 1',
        'Emerald 4', 'Emerald 3', 'Emerald 2', 'Emerald 1',
        'Diamond 4', 'Diamond 3', 'Diamond 2', 'Diamond 1',
        'Master', 'Grandmaster', 'Challenger'
    ];

    // XP update and level check
    $xp += $xpEarned;
    while ($xp >= $level + 9) {
        $xp -= ($level + 9);
        $level++;
    }

    // Rank update
    $rankIndex = floor($level / 5);
    if ($rankIndex < count($ranks)) {
        $rank = $ranks[$rankIndex];
    } else {
        $rank = $ranks[count($ranks) - 1]; // If the level exceeds the highest defined rank
    }

    // Write the new data to the csv file
    $file = fopen("profile.csv", "w");
    fputcsv($file, [$level]);
    fputcsv($file, [$rank]);
    fputcsv($file, [$xp]);
    fclose($file);

}

// Redirect to main page
header('Location: index.php');
exit();


?>
