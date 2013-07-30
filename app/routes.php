<?php

Route::get('/', function()
{

  return Redirect::to('/detect');
});


Route::get('/detect', function() 
{
  if ( ! Input::has('url')) {
    return 'Passe o parâmetro ?url=http://exemplo/imagem.jpg';
  }

  $detector = new Detector;

  $detector->setTargetFromUrl(Input::get('url'));
  
  $detector->detect();
  
  $detector->getSample();
});

Route::get('/square', function($url = null) 
{
  if ( ! Input::has('url')) {
    return 'Passe o parâmetro ?url=http://exemplo/imagem.jpg';
  }

  $detector = new Detector;

  $detector->setTargetFromUrl(Input::get('url'));
  
  $detector->detect();
  
  Log::info($detector->getJson());

  $canvas = $detector->getTarget();
  $coords = $detector->getFaceCoords();

  $crop_w = 220;
  $crop_h = 140;

  // quadrado
  $x = $coords["x"];
  $y = $coords["y"];
  $w = $coords["w"] + $x;
  $h = $coords["w"] + $y;

  // centro
  $cx = ($coords["w"] / 2) + $x;
  $cy = ($coords["w"] / 2) + $y;
  $cw = $cx + 2;
  $ch = $cy + 2;

  // crop
  $rx = $cx - ($crop_w / 2);
  $ry = $cy - ($crop_h / 2);
  $rw = $rx + $crop_w;
  $rh = $ry + $crop_h;
  
  
  $red   = imagecolorallocate($canvas, 255, 0, 0);
  $green = imagecolorallocate($canvas, 0, 255, 0);
  $blue  = imagecolorallocate($canvas, 0, 0, 255);
  
  imagerectangle($canvas, $x, $y, $w, $h, $blue); // quadrado do detection
  imagerectangle($canvas, $cx, $cy, $cw, $ch, $red); // centro
  imagerectangle($canvas, $rx, $ry, $rw, $rh, $green); // crop
  
  header('Content-type: image/jpeg');
  imagejpeg($canvas);

});

Route::get('/thumb', function($url = null) 
{
  if ( ! Input::has('url')) {
    return 'Passe o parâmetro ?url=http://exemplo/imagem.jpg';
  }


  $crop_w = 220;
  $crop_h = 140;

  $dest = imagecreatetruecolor(
      (int) $crop_w,
      (int) $crop_h
    );

  $src = imagecreatefromjpeg(Input::get('url'));

  $isOk = imagecopyresampled(
    $dest,
    $src,
    0,
    0,
    0,
    0,
    imagesx($dest),
    imagesy($dest),
    imagesx($src),
    imagesy($src)
  );

  header('Content-type: image/jpeg');
  imagejpeg($dest);



});