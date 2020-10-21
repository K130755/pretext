<?php
ob_start();
session_start();
error_reporting(0);
include("admin/inc/conn.php");
include("admin/inc/config.php");
include("inc/func.php");
//============================================
$qContact = mysqli_query($connect,"SELECT * FROM `contact` ORDER BY `id` DESC LIMIT 1");
$sContact = mysqli_fetch_array($qContact);
		$emailContact = $sContact['email'];
		$telefonContact = $sContact['telefon'];
		$adresContact = $sContact['dane_firmy'];
		$facebookContact = $sContact['facebook'];
		$instagramContact = $sContact['instagram'];
		$googleContact = $sContact['google'];
//========= LICZNIK TYDZIEN ==================
$today_is = date("Y-m-d");
if(isset($_COOKIE['licz']) and !empty($_COOKIE['licz'])){}
else
{
//====================
$q_licznik = mysqli_query($connect,"SELECT * FROM `licznik_tydzien` ORDER BY `id` DESC LIMIT 1");
$s_licznik = mysqli_fetch_array($q_licznik);
$today_date_licznik = $s_licznik['today_date'];
$day1_licznik = $s_licznik['day1'];
$day2_licznik = $s_licznik['day2'];
$day3_licznik = $s_licznik['day3'];
$day4_licznik = $s_licznik['day4'];
$day5_licznik = $s_licznik['day5'];
$day6_licznik = $s_licznik['day6'];
$day7_licznik = $s_licznik['day7'];
$id_licznik = $s_licznik['id'];

$dodaj_licznik = $day1_licznik + 1;
mysqli_query($connect,"UPDATE `licznik_tydzien` SET `day1` = $dodaj_licznik WHERE `id` = $id_licznik");
setcookie("licz", "1", time()+60*60*2);
//====================
if($today_is > $today_date_licznik){
mysqli_query($connect,"UPDATE `licznik_tydzien` SET `day7` = $day6_licznik WHERE `id` = $id_licznik");
mysqli_query($connect,"UPDATE `licznik_tydzien` SET `day6` = $day5_licznik WHERE `id` = $id_licznik");
mysqli_query($connect,"UPDATE `licznik_tydzien` SET `day5` = $day4_licznik WHERE `id` = $id_licznik");
mysqli_query($connect,"UPDATE `licznik_tydzien` SET `day4` = $day3_licznik WHERE `id` = $id_licznik");
mysqli_query($connect,"UPDATE `licznik_tydzien` SET `day3` = $day2_licznik WHERE `id` = $id_licznik");
mysqli_query($connect,"UPDATE `licznik_tydzien` SET `day2` = $day1_licznik WHERE `id` = $id_licznik");
mysqli_query($connect,"UPDATE `licznik_tydzien` SET `day1` = 1 WHERE `id` = $id_licznik");
mysqli_query($connect,"UPDATE `licznik_tydzien` SET `today_date` = '$today_is' WHERE `id` = $id_licznik");
}
//====================
}
//============================================
//========= MAILER CONFIG ====================
$q_mail_config = mysqli_query($connect,"SELECT * FROM `mail_config` ORDER BY `id` DESC LIMIT 1");
$n_mail_config = mysqli_num_rows($q_mail_config);
if($n_mail_config > 0){
$s_mail_config = mysqli_fetch_array($q_mail_config);
$email_mail_config = $s_mail_config['email'];
$naglowek_mail_config = $s_mail_config['naglowek'];
$smtp_mail_config = $s_mail_config['smtp'];
$login_mail_config = $s_mail_config['login'];
$haslo_mail_config = $s_mail_config['haslo'];
}
require("admin/modules/phpmailer/class.phpmailer.php");
$mail = new PHPMailer();

$mail->PluginDir = "admin/modules/phpmailer/";
$mail->From = "$email_mail_config"; //adres naszego konta
$mail->FromName = "$naglowek_mail_config";//nagłówek From
$mail->Host = "$smtp_mail_config";//adres serwera SMTP
$mail->SMTPAuth = true;
$mail->Port='25';
$mail->Mailer = "smtp";
$mail->Username = "$login_mail_config";//nazwa użytkownika
$mail->Password = "$haslo_mail_config";//nasze hasło do konta SMTP
$mail->SetLanguage("en", "admin/modules/phpmailer/language/");
$mail->SMTPDebug = 1;
$mail->AddReplyTo($emailContact, $emailContact);
//============================================
if(isset($_SESSION['user_id']) AND !empty($_SESSION['user_id'])){
	$qUserData = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = ".$_SESSION['user_id']);
	$sUserData = mysqli_fetch_array($qUserData);
		$moje_imie = $sUserData['imie'];
		$moje_nazwisko = $sUserData['nazwisko'];
		$my_show_name = $sUserData['show_name'];
		if($my_show_name != "1"){
			$moj_nick = $sUserData['nick'];
			if(empty($moj_nick)){$moj_nick = $moje_imie." ".mb_substr($moje_nazwisko,0,1).".";}
		} else {
			$moj_nick = $moje_imie." ".$moje_nazwisko;
		}
		$moj_email = $sUserData['email'];
		$moj_typ = $sUserData['typ'];
		$moj_avatar = $sUserData['img'];
		$jestem_copywriter = $sUserData['copywriter'];
		$jestem_korektor = $sUserData['korektor'];
		$moj_wallet = $sUserData['wallet'];
		$moje_konto_bankowe = $sUserData['bank_acc'];
			if(empty($moj_avatar)){$moj_avatar = "no_photo.png";}
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pretext - zleć pisanie profesjonalistom</title>
    <link href="images/favicon.ico" type="image/x-icon" rel="icon" />
    <link href="images/favicon.ico" type="image/x-icon" rel="shortcut icon" />
    <link rel="stylesheet" href="css/jquery-ui.min.css" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <link rel="stylesheet" href="css/tagsinput.css" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/fullcalendar.css" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/jquery.datetimepicker.min.css" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/all.css" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/flaticon.css?2" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/pe-icon-7-filled.css" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/helper.css" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/pnotify.css" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/pnotify.buttons.css" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/pnotify.nonblock.css" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/sweetalert2.min.css" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/summernote-lite.css" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/phone.css" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/ion.rangeSlider.min.css" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/multiple-select.min.css" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/banner.css?5e6173b25d01e" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/user.css?5e6173b25d022" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/style.css?5e6173b25d024"  />
    <link rel="stylesheet" href="css/reklamy.css?5e6173b25d024" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/lightbox.min.css" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/select2.min.css" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/daterangepicker.css" media="none" onload="if(media!='all')media='all'" />
    <link rel="stylesheet" href="css/bootstrap-datepicker3.min.css" media="none" onload="if(media!='all')media='all'" />
		<link rel="stylesheet" href="css/custom.css" />
    <script src="js/jquery.min.js" defer></script>
		<style type="text/css">
		#hideMe {
				-webkit-animation: cssAnimation 9s forwards; 
				animation: cssAnimation 9s forwards;
		}
		@keyframes cssAnimation {
				0%   {opacity: 1;}
				90%  {opacity: 1;}
				100% {opacity: 0;}
		}
		@-webkit-keyframes cssAnimation {
				0%   {opacity: 1;}
				90%  {opacity: 1;}
				100% {opacity: 0;}
		}
		</style>
		<script type="text/javascript">
		function setCookie(name, value, days) {
				var d = new Date;
				d.setTime(d.getTime() + 24*60*60*1000*days);
				document.cookie = name + "=" + value + ";path=/;expires=" + d.toGMTString();
		}
		
		function changeBG(newColor){
			document.body.style.backgroundColor = newColor;
			setCookie('background',newColor,'3');
		}
		</script>
		<script>
		function hamFunction(x) {
			x.classList.toggle("change");
		}
		</script>
</head>