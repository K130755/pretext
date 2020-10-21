<?php
function showRespond($error,$correct){
	if(!empty($error)){
		errorFIXED($error);
	}
	if(!empty($correct)){
		correctFIXED($correct);
	}
}

function postNotif($user_id,$tytul,$tresc){
	global $connect;
	global $mail;
	
	$tytul = addslashes($tytul);
	$tresc = addslashes($tresc);
	
	mysqli_query($connect,"INSERT INTO `notifs` (`user_id`,`tytul`,`tresc`,`viewed`,`data`) VALUES ('$user_id','$tytul','$tresc','0','".date("Y-m-d H:i")."')");
	//======================================
	$qGetMail = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $user_id");
	$sGetMail = mysqli_fetch_array($qGetMail);
		$emailGetMail = $sGetMail['email'];
		$notifs_onGetMail = $sGetMail['notifs_on'];
			if($notifs_onGetMail == "1"){
														$mail->Subject = "Pretext - Nowe powiadominie";//temat maila
														$mail->AddEmbeddedImage("images/logoMail.png", "baner1", "logoMail.png", "base64");
														$text_body = '<!DOCTYPE html PUBLIC 
														"-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
														<html xmlns="http://www.w3.org/1999/xhtml">
														<head>
														<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
														</head>
														<body style="padding: 0px; margin: 0px;">
														<div style="padding: 10px; background: #3f4e62; font-family: Arial;">
														<BR><CENTER><img src="cid:baner1" /></CENTER>
														<BR><BR>
														<div style="padding: 15px; background: #fff; font-family: Arial;">
														';
														
														$text_body .= "<B>$tytul</B><BR><BR>$tresc<BR><BR>Zaloguj się na swój profil Pretext i sprawdź nowe komunikaty.";
														
														$text_body .= "</div><div style='clear: both; height: 4px;'></div><div style='float: right; color: #fff; font-family: Arial; padding-top: 5px;'>Pretext</div><div style='clear: both; height: 4px;'></div></div></body></html>";

														$mail->Body = $text_body;
														// adresatów dodajemy poprzez metode 'AddAddress'
														$mail->AddAddress($emailGetMail,"Pretext");

														if(!$mail->Send()) echo $mail->ErrorInfo;
														// Clear all addresses and attachments
														$mail->ClearAddresses();
														$mail->ClearAttachments();
			}
}
//======================================================================
function correct($tresc){
	echo '
	<div style="width: 100%; padding: 15px; background: #f2ffe6; border: 1px solid #d9ffb7; border-radius: 5px; color: #2c5b00; margin-top: 10px; margin-bottom: 10px;">
		'.$tresc.'
  </div>
	';
}

function correctIMG($tresc){
	echo '
	<div style="margin-top: 20px; margin-bottom: 20px;">
		<CENTER><img src="images/done.gif" style="max-width: 180px;"><h3 style="color: #626262; margin-top: 0px;">'.$tresc.'</h3></CENTER>
  </div>
	';
}

function info($tresc){
	echo '
	<div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    '.$tresc.'
	</div>
	';
}

function error($tresc){
	echo '
	<div style="width: 100%; padding: 15px; background: #ffe1e1; border: 1px solid #ffc1c1; border-radius: 5px; color: #7d0000; margin-top: 10px; margin-bottom: 10px;">
		'.$tresc.'
  </div>
	';
}

function errorIMG($tresc){
	echo '
	<div style="margin-top: 20px; margin-bottom: 20px;">
		<CENTER><img src="images/warning.png" style="max-width: 140px;"><h3 style="color: #626262;">'.$tresc.'</h3></CENTER>
  </div>
	';
}

function correctFIXED($tresc){
	echo '
	<div id="hideMe" style="color: #5e8b3d; border: 1px solid #d7f6c1; border-radius: 4px; background: #e6fdd5; padding: 10px 20px 10px 20px; position: fixed; z-index: 999999; top: 36px; right: 30px;">
		<i class="fa fa-check" style="position: relative; margin-top: 4px; margin-right: 10px;"></i> '.$tresc.'
	</div>
	';
}

function errorFIXED($tresc){
	echo '
	<div id="hideMe" style="color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px; background: #f8d7da; padding: 10px 20px 10px 20px; position: fixed; z-index: 999999; top: 36px; right: 30px;">
		<i class="fa fa-times" style="position: relative; margin-top: 4px; margin-right: 10px;"></i> '.$tresc.'
	</div>
	';
}
//======================================================================
function mocneStrony($id,$nazwa){
	global $connect;
	$q = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $id AND `mocne_strony` LIKE '%,$nazwa%'");
	$n = mysqli_num_rows($q);
	if($n > 0){
		return 1;
	} else {
		return 0;
	}
}
//======================================================================
function filtrujZlecenia($id,$nazwa){
	global $connect;
	$q = mysqli_query($connect,"SELECT * FROM `filtry` WHERE `user_id` = $id AND `tresc` LIKE '%,$nazwa%'");
	$n = mysqli_num_rows($q);
	if($n > 0){
		return 1;
	} else {
		return 0;
	}
}
//======================================================================
function zlecenieCheckKategoria($id,$nazwa){
	global $connect;
	$q = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $id AND `wykonawca_specjalizacje` LIKE '%,$nazwa%'");
	$n = mysqli_num_rows($q);
	if($n > 0){
		return 1;
	} else {
		return 0;
	}
}
//======================================================================
function href_title($tytul){
$tytul = strip_tags($tytul);
$tytul = str_replace("ę","e",$tytul);
$tytul = str_replace("ó","o",$tytul);
$tytul = str_replace("ą","a",$tytul);
$tytul = str_replace("ś","s",$tytul);
$tytul = str_replace("ł","l",$tytul);
$tytul = str_replace("ż","z",$tytul);
$tytul = str_replace("ź","z",$tytul);
$tytul = str_replace("ć","c",$tytul);
$tytul = str_replace("ń","n",$tytul);

$tytul = str_replace("Ę","e",$tytul);
$tytul = str_replace("Ó","O",$tytul);
$tytul = str_replace("Ą","A",$tytul);
$tytul = str_replace("Ś","S",$tytul);
$tytul = str_replace("Ł","L",$tytul);
$tytul = str_replace("Ż","Z",$tytul);
$tytul = str_replace("Ź","Z",$tytul);
$tytul = str_replace("Ć","C",$tytul);
$tytul = str_replace("Ń","N",$tytul);

$tytul = str_replace(" ","_",$tytul);
$tytul = str_replace("-","_",$tytul);
$tytul = str_replace("'","",$tytul);
$tytul = str_replace('"','',$tytul);
$tytul = str_replace('/','',$tytul);
$tytul = str_replace('\\','',$tytul);
$tytul = str_replace('!','',$tytul);
$tytul = str_replace('?','',$tytul);
$tytul = str_replace('@','',$tytul);
$tytul = str_replace('#','',$tytul);
$tytul = str_replace('$','',$tytul);
$tytul = str_replace('%','',$tytul);
$tytul = str_replace('^','',$tytul);
$tytul = str_replace('&','',$tytul);
$tytul = str_replace('*','',$tytul);
$tytul = str_replace('(','',$tytul);
$tytul = str_replace(')','',$tytul);
$tytul = str_replace(':','',$tytul);
$tytul = str_replace('.','',$tytul);
$tytul = str_replace(',','_',$tytul);
$tytul = strip_tags($tytul);
return $tytul;
}
//======================================================================
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
  imagecopyresampled($canvas, $org, 0, 0, 0, 0,
                     $szerokosc, $wysokosc, $img_szer, $img_wys);
  
	// zapisujemy jako jpeg, jakość 70/100
	if(imagejpeg($canvas, $plik, 100)) {
    return true;
  } else {
    return false;
  }
}
?>