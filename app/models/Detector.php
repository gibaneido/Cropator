<?php

class Detector {
  
  private $engine;

  private $target;

  public function __construct()
  {
    $this->engine = new Face_Detector('../vendor/marcelomx/php-facedetection/detection.dat');
  }

  public function setTargetFromUrl($url)
  {
   $data = file_get_contents(Input::get('url'));

   $this->target = imagecreatefromstring($data);
  }

  public function detect()
  {
    $this->engine->face_detect($this->target);
  }

  public function getSample()
  {
    return $this->engine->toJpeg();
  }

}
