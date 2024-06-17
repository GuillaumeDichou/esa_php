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

// Displaying unfinished tasks
foreach ($incompleteTasks as $index => $task) {
    $checked = $task[3] == '1' ? 'checked' : ''; // Determining checkbox status
    echo '<div class="task">';
    echo '<form action="update_task.php" method="POST" style="display:inline;">'; // Creates a form to update task status
    echo '<input type="hidden" name="task_index" value="' . array_search($task, $tasks) . '">'; // Adds a hidden field containing the task index to the $tasks array. This lets update_task.php know which task needs updating.
    echo '<input type="checkbox" name="completed" ' . $checked . ' onchange="this.form.submit()">'; // Check box to mark task completed
    echo '<span>' . htmlspecialchars($task[0]) . '</span>';
    echo '<span>Difficulty : ' . htmlspecialchars($task[1]) . '</span>';
    echo '<span>Frequency : ' . htmlspecialchars($task[2]) . '</span>';
    echo '</form>';
    // Form to delete task
    echo '<form action="delete_task.php" method="POST" style="display:inline;">';
    echo '<input type="hidden" name="task_index" value="' . array_search($task, $tasks) . '">';
    echo '<button type="submit">Delete</button>';
    echo '</form>';
    echo '</div>';
}

// Displaying completed tasks
foreach ($completedTasks as $index => $task) {
    $checked = $task[3] == '1' ? 'checked' : '';
    echo '<div class="task completed-task">';
    echo '<form action="update_task.php" method="POST" style="display:inline;">';
    echo '<input type="hidden" name="task_index" value="' . array_search($task, $tasks) . '">';
    echo '<input type="checkbox" name="completed" ' . $checked . ' onchange="this.form.submit()">';
    echo '<span>' . htmlspecialchars($task[0]) . '</span>';
    echo '<span>Difficulty : ' . htmlspecialchars($task[1]) . '</span>';
    echo '<span>Frequency : ' . htmlspecialchars($task[2]) . '</span>';
    echo '</form>';
    echo '<form action="delete_task.php" method="POST" style="display:inline;">';
    echo '<input type="hidden" name="task_index" value="' . array_search($task, $tasks) . '">';
    echo '<button type="submit">Delete</button>';
    echo '</form>';
    echo '</div>';
}
?>
