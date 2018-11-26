<?php
error_reporting(E_ALL);

$startFullScript = microtime(true);

$gaussian = [[1, 2, 1],
			 [2, 4, 2],
			 [1, 2, 1]];

$times = [
	'full_script'  => null,
	'append_image' => null,
	'draw_lines'   => null,
	'rotate'       => null,
	'gaussian'     => null
];

$memory = [
	'full_script'  => null,
	'append_image' => null,
	'draw_lines'   => null,
	'rotate'       => null,
	'gaussian'     => null
];

$img = imagecreatefromjpeg('../images/im3.jpeg');
$im_data = getimagesize('../images/im3.jpeg');
$im1 = imagecreatefromjpeg('../images/im1.jpg');
$im1 = imagescale($im1, 700);

$colors = [
	imagecolorallocatealpha ($img, 0, 0, 255, 66),
	imagecolorallocatealpha ($img, 255, 255, 255, 66),
];

$startAppendImage = microtime(true);
imagecopy($img, $im1, (imagesx($img) / 2) - (imagesx($im1) / 2), (imagesy($img) / 2) - (imagesy($im1) / 2), 0, 0, imagesx($im1), imagesy($im1));
$times['append_image'] = (microtime(true) - $startAppendImage) * 1000;

$startDrawLines = microtime(true);
for ($i = 0; $i < $im_data[1]; $i+=2)
	imageline($img, 0, $i, $im_data[0], $i, $colors[1]);

for ($i = 0; $i < $im_data[0]; $i+=2)
	imageline($img, $i, 0, $i, $im_data[1], $colors[0]);
$times['draw_lines'] = (microtime(true) - $startDrawLines) * 1000;

$startGaussian = microtime(true);
imageconvolution($img, $gaussian, 16, 0);
$times['gaussian'] = (microtime(true) - $startGaussian) * 1000;

$startRotate = microtime(true);
$img=imagerotate($img, 100, 0);
$img=imagerotate($img, 100, 0);
$img=imagerotate($img, 100, 0);
$times['rotate'] = (microtime(true) - $startRotate) * 1000;

$img = imagecropauto($img, IMG_CROP_DEFAULT);

$times['full_script'] = (microtime(true) - $startFullScript) * 1000;
imagejpeg($img, "myimg.jpg", 100);

print_r($times);
print_r($memory);