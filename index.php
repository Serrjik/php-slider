<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Slider</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
</head>
<body>
	
	<?php

		define('HOST', 'http://' . $_SERVER['HTTP_HOST'] . '/');
		define('ROOT', dirname(__FILE__).'/');
		require_once(ROOT . 'db.php');

		$sliderArray = R::findOne('sliders', ' slug = ? ', ['main']);

		$sliderImages = json_decode( $sliderArray['images'] );

		// echo "<pre>";
		// print_r($sliderImages);
		// echo "</pre>";

		// foreach ($sliderImages as $key => $slider) {
		// 	echo "$slider <br>";
		// }

	?>

	<div class="owl-carousel owl-theme" 
		style="width: 200px;" >

		<?php foreach ($sliderImages as $key => $slider): ?>
			<img src="<?= HOST . 'slider/' . $slider ?>" alt="">
		<?php endforeach ?>

	</div>

	<a href="edit.php?sliderId=<?=$sliderArray['id']?>">Редактировать слайдер</a>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

	<script>
		$(document).ready(function(){
		  $('.owl-carousel').owlCarousel({
		  	items: 1
		  });
		});
	</script>

</body>
</html>