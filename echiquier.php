<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style>
		.chessboard {
            border: 2px solid black;
            width: 560px; /* square size by 8*/
            margin: 0 auto; /* center*/
            margin-top: 40px;
        }
		.square {
			height: 70px;
			width: 70px;
			float: left;
		}
		.color1 {
			background-color: red; 
		}
		.color2 {
			background-color: yellow;
		}
		.row:after { /* moves to the next line*/
            content: "";
            display: table;
            clear: both;
        }
	</style>
</head>
<body>
<?php
$chessboard = '<div class="chessboard">';
for($row=1;$row<=8;$row++) {
	$chessboard .= '<div class="row">';
	for($col=1;$col<=8;$col++) {
		$color = ($row + $col) % 2 == 0 ? 'color2' : 'color1';
		$chessboard .= '<div class="square ' . $color . '"></div>';
	}
	$chessboard .= '</div>';
}
$chessboard .= '</div>';
echo $chessboard;
?>
</body>
</html>