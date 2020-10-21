<?php
ob_start();
session_start();
include("../../../../inc/config.php");
include("../../../../inc/conn.php");
//--------------------
function resize($plik,$szerokosc) {
  $i = explode('.', $plik);
  // rozszerzeniem pliku jest ostatni element tablicy $i
  $rozszerzenie = end($i);
 
  // jeśli nie mamy jpega, gifa lub png zwracamy false.
  if($rozszerzenie !== 'jpg' &&
		 $rozszerzenie !== 'JPG' &&
		 $rozszerzenie !== 'jpeg' &&
		 $rozszerzenie !== 'JPEG' &&
     $rozszerzenie !== 'gif' &&
		 $rozszerzenie !== 'GIF' &&
		 $rozszerzenie !== 'PNG' &&
     $rozszerzenie !== 'png') {
    return false;
  }
 
  // pobieramy rozmiary obrazka
  list($img_szer, $img_wys) = getimagesize($plik);
 
  // obliczamy proporcje boków
  $proporcje = $img_wys / $img_szer;
 
  // na tej podstawie obliczamy wysokość
  $wysokosc = $szerokosc * $proporcje;
 
  // tworzymy nowy obrazek o zadanym rozmiarze
  // korzystamy tu z funkcji biblioteki GD
  // która musi być dołączona do twojej instalacji PHP,
  // najpierw tworzymy canvas.
  $canvas = imagecreatetruecolor($szerokosc, $wysokosc);
  switch($rozszerzenie) {
    case 'jpg':
      $org = imagecreatefromjpeg($plik);
      break;
		case 'JPG':
      $org = imagecreatefromjpeg($plik);
      break;
		case 'jpeg':
      $org = imagecreatefromjpeg($plik);
      break;
		case 'JPEG':
      $org = imagecreatefromjpeg($plik);
      break;
    case 'gif':
      $org = imagecreatefromgif($plik);
      break;
		case 'GIF':
      $org = imagecreatefromgif($plik);
      break;
    case 'png':
      $org = imagecreatefrompng($plik);
      break;
		case 'PNG':
      $org = imagecreatefrompng($plik);
      break;
  }
 
  // kopiujemy obraz na nowy canvas
  imagecopyresampled($canvas, $org, 0, 0, 0, 0, $szerokosc, $wysokosc, $img_szer, $img_wys);
  
	// zapisujemy jako jpeg, jakość 70/100
	if(imagejpeg($canvas, $plik, 100)) {
    return true;
  } else {
    return false;
  }
}
//--------------------
error_reporting(0);
require('UploadHandler.php');
$upload_handler = new UploadHandler();