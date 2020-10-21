<?php
ob_start();
session_start();
error_reporting(0);
if(!isset($_SESSION['admin_id'])){header("Location: login");}
include("inc/conn.php");
include("inc/config.php");
include("inc/func.php");
include("inc/lang.php");
//----------------------------
$qUserInfo = mysqli_query($connect,"SELECT * FROM `admins` WHERE `id` = ".$_SESSION['admin_id']);
$sUserInfo = mysqli_fetch_array($qUserInfo);
$moje_imie = $sUserInfo['imie'];
$moje_nazwisko = $sUserInfo['nazwisko'];
$moje_id = $_SESSION['admin_id'];
$moj_login = $_SESSION['admin_login'];
$my_news_updates = $sUserInfo['news_updates'];
$my_news_added = $sUserInfo['news_added'];
//----------------------------
//========= LICZNIK TYDZIEN ==================
$today_is = date("Y-m-d");
if(isset($_COOKIE['licz']) and !empty($_COOKIE['licz'])){}
else
{
//====================
$q_licznik = mysqli_query($connect,"SELECT * FROM `licznik_logowan` ORDER BY `id` DESC LIMIT 1");
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
mysqli_query($connect,"UPDATE `licznik_logowan` SET `day1` = $dodaj_licznik WHERE `id` = $id_licznik");
setcookie("licz", "1", time()+60*60*2);
//====================
if($today_is > $today_date_licznik){
mysqli_query($connect,"UPDATE `licznik_logowan` SET `day7` = $day6_licznik WHERE `id` = $id_licznik");
mysqli_query($connect,"UPDATE `licznik_logowan` SET `day6` = $day5_licznik WHERE `id` = $id_licznik");
mysqli_query($connect,"UPDATE `licznik_logowan` SET `day5` = $day4_licznik WHERE `id` = $id_licznik");
mysqli_query($connect,"UPDATE `licznik_logowan` SET `day4` = $day3_licznik WHERE `id` = $id_licznik");
mysqli_query($connect,"UPDATE `licznik_logowan` SET `day3` = $day2_licznik WHERE `id` = $id_licznik");
mysqli_query($connect,"UPDATE `licznik_logowan` SET `day2` = $day1_licznik WHERE `id` = $id_licznik");
mysqli_query($connect,"UPDATE `licznik_logowan` SET `day1` = 1 WHERE `id` = $id_licznik");
mysqli_query($connect,"UPDATE `licznik_logowan` SET `today_date` = '$today_is' WHERE `id` = $id_licznik");
}
//====================
}
//============================================
$qContact = mysqli_query($connect,"SELECT * FROM `contact` ORDER BY `id` DESC LIMIT 1");
$sContact = mysqli_fetch_array($qContact);
		$emailContact = $sContact['email'];
		$telefonContact = $sContact['telefon'];
		$adresContact = $sContact['dane_firmy'];
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
require("modules/phpmailer/class.phpmailer.php");
$mail = new PHPMailer();

$mail->PluginDir = "modules/phpmailer/";
$mail->From = "$email_mail_config"; //adres naszego konta
$mail->FromName = "$naglowek_mail_config";//nagłówek From
$mail->Host = "$smtp_mail_config";//adres serwera SMTP
$mail->SMTPAuth = true;
$mail->Port='25';
$mail->Mailer = "smtp";
$mail->Username = "$login_mail_config";//nazwa użytkownika
$mail->Password = "$haslo_mail_config";//nasze hasło do konta SMTP
$mail->SetLanguage("en", "modules/phpmailer/language/");
$mail->SMTPDebug = 1;
$mail->AddReplyTo($emailContact, $emailContact);
//============================================
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Pretext - Panel Administracyjny</title>
        <link rel="icon" type="image/ico" href="assets/images/favicon.ico" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- ============================================
        ================= Stylesheets ===================
        ============================================= -->
        <!-- vendor css files -->
        <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/vendor/animate.css">
        <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
        <link rel="stylesheet" href="assets/js/vendor/animsition/css/animsition.min.css">
        <link rel="stylesheet" href="assets/js/vendor/daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" href="assets/js/vendor/morris/morris.css">
        <link rel="stylesheet" href="assets/js/vendor/owl-carousel/owl.carousel.css">
        <link rel="stylesheet" href="assets/js/vendor/owl-carousel/owl.theme.css">
        <link rel="stylesheet" href="assets/js/vendor/rickshaw/rickshaw.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/datatables.bootstrap.min.css">
        <link rel="stylesheet" href="assets/js/vendor/chosen/chosen.css">
        <link rel="stylesheet" href="assets/js/vendor/summernote/summernote.css">

        <!-- project main css files -->
        <link rel="stylesheet" href="assets/css/main.css">
        <!--/ stylesheets -->
        <!-- ==========================================
        ================= Modernizr ===================
        =========================================== -->
        <script src="assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <!--/ modernizr -->
				<style type='text/css'>
				@media (max-width: 900px) {
					#hideOnTel {
					display: none;
					}
				}
			</style>
    </head>
    <body id="minovate" class="appWrapper">

        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->