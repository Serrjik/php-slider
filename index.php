<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
	<?php

	// if ( count($_FILES) > 0 ) {
	// 	echo "<pre>";
	// 	print_r($_FILES);
	// 	echo "</pre>";
	// 	exit();
	// }

	if ( count($_FILES) > 0 ) {

		for ($i=0; $i < count($_FILES['sliderImages']['name']); $i++) { 
			
			$fileName = $_FILES['sliderImages']['name'][i];
			$fileType = $_FILES['sliderImages']['type'][i];
			$fileTmpName = $_FILES['sliderImages']['tmp_name'][i];
			$fileError = $_FILES['sliderImages']['error'][i];
			$fileSize = $_FILES['sliderImages']['size'][i];

			// echo $fileName . "<br>"; // avengers.JPG

			// Находим расширение файла
			$fileExt = strtolower( end ( explode('.', $fileName) ) ); // ['avengers', 'JPG'] => 'JPG' => 'jpg'

			echo $fileExt; // jpg

			// Массив с разрешенными для загрузки расширениями файлов
			$allowed = array('jpg', 'jpeg', 'jfif', 'png');
			// Проверяем, является ли расширение загруженного файла разрешенным для загрузки
			if ( in_array($fileExt, $allowed)) {
				if ( $fileError === 0 ) {
					if ( $fileSize <  5242880 ) {
						// Обрабатываем файл
						$newFileName = uniqid('', true) . "." . $fileExt; // 29871248710943.jpg
						$fileDest = 'slider/' . $newFileName; // slider/29871248710943.jpg
						move_uploaded_file($fileTmpName, $fileDest);
						echo "<b>Файл был загружен успешно!</b>";
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