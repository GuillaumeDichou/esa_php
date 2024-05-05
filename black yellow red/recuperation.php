<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>recuperation</title>
</head>
<body>
	<?php
	$phrase = $_POST['phrase'];
	if (strlen($phrase) < 10) {
    	echo "La phrase doit avoir au moins 10 caractères.";
    } else {
		$tab_lettres = str_split($phrase);
		$count = count($tab_lettres);
		for($i=0;$i<$count;$i++) {
			if($i % 3 == 0) {
				echo '<span style="color: black;">' . $tab_lettres[$i] . '</span><br />';
			} elseif($i % 3 == 1) {
				echo '<span style="color: yellow;">' . $tab_lettres[$i] . '</span><br />';
			} else {
				echo '<span style="color: red;">' . $tab_lettres[$i] . '</span><br />';
			}
		}
	}
	?>

</body>
</html>
