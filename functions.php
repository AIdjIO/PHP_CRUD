<?php

include('../phpqrcode/qrlib.php');

function createVisitorBadge($width,$height, $firstName, $lastName, $dept,$phone_number){

    // Create the size of image or blank image 
    // 354 x 574
$image = imagecreatetruecolor($width, $height); 
$fontfile = __DIR__ . "/assets/fonts/helvetica.ttf";
// Set the background color of image 
$background_color = imagecolorallocate($image, 255, 255, 255); 
  
// Set the text color of image 
$text_color = imagecolorallocate($image, 0, 0, 0); 

// Make the background red
imagefilledrectangle($image, 0, 0, $width, $height, $background_color);

// Function to create image which contains string. 
$text_content = "Visitor" . "\n" . ucfirst(strtolower($firstName)) . " " . strtoupper($lastName) ."\n"  . strtolower($dept) ."\n". $phone_number . "\n" . 'VALID ' . date("D d/M/Y") ;
imagettftext($image, 35,0, 20, 160,  $text_color, $fontfile, ucfirst(strtolower($firstName)) ." " . strtoupper($lastName)); 
imagettftext($image, 25,0, 20, 210, $text_color, $fontfile, strtoupper($dept) ); 
imagettftext($image, 40,0, 330, 60, $text_color, $fontfile, 'VISITOR' ); 
imagettftext($image, 30,0, 20, 310, $text_color, $fontfile, 'VALID ' . date("D d/M/Y")); 
QRcode::png($text_content, __DIR__ . '/assets/images/QR_Code.png', QR_ECLEVEL_L, 3);

$image = imagerotate($image, 90,0);

header("Content-Type: image/png"); 
  
imagepng($image,__DIR__ . '/assets/images/label.png'); 

$dest = imagecreatefrompng(__DIR__ . '/assets/images/label.png');
$src = imagecreatefrompng(__DIR__ . '/assets/images/QR_Code.png');
$logoPath =__DIR__ . '/assets/images/logo_90d.png';
$srcLogo = imagecreatefrompng($logoPath);

// Copy and merge
imagecopymerge($dest, $src, 230,0, 0, 0, 111, 111, 100);
imagecopymerge($dest, $srcLogo, 20,435, 0, 0, 46, 109, 100);
imagepng($dest,'label.png');

imagedestroy($image); 
imagedestroy($dest); 
unlink(__DIR__ . '/assets/images/QR_Code.png');
}