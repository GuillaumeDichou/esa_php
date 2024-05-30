<?php

// Check if a color was send by the form
if (isset($_POST['color'])){
    $color = $_POST['color'];
    // Set the cookie with the new color
    setcookie('color', $color, mktime(0,0,0,12,31,2037));
} else {
    // Default value
    $color = 'white';
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cookie colors</title>
</head>
<body style="background-color: <?php echo $color; ?>;">
	<?php
	echo(rand(1,20));
	?>

	<form method="post" action="">
		<select name="color">
			<option value="grey" <?php echo ($color == 'grey') ? 'selected' : ''; ?>>Grey</option>
			<option value="blue" <?php echo ($color == 'blue') ? 'selected' : ''; ?>>Blue</option>
			<option value="green" <?php echo ($color == 'green') ? 'selected' : ''; ?>>Green</option>
			<option value="yellow" <?php echo ($color == 'yellow') ? 'selected' : ''; ?>>Yellow</option>
			<option value="purple" <?php echo ($color == 'purple') ? 'selected' : ''; ?>>Purple</option>
			<option value="orange" <?php echo ($color == 'orange') ? 'selected' : ''; ?>>Orange</option>
			<option value="red" <?php echo ($color == 'red') ? 'selected' : ''; ?>>Red</option>
		</select>
		<button type="submit">Change color</button>
	</form>
</body>
</html>