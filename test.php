<?php

$sliderImgs = [
	'img001.jpg',
	'img002.jpg',
	'img003.jpg',
	'img004.jpg',
];

$serialized = serialize($sliderImgs);
echo $serialized . "<br>";

echo "<pre>";
print_r(unserialize($serialized));
echo "<br><br>";

$json = json_encode($sliderImgs);
echo $json. "<br><br>";

print_r( json_decode($json) );
echo "<br><br></pre>";

?>