<?php
error_reporting(E_ALL);

$startFullScript = microtime(true);

$time = [
    'full_script' => null,
    'append_image' => null,
    'draw_lines' => null,
    'rotate' => null,
    'gaussian' => null
];

function setTime(string $name, int $t) {
    global $time;
    if (array_key_exists($name, $time)) {
        $time[$name] = (microtime(true) - $t) * 1000 . 'ms';
    }
}

$gaussian = [
    [1, 2, 1],
    [2, 4, 2],
    [1, 2, 1]
];

$img = imagecreatefromjpeg('../images/im3.jpeg');
$im_data = getimagesize('../images/im3.jpeg');
$im1 = imagecreatefromjpeg('../images/im1.jpg');
$im1 = imagescale($im1, 700);

$colors = [
    imagecolorallocatealpha($img, 0, 0, 255, 66),
    imagecolorallocatealpha($img, 255, 255, 255, 66),
];

$startAppendImage = microtime(true);

imagecopy($img, $im1, (imagesx($img) / 2) - (imagesx($im1) / 2), (imagesy($img) / 2) - (imagesy($im1) / 2), 0, 0, imagesx($im1), imagesy($im1));
setTime('append_image', $startAppendImage);

$startDrawLines = microtime(true);
for ($i = 0; $i < $im_data[1]; $i += 2) {
    imageline($img, 0, $i, $im_data[0], $i, $colors[1]);
}

for ($i = 0; $i < $im_data[0]; $i += 2) {
    imageline($img, $i, 0, $i, $im_data[1], $colors[0]);
}

setTime('draw_lines', $startDrawLines);

$startGaussian = microtime(true);
imageconvolution($img, $gaussian, 16, 0);
setTime('gaussian', $startGaussian);

$startRotate = microtime(true);
$img = imagerotate($img, 100, 0);
$img = imagerotate($img, 100, 0);
$img = imagerotate($img, 100, 0);

setTime('rotate', $startRotate);

$img = imagecropauto($img, IMG_CROP_DEFAULT);

setTime('full_script', $startFullScript);

imagejpeg($img, "myimg.jpg", 100);

print_r($time);