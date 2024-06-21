<?php
$taskIndex = $_POST['task_index'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
</head>
<body>
    <form action="edit_task.php" method="POST" class="edit-task">
        <?php echo '<input type="hidden" name="task_index" value="' . $taskIndex . '">';?>
        <input type="text" name="task_name" placeholder="Change task name" required>
        <select name="difficulty">
            <option value="easy">Easy</option>
            <option value="medium">Medium</option>
            <option value="hard">Hard</option>
        </select>
        <select name="frequency">
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
            <option value="one shot">One shot</option>
        </select>
        <button type="submit">Change</button>
    </form>
</body>
</html>