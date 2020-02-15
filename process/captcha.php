<?php 
  session_start();
  header('Content-type: image/jpeg');
  $text = $_SESSION['captext'];
  $font_size = 30;
  $img_height = 50;
  $img_width = 170;
  $img = imagecreate($img_width, $img_height);
  imagecolorallocate($img, 225, 225, 225);
  $text_color = imagecolorallocate($img, 0, 0, 0);
  for ($x=1; $x<=80; $x++){
      $x1 =rand(1, 155);
      $y1 =rand(1, 155);
      $x2 =rand(1, 155);
      $y2 =rand(1, 155);

      imageline($img, $x1, $y1, $x2, $y2, $text_color);
  } 
  
  imagettftext($img, $font_size, 9, 10, 50, $text_color, '../fonts/Roboto-Light.ttf', $text);
  imagejpeg($img);

?>