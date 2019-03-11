<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP-slider</title>
</head>
<body>
	
	<?php

	// if ( count($_FILES) > 0 ) {
	// 	echo "<pre>";
	// 	print_r($_FILES);
	// 	echo "</pre>";
	// 	exit();
	// }

	define('HOST', 'http://' . $_SERVER['HTTP_HOST'] . '/');
	define('ROOT', dirname(__FILE__).'/');

	require_once(ROOT . 'db.php');


	if ( count($_FILES) > 0 ) {

		$sliderImages = array();

		for ($i=0; $i < count($_FILES['sliderImages']['name']); $i++) { 
			
			$fileName = $_FILES['sliderImages']['name'][$i];
			$fileType = $_FILES['sliderImages']['type'][$i];
			$fileTmpName = $_FILES['sliderImages']['tmp_name'][$i];
			$fileError = $_FILES['sliderImages']['error'][$i];
			$fileSize = $_FILES['sliderImages']['size'][$i];

			// echo $fileName . "<br>"; // avengers.JPG

			// Находим расширение файла
			$fileExtInArray = explode('.', $fileName); // ['avengers', 'JPG']
			$fileExtAnyCase = end ( $fileExtInArray ); // ['avengers', 'JPG'] => 'JPG'
			$fileExt = strtolower( $fileExtAnyCase ); // 'JPG' => 'jpg'

			// Массив с разрешенными для загрузки расширениями файлов
			$allowed = array('jpg', 'jpeg', 'jfif', 'png');
			// Проверяем, является ли расширение загруженного файла разрешенным для загрузки
			if ( in_array($fileExt, $allowed)) {
				if ( $fileError === 0 ) {
					if ( $fileSize <  5242880 ) {
						// Обрабатываем файл
						$newFileName = uniqid('', true) . "." . $fileExt; // 29871248710943.jpg
						$fileDest = ROOT .'slider/' . $newFileName; // slider/29871248710943.jpg
						move_uploaded_file($fileTmpName, $fileDest);
						echo "<b>Файл был загружен успешно!</b>";

						// Формируем массив с файлами
						$sliderImages[] = $newFileName; // ['29871248710943.jpg', '8232552310943.jpg', '88712355250943.jpg']

					} else {
						echo("Вы загружаете слишком большой файл. Размер файла должен быть меньше чем 5 МБайт.");
					}
				} else {
					echo("Во время загрузки файла произошла ошибка.");
				}
			} else {
				echo("Вы не можете загружать файлы данного типа.");
			}

		}

		$sliderJsonInfo = json_encode($sliderImages);

		$sliderRow = R::dispense('sliders');
		$sliderRow->images = $sliderJsonInfo;
		R::store($sliderRow);
		echo "Всё успешно записано в БД.";
	}
	?>

	<form action="index.php" 
		method="POST" 
		enctype="multipart/form-data" >
		<input type="file" 
			name="sliderImages[]" 
			multiple >
		<!-- <input type="file" name="sliderImage"> -->
		<input type="submit">
	</form>

</body>
</html>