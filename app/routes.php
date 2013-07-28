<?php

Route::get('/', function() {

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