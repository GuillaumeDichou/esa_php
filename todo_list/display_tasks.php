<?php
// Load data from csv file
$csvFile = 'tasks.csv';
$tasks = [];
$completedTasks = [];
$incompleteTasks = [];


$file = fopen($csvFile, 'r');

while (($task = fgetcsv($file)) !== false) {
    $tasks[] = $task;
}

fclose($file);


// Filter tasks by category or frequency

// Check if diificulty or frequency are in the URL
// If it's there, get the correct difficulty / frequency
// If it's not there, set at all
$difficulty = isset($_GET['difficulty']) ? $_GET['difficulty'] : 'all';
$frequency = isset($_GET['frequency']) ? $_GET['frequency'] : 'all';

$filteredTasks = [];

// Checks whether the task should be included in the filtered tasks
foreach ($tasks as $task) {
    if (($difficulty === 'all' || $task[1] === $difficulty) && ($frequency === 'all' || $task[2] === $frequency)) {
        $filteredTasks[] = $task;
    }
}

// Separate completed and uncompleted tasks
foreach ($filteredTasks as $task) {
    if ($task[3] == '1') {
        $completedTasks[] = $task;
    } else {
        $incompleteTasks[] = $task;
    }
}

function compareByDifficulty($task1, $task2) {
    $difficultyOrder = ['hard' => 1, 'medium' => 2, 'easy' => 3];
    return $difficultyOrder[$task1[1]] - $difficultyOrder[$task2[1]];
}

usort($incompleteTasks, 'compareByDifficulty');
usort($completedTasks, 'compareByDifficulty');

// Displaying unfinished tasks
foreach ($incompleteTasks as $index => $task) {
    $checked = $task[3] == '1' ? 'checked' : ''; // Determining checkbox status
    echo '<div class="task">';
    echo '<form action="update_task.php" method="POST" style="display:inline-block; max-width: 350px;">'; // Creates a form to update task status
    echo '<input type="hidden" name="task_index" value="' . array_search($task, $tasks) . '">'; // Adds a hidden field containing the task index to the $tasks array. This lets update_task.php know which task needs updating.
    echo '<input type="checkbox" name="completed" ' . $checked . ' onchange="this.form.submit()">'; // Check box to mark task completed
    echo '<span class="task_name">' . ($task[0]) . '</span>';
    echo '<br>';
    echo '<span>Difficulty : ' . ($task[1]) . '</span>';
    echo '<span>Frequency : ' . ($task[2]) . '</span>';
    echo '</form>';
    // Div for Edit and Delete button
    echo '<div class="task_buttons">';
    // Form to edit task
    echo '<form action="edit_task0.php" method="POST" style="display:inline;">';
    echo '<input type="hidden" name="task_index" value="' . array_search($task, $tasks) . '">';
    echo '<button class="edit_button" type="submit">Edit</button>';
    echo '</form>';
    // Form to delete task
    echo '<form action="delete_task.php" method="POST" style="display:inline;">';
    echo '<input type="hidden" name="task_index" value="' . array_search($task, $tasks) . '">';
    echo '<button class="delete_button" type="submit">Delete</button>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
}

// Displaying completed tasks
foreach ($completedTasks as $index => $task) {
    $checked = $task[3] == '1' ? 'checked' : '';
    echo '<div class="task completed-task">';
    echo '<form action="update_task.php" method="POST" style="display:inline-block; max-width: 350px;">';
    echo '<input type="hidden" name="task_index" value="' . array_search($task, $tasks) . '">';
    echo '<input type="checkbox" name="completed" ' . $checked . ' onchange="this.form.submit()">';
    echo '<span  class="completed">' . ($task[0]) . '</span>';
    echo '<br>';
    echo '<span class="completed">Difficulty : ' . ($task[1]) . '</span>';
    echo '<span class="completed">Frequency : ' . ($task[2]) . '</span>';
    echo '</form>';
    echo '<div class="task_buttons">';
    echo '<form action="edit_task0.php" method="POST" style="display:inline;">';
    echo '<input type="hidden" name="task_index" value="' . array_search($task, $tasks) . '">';
    echo '<button class="edit_button" type="submit">Edit</button>';
    echo '</form>';
    echo '<form action="delete_task.php" method="POST" style="display:inline;">';
    echo '<input type="hidden" name="task_index" value="' . array_search($task, $tasks) . '">';
    echo '<button class="delete_button" type="submit">Delete</button>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
}
?>
