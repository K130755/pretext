<?php

function backBttn($link){
echo "<input type='button' class='btn btn-primary' value='Powrót' id='myBackSubmit' onClick='document.location.href=\"$link\"' style='position: absolute; right: 40px; top: 25px;'>";
}
function backBttn2($link){
echo "<input type='button' class='btn btn-primary' value='Powrót' id='myBackSubmit' onClick='document.location.href=\"$link\"' style='float: right; margin-top: 10px;'><div style='clear: both; height: 10px;'></div>";
}

function error_dis($tresc_error){
echo '<div id="hide_me_after_time" class="alert dark alert-icon alert-danger alert-dismissible" role="alert" style="margin-top: 10px; margin-bottom: 10px;">
       <i class="icon wb-close" aria-hidden="true"></i> '.$tresc_error.'
			</div>';
}

function correct_dis($tresc_correct){
echo '<div id="hide_me_after_time" class="alert dark alert-icon alert-success alert-dismissible" role="alert" style="margin-top: 10px; margin-bottom: 10px;">
        <i class="icon wb-check" aria-hidden="true"></i> '.$tresc_correct.'
			</div>';
}

function komunikat_here($komunikat){
if(!empty($_GET['correct']) OR !empty($_GET['error'])){
//-------------------------------------------
if(!empty($_GET['error'])){
error_dis(constant($komunikat));
}
if(!empty($_GET['correct'])){
correct_dis(constant($komunikat));
}
//-------------------------------------------
}
}

function correctIMG($tresc){
	echo '
	<div style="margin-top: 20px; margin-bottom: 20px;">
		<CENTER><img src="../images/done.gif" style="max-width: 180px;"><h3 style="color: #626262; margin-top: 0px;">'.$tresc.'</h3></CENTER>
  </div>
	';
}

function errorIMG($tresc){
	echo '
	<div style="margin-top: 20px; margin-bottom: 20px;">
		<CENTER><img src="../images/warning.png" style="max-width: 140px;"><h3 style="color: #626262;">'.$tresc.'</h3></CENTER>
  </div>
	';
}

function check_privilages($privilages) {
$admin_id0001 = $_SESSION['admin_id'];
$q0001 = mysql_query("SELECT * FROM `admins_zezwolenia` WHERE `admin_id` = '$admin_id0001' AND `tytul` = '$privilages'");
$n0001 = mysql_num_rows($q0001);
if($n0001 > 0){return 1;} else {return 0;}
/*=====================================*/
}

function clean($data) {
          $data = ereg_replace ("(\t)+", "\t", $data);
          $data = ereg_replace ("\r\n", "", $data);
					
					$array000 = array('"' => '\"', "'" => "\'");
					$data = strtr($data,$array000);
          
					return ereg_replace (" +", " ", $data);
}
//======================================================================
function correct($tresc){
	echo '
	<div class="alert alert-success">
		'.$tresc.'
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

function infoFixed($tresc){
	echo '
	<div class="alert alert-lightred alert-dismissable" style="position: fixed; width: 50%; right: 20px; top: 110px; z-index: 99999999999;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    '.$tresc.'
	</div>
	';
}

function error($tresc){
	echo '
	<div class="alert alert-lightred">
		'.$tresc.'
  </div>
	';
}
//----------------------------------------------------------------------
function showRespond($error,$correct){
	if(!empty($error)){
		echo '
		<div class="alert alert-lightred alert-dismissable">
			'.constant($error).'
		</div>
		';
	}
	if(!empty($correct)){
		echo '
		<div class="alert alert-success alert-dismissable">
			'.constant($correct).'
		</div>
		';
	}
}
//----------------------------------------------------------------------
function privilages($id){
global $connect;
	$qPrivilages = mysqli_query($connect,"SELECT * FROM `admins_zezwolenia` WHERE `admin_id` = ".$_SESSION['admin_id']." AND `perm_id` = ".$id);
	$nPrivilages = mysqli_num_rows($qPrivilages);
	if($nPrivilages > 0 OR $_SESSION['admin_login'] == "root"){} else {header("Location: permsError");exit;}
}
//----------------------------------------------------------------------
function privilagesBin($id){
global $connect;
	$qPrivilages2 = mysqli_query($connect,"SELECT * FROM `admins_zezwolenia` WHERE `admin_id` = ".$_SESSION['admin_id']." AND `perm_id` = ".$id);
	$nPrivilages2 = mysqli_num_rows($qPrivilages2);
	if($nPrivilages2 > 0 OR $_SESSION['admin_login'] == "root"){return 1;} else {return 0;}
}
//======================================================================
function getRate($id){
		global $connect;
		//------------------------------
		$qGetPost = mysqli_query($connect,"SELECT * FROM `blog_posty` WHERE `id` = $id") or die("error");
		$sGetPost = mysqli_fetch_array($qGetPost);
			$totalRate = $sGetPost['ocena'];
			$maxRate = $sGetPost['liczba_ocen'] * 5;
		//------------------------------
		$percentRateFunc = ($totalRate / $maxRate) * 100;
		//##############################
		if($percentRateFunc <= 0){
		$imgRateFunc = "0";
		} else if($percentRateFunc > 0 AND $percentRateFunc <= 20){
		$imgRateFunc = "1";
		} else if($percentRateFunc > 20 AND $percentRateFunc <= 40){
		$imgRateFunc = "2";
		} else if($percentRateFunc > 40 AND $percentRateFunc <= 60){
		$imgRateFunc = "3";
		} else if($percentRateFunc > 60 AND $percentRateFunc <= 80){
		$imgRateFunc = "4";
		} else if($percentRateFunc > 80 AND $percentRateFunc <= 100){
		$imgRateFunc = "5";
		} else {
			$imgRateFunc = "0";
		}
		//==============================
		return $imgRateFunc;
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