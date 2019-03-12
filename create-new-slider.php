<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP-slider</title>
</head>
<body>
	
	<?php

	define('HOST', 'http://' . $_SERVER['HTTP_HOST'] . '/');
	define('ROOT', dirname(__FILE__).'/');

	require_once(ROOT . 'db.php');

	if ( isset($_POST['slug']) ) {

		$sliderRow = R::dispense('sliders');
		$sliderRow->slug = htmlentities($_POST['slug']);
		$sliderRow->name = htmlentities($_POST['name']);
		R::store($sliderRow);
		echo "Всё успешно записано в БД.";
	}
	?>

	<form method="POST" >
		<input type="text" 
			name="slug" 
			placeholder="slug" >
		<input type="text" 
			name="name" 
			placeholder="Имя слайдера" >
		<input type="submit">
	</form>

</body>
</html>