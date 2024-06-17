<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo-List Gamified</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="header">
        <div class="custom-select">
          <select id="menu" onchange="location = this.value;">
            <option value="index.php" <?php echo !isset($_GET['frequency']) && !isset($_GET['difficulty']) ? 'selected' : ''; ?>>All tasks</option>
            <option value="index.php?frequency=daily" <?php echo isset($_GET['frequency']) && $_GET['frequency'] == 'daily' ? 'selected' : ''; ?>>Daily tasks</option>
            <option value="index.php?frequency=weekly" <?php echo isset($_GET['frequency']) && $_GET['frequency'] == 'weekly' ? 'selected' : ''; ?>>Weekly tasks</option>
            <option value="index.php?frequency=monthly" <?php echo isset($_GET['frequency']) && $_GET['frequency'] == 'monthly' ? 'selected' : ''; ?>>Monthly tasks</option>
            <option value="index.php?frequency=yearly" <?php echo isset($_GET['frequency']) && $_GET['frequency'] == 'yearly' ? 'selected' : ''; ?>>Yearly tasks</option>
            <option value="index.php?frequency=one shot" <?php echo isset($_GET['frequency']) && $_GET['frequency'] == 'one shot' ? 'selected' : ''; ?>>One shot tasks</option>
            <option value="index.php?difficulty=easy" <?php echo isset($_GET['difficulty']) && $_GET['difficulty'] == 'easy' ? 'selected' : ''; ?>>Easy tasks</option>
            <option value="index.php?difficulty=medium" <?php echo isset($_GET['difficulty']) && $_GET['difficulty'] == 'medium' ? 'selected' : ''; ?>>Medium tasks</option>
            <option value="index.php?difficulty=hard" <?php echo isset($_GET['difficulty']) && $_GET['difficulty'] == 'hard' ? 'selected' : ''; ?>>Hard tasks</option>
          </select>
        </div>
        <h1>Todo-list Gamified</h1>
    </div>

    <div class="container">

        <div class="rules">
            <h1>Rules :</h1>
            <p>Welcome to the todo-list game!</p>
            <p>You can add or delete tasks as needed.</p>
            <p>Each time you finish a task, you can earn XP by checking it.</p>
            <p>Your stats can be viewed in your profile on the right.</p>
            <h2>Level up System</h2>
            <ul>
                <li>You start at Level 1.</li>
                <li>To level up, you need to earn XP. The amount of XP needed to level up is equal to your current level + 9.</li>
            </ul>
            <h2>XP Rewards</h2>
            <p>The amount of XP you earn for completing a task depends on the task's difficulty and frequency:</p>
            <ul>
                <li>Easy Tasks:
                    <ul>
                        <li>Daily: 1 XP</li>
                        <li>Weekly: 7 XP</li>
                        <li>Monthly: 30 XP</li>
                        <li>Yearly: 365 XP</li>
                        <li>One Shot: 5 XP</li>
                    </ul>
                </li>
                <li>Medium Tasks:
                    <ul>
                        <li>Daily: 2 XP</li>
                        <li>Weekly: 14 XP</li>
                        <li>Monthly: 60 XP</li>
                        <li>Yearly: 730 XP</li>
                        <li>One Shot: 100 XP</li>
                    </ul>
                </li>
                <li>Hard Tasks:
                    <ul>
                        <li>Daily: 3 XP</li>
                        <li>Weekly: 21 XP</li>
                        <li>Monthly: 90 XP</li>
                        <li>Yearly: 1095 XP</li>
                        <li>One Shot: 2000 XP</li>
                    </ul>
                </li>
            </ul>
            <h2>Rank System</h2>
            <p>Your rank changes every 5 levels.</p>
            <p>Challenger is the highest rank.</p>
            <h2>Enjoy the Game!</h2>
        </div>

        <div class="container2">

            <form action="add_task.php" method="POST" class="add-task">
                <input type="text" name="task_name" placeholder="Add a new task" required>
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
                <button type="submit">Add</button>
            </form>
            
            <div class="tasks">
                <?php include 'display_tasks.php'; ?>
            </div>
            
        </div>

        <div class="profile-container">
            <?php

            $file = fopen("profile.csv", "r");

            while(!feof($file)) {
                $contentFile[] = fgetcsv($file);
            }

            fclose($file);

            $level = $contentFile[0][0];
            $rank = $contentFile[1][0];
            $xp = $contentFile[2][0];

            ?>
            <h1>Profile</h1>
            <div class="profile-info">
                <div class="profile-item">
                    <span>Level:</span>
                    <span id="level"><?php echo $level; ?></span>
                </div>
                <div class="profile-item">
                    <span>Rank:</span>
                    <span id="rank"><?php echo $rank ?></span>
                </div>
                <div class="profile-item">
                    <span>XP:</span>
                    <span id="xp"><?php echo $xp ?></span>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
