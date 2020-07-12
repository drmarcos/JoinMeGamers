<?php
/*http://www.phpjabbers.com/captcha-image-verification-php19-19.html#comments*/
session_start();
// Generate a random character string
function rand_str($length = 32, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890')
{
// Length of character list
$chars_length = (strlen($chars) - 1);
 
// Start our string
$string = $chars{rand(0, $chars_length)};
 
// Generate random string
for ($i = 1; $i < $length; $i = strlen($string))
{
// Grab a random character from our list
$r = $chars{rand(0, $chars_length)};
 
// Make sure the same two characters don't appear next to each other
if ($r != $string{$i - 1}) $string .= $r;
}
 
// Return the string
return $string;
}
 
//$text = rand_str($length = 6, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890');
$text = $_SESSION['autenticagd'];

//$text = rand(10000,abcdefg);
//$_SESSION["vercode"] = $text;
$height = 80;
$width = 180;

  
$image_p = imagecreate($width, $height);
$black = imagecolorallocate($image_p, 171, 105, 213);
$white = imagecolorallocate($image_p, 255, 255, 255);
$font_size = imageloadfont('./atommicclock.gdf');
  
imagestring($image_p, $font_size, 20, 25, $text, $white);
imagejpeg($image_p, null, 100);
?>


