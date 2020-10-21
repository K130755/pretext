<?php
ob_start();
session_start();
include("admin/inc/conn.php");
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
//======================================================================
//======================================================================
$q1 = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `newsletter_sent` = '0' AND (`wykonawca_id` = '0' OR `wykonawca_id` = '')");
$n1 = mysqli_num_rows($q1);
if($n1 > 0){
	$mail_text = "";
	while($s1 = mysqli_fetch_array($q1)){
		$id1 = $s1['id'];
		$tytul1 = $s1['tytul'];
		$kategoria1 = $s1['kategoria'];
		$typ_tekstu1 = $s1['typ_tekstu'];
		//------------------------------------------------------------------
		$q2 = mysqli_query($connect,"SELECT * FROM `users` WHERE `typ` = 'wykonawca' AND `mocne_strony` LIKE '%,$kategoria1%' OR `mocne_strony` LIKE '%,$typ_tekstu1%'");
		$n2 = mysqli_num_rows($q2);
		if($n2 > 0){
			while($s2 = mysqli_fetch_array($q2)){
				$id2 = $s2['id'];
				mysqli_query($connect,"INSERT INTO `newsletter_cron_messages` (`user_id`,`zlecenie_id`,`zlecenie_tytul`) VALUES ('$id2','$id1','$tytul1')");
			}
		}
		//------------------------------------------------------------------
	}
	//--------------------------------------------------------------------
	$q3 = mysqli_query($connect,"SELECT * FROM `newsletter_cron_messages` GROUP BY `user_id`");
	$n3 = mysqli_num_rows($q3);
	if($n3 > 0){
		while($s3 = mysqli_fetch_array($q3)){
			$user_id3 = $s3['user_id'];
			$q3_2 = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $user_id3");
			$s3_2 = mysqli_fetch_array($q3_2);
				$email3 = $s3_2['email'];
				$imie3 = $s3_2['imie'];
				$nazwisko3 = $s3_2['nazwisko'];
				$nick3 = $s3_2['nick'];
				if(empty($imie3) AND empty($nazwisko3)){
					if(empty($nick3)){
						$nazwa3 = "Użytkowniku";
					} else {$nazwa3 = $nick3;}
				} else {$nazwa3 = $imie3." ".$nazwisko3;}
			$q4 = mysqli_query($connect,"SELECT * FROM `newsletter_cron_messages` WHERE `user_id` = $user_id3");
			$n4 = mysqli_num_rows($q4);
			if($n4 > 0){
				while($s4 = mysqli_fetch_array($q4)){
					$zlecenie_id4 = $s4['zlecenie_id'];
					$q4_2 = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $zlecenie_id4");
					$s4_2 = mysqli_fetch_array($q4_2);
						$tytul4 = $s4_2['tytul'];
					$mail_text .= "<a href='https://pretext.eu/setMeUp-$zlecenie_id4' style='text-decoration: none;'>$tytul4</a><BR>";
				}
				//--------------------------------------------------------------
				$mail->Subject = "Pretext - Nowe zlecenia w Twoim zakresie zainteresowan";//temat maila
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
				
				$text_body .= "<B>Witaj, $nazwa3</B><BR><BR>Informujemy, iż na portalu pretext.eu zostały dodane nowe zlecenia w kategoriach, które wskazałeś jako swoje mocne strony.<BR>Poniżej znajdziesz pełną listę nowych zleceń.<BR><BR>";
				$text_body .= $mail_text;
				
				$text_body .= "</div><div style='clear: both; height: 4px;'></div><div style='float: right; color: #fff; font-family: Arial; padding-top: 5px;'>Pretext</div><div style='clear: both; height: 4px;'></div></div></body></html>";

				$mail->Body = $text_body;
				// adresatów dodajemy poprzez metode 'AddAddress'
				$mail->AddAddress($email3,"Pretext");

				if(!$mail->Send()) echo $mail->ErrorInfo;
				// Clear all addresses and attachments
				$mail->ClearAddresses();
				$mail->ClearAttachments();
				//--------------------------------------------------------------
				$mail_text = "";
			}
		}
	}
	//--------------------------------------------------------------------
}
mysqli_query($connect,"UPDATE `zlecenia` SET `newsletter_sent` = '1' WHERE `newsletter_sent` = '0'");
mysqli_query($connect,"TRUNCATE TABLE `newsletter_cron_messages`");
?>