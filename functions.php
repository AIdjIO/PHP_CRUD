<?php

function createVisitorBadge($width,$height, $firstName, $lastName, $dept){
    // Create the size of image or blank image 
    // 354 x 574
$image = imagecreatetruecolor($width, $height); 
$fontfile = __DIR__ ."/assets/fonts/helvetica.ttf";
// Set the background color of image 
$background_color = imagecolorallocate($image, 255, 255, 255); 
  
// Set the text color of image 
$text_color = imagecolorallocate($image, 0, 0, 0); 

// Make the background red
imagefilledrectangle($image, 0, 0, $width, $height, $background_color);

// Function to create image which contains string. 
imagettftext($image, 20,0, 50, 50,  $text_color, $fontfile, $firstName ); 
imagettftext($image, 20,0, 50, 100, $text_color, $fontfile, $lastName ); 
imagettftext($image, 20,0, 50, 150, $text_color, $fontfile, $dept ); 
$rotatedImg = imagerotate($image, 90,0);

header("Content-Type: image/png"); 
  
imagepng($rotatedImg,'hello.png'); 
imagedestroy($image); 
}