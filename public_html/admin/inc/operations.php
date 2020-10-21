<section id="content">
                <div class="page page-dashboard">
                    <div class="pageheader">
                        <h2>AdminPanel <strong>2.0</strong> <span>// Nowoczesny panel do zarządzania portalem</span></h2>
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index"><i class="fa fa-home"></i> Strona Główna</a>
                                </li>
                                <?php include("inc/navi.php"); ?>
                            </ul>
                            <div class="page-toolbar">
                                <a role="button" tabindex="0" class="btn btn-lightred no-border">
                                    <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span></span> <span id='hideOnTel'><?=date("d.m.Y"); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
<?php
//======================================================================
$sid = trim(addslashes(strip_tags($_GET['sid'])));
switch($sid){
//======================================================================
case 1:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Administratorzy</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
echo "<h3>Zarządzanie kontem</h3>";
echo "
<CENTER>
<span style='font-weight: bold; font-size: 16px;'>".$_SESSION['admin_login']."</span>
<div style='height: 4px;'></div>
<div style='width: 260px;'>
<form action='index.php?sid=2' method='post'>
";
echo '
<div class="form-group form-material floating" style="padding-top: 0px; margin-top: 0px;">
  <input type="password" class="form-control" name="pass" />
  <label class="floating-label">Wpisz nowe hasło</label>
</div>';
echo "
<div style='height: 4px;'></div>
";
echo '
<div class="form-group form-material floating" style="padding-top: 0px; margin-top: 0px;">
  <input type="password" class="form-control" name="pass2" />
  <label class="floating-label">Powtórz nowe hasło</label>
</div>';
echo "
<div style='height: 6px;'></div>
<input type='submit' value='Zapisz' class='btn btn-primary'>
</form>
</div>
</CENTER>
";
//-----------
 echo '</div></section>'; 
 break;

case 2:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Administratorzy</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
echo "<h3>Zarządzanie kontem</h3>";
echo "<a href='index.php'>Strona Główna</a> > <a href='index.php?sid=1'>Zarządzanie kontem</a>";
//-----------------------------------------------------
$pass2_1 = $_POST['pass'];
$pass2_2 = $_POST['pass2'];
if(!empty($pass2_1) AND !empty($pass2_2)){
if($pass2_1 == $pass2_2){
$pass2_1 = sha1(md5($pass2_1));
mysqli_query($connect,"UPDATE `admins` SET `password` = '$pass2_1' WHERE `id` = ".$_SESSION['admin_id']);
header("Location: index.php?sid=1&correct=SAVED");
} else {header("Location: index.php?sid=1&error=PASS_ARE_NOT_THE_SAME");}
} else {header("Location: index.php?sid=1&error=NIE_WYPELNIONO");}
//-----------
echo '</div></section>'; 
break;

case 3:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Administratorzy</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
session_destroy();
header("Location: login.php");
//-----------
echo '</div></section>';
break;

case 4:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Użytkownicy</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	echo "<h3>Użytkownicy</h3>";
	$q4 = mysqli_query($connect,"SELECT * FROM `users` ORDER BY `id` DESC");
	$n4 = mysqli_num_rows($q4);
	if($n4 > 0){
		echo "<table class='table table-striped'>
		<tr>
			<td style='font-weight: bold;'>Imię i nazwisko</td>
			<td style='font-weight: bold;'>Typ</td>
			<td style='font-weight: bold;'>Copywriter</td>
			<td style='font-weight: bold;'>Korektor</td>
			<td style='font-weight: bold;'>Kontakt</td>
			<td style='font-weight: bold;'>Firma</td>
			<td style='font-weight: bold; text-align: center;'>Portfel</td>
			<td style='font-weight: bold; width: 1%;' nowrap='nowrap'>Aktywne</td>
			<td style='font-weight: bold; width: 1%;' nowrap='nowrap'>Akcje</td>
		</tr>
		";
		while($s4 = mysqli_fetch_array($q4)){
			$id4 = $s4['id'];
			$imie4 = $s4['imie']." ".$s4['nazwisko'];
			$email4 = $s4['email'];
			$telefon4 = $s4['telefon'];
			$wallet4 = $s4['wallet'];
			$typ4 = $s4['typ'];
			$copywriter4 = $s4['copywriter'];
			$korektor4 = $s4['korektor'];
			$copywriter_rozwiazanie4 = $s4['copywriter_rozwiazanie'];
			$korektor_rozwiazanie4 = $s4['korektor_rozwiazanie'];
				if($typ4 == "wykonawca"){$typ4 = "Wykonawca";} else {$typ4 = "Zleceniodawca";}
			if(!empty($s4['nazwa_firmy'])){
				$firma4 = "<B>".$s4['nazwa_firmy']."</B><BR>".$s4['ulica']." ".$s4['nr_domu']."<BR>".$s4['zip']." ".$s4['miasto']."<BR>NIP: ".$s4['nip']."<BR>REGON: ".$s4['regon'];
			} else {$firma4 = "-";}
			$active4 = $s4['active'];
			if($active4 == "1"){$active4 = "<i class='fa fa-check-circle' style='font-size: 16px; color: green;'></i>";} else {$active4 = "<i class='fa fa-clock-o' style='font-size: 16px; color: #bbbbbb;'></i>";}
			
			echo "
			<tr>
				<td>$imie4</td>
				<td>$typ4</td>
				<td>"; if($copywriter4 == "1"){echo "<i class='fa fa-check-circle' style='font-size: 16px; color: green;'></i>";} else {if(!empty($copywriter_rozwiazanie4)){echo "<i class='fa fa-clock-o' style='font-size: 16px; color: #bbbbbb;'></i><BR><a href='index.php?sid=5&id=$id4'>Sprawdź rozwiązanie testu</a>";} else {echo "-";}} echo "</td>
				<td>"; if($korektor4 == "1"){echo "<i class='fa fa-check-circle' style='font-size: 16px; color: green;'></i>";} else {if(!empty($korektor_rozwiazanie4)){echo "<i class='fa fa-clock-o' style='font-size: 16px; color: #bbbbbb;'></i><BR><a href='index.php?sid=5&id=$id4'>Sprawdź rozwiązanie testu</a>";} else {echo "-";}} echo "</td>
				<td>$email4<BR>$telefon4</td>
				<td>$firma4</td>
				<td style='text-align: center;'>$wallet4<BR><a href='index.php?sid=23&id=$id4'><i class='fa fa-cogs'></i> Zarządzaj</a></td>
				<td style='text-align: center;'>$active4</td>
				<td><a href='index.php?sid=6&id=$id4' class='btn btn-danger'>Usuń</a></td>
			</tr>
			";
			
		}
		echo "</table>";
	} else {errorIMG("Brak użytkowników w bazie danych!");}
	//-----------
	echo '</div></section>';
break;

case 5:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Użytkownicy - rozwiązanie testu</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	$id5 = $_GET['id'];
	
	//====================================================================
	$copywriterGet5 = $_GET['copywriter'];
	$korektorGet5 = $_GET['korektor'];
		$q5_2 = mysqli_query($connect,"SELECT * FROM `mail_templates` WHERE `mail_id` = 'akceptacja_wykonawcy' ORDER BY `id` DESC LIMIT 1");
		$s5_2 = mysqli_fetch_array($q5_2);
			$tresc5_2 = $s5_2['tresc'];
			$qGetMail5 = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $id5");
			$sGetMail5 = mysqli_fetch_array($qGetMail5);
			$emailGetMail5 = $sGetMail5['email'];
	if($copywriterGet5 == "1"){
		mysqli_query($connect,"UPDATE `users` SET `copywriter` = '1' WHERE `id` = $id5");
	}
	
	if($korektorGet5 == "1"){
		mysqli_query($connect,"UPDATE `users` SET `korektor` = '1' WHERE `id` = $id5");
	}
	if($copywriterGet5 == "1" OR $korektorGet5 == "1"){
		//--------------------------------------
		$mail->Subject = "Pretext - Akceptacja zadania";//temat maila
		$mail->AddEmbeddedImage("../images/logoMail.png", "baner1", "logoMail.png", "base64");
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
		
		$text_body .= $tresc5_2;
		
		$text_body .= "</div><div style='clear: both; height: 4px;'></div><div style='float: right; color: #fff; font-family: Arial; padding-top: 5px;'>Pretext</div><div style='clear: both; height: 4px;'></div></div></body></html>";

		$mail->Body = $text_body;
		// adresatów dodajemy poprzez metode 'AddAddress'
		$mail->AddAddress($emailGetMail5,"Pretext");

		if(!$mail->Send()) echo $mail->ErrorInfo;
		// Clear all addresses and attachments
		$mail->ClearAddresses();
		$mail->ClearAttachments();
		//--------------------------------------
	}
	//====================================================================
	$q5 = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $id5");
	$n5 = mysqli_num_rows($q5);
	if($n5 > 0){
		$s5 = mysqli_fetch_array($q5);
		$imie5 = $s5['imie']." ".$s5['nazwisko'];
		$copywriter_rozwiazanie5 = $s5['copywriter_rozwiazanie'];
			if(empty($copywriter_rozwiazanie5)){$copywriter_rozwiazanie5 = "Brak rozwiązania";}
		$korektor_rozwiazanie5 = $s5['korektor_rozwiazanie'];
			if(empty($korektor_rozwiazanie5)){$korektor_rozwiazanie5 = "Brak rozwiązania";}
		$copywriter5 = $s5['copywriter'];
		$korektor5 = $s5['korektor'];
		echo "<h4>Rozwiązanie testu przez użytkownika <B>$imie5</B></h4>";
		echo "<div style='height: 20px;'></div>";
		
		echo "
		<div style='background: #fbfbfb; border-left: 5px solid #57ae00; padding: 20px; text-align: justify;'>
			<h4 style='margin-top: 0px;'><B>Copywriter</B></h4>
			$copywriter_rozwiazanie5
			<div style='margin-top: 15px; text-align: right;'>
				";
				if($copywriter5 != "1"){echo "<a href='index.php?sid=5&id=$id5&copywriter=1' class='btn btn-success'>Zalicz rozwiązanie</a>";} else {echo "<a href='javascript:;' class='btn btn-success'><i class='fa fa-check-circle'></i> Zaliczono</a>";}
				echo "
			</div>
		</div>
		";
		echo "<div style='height: 20px;'></div>";
		
		echo "
		<div style='background: #fbfbfb; border-left: 5px solid #57ae00; padding: 20px; text-align: justify;'>
			<h4 style='margin-top: 0px;'><B>Korektor</B></h4>
			$korektor_rozwiazanie5
			<div style='margin-top: 15px; text-align: right;'>
				";
				if($korektor5 != "1"){echo "<a href='index.php?sid=5&id=$id5&korektor=1' class='btn btn-success'>Zalicz rozwiązanie</a>";} else {echo "<a href='javascript:;' class='btn btn-success'><i class='fa fa-check-circle'></i> Zaliczono</a>";}
				echo "
			</div>
		</div>
		";
		
		
	} else {header("Location: index.php?sid=4");}
	//-----------
	echo '</div></section>';
break;

case 6:
$id6 = $_GET['id'];
$q6 = mysqli_query($connect,"DELETE FROM `users` WHERE `id` = $id6");
header("Location: index.php?sid=4&correct=POS_DELETED");
break;

case 7:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Zlecenia</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	echo "<h4>Lista aktualnych zleceń</h4>";
	$q7 = mysqli_query($connect,"SELECT * FROM `zlecenia` ORDER BY `closed` ASC, `id` DESC");
	$n7 = mysqli_num_rows($q7);
	if($n7 > 0){
		echo "<table class='table table-striped'>
		<tr>
			<td style='font-weight: bold;'>Zlecający</td>
			<td style='font-weight: bold;'>Wykonawca</td>
			<td style='font-weight: bold;'>Typ</td>
			<td style='font-weight: bold;'>Tytuł</td>
			<td style='font-weight: bold;'>Kategoria</td>
			<td style='font-weight: bold; text-align: center;'>Zakończone</td>
			<td style='font-weight: bold; width: 1%; text-align: center;' nowrap='nowrap'>Podgląd</td>
		</tr>
		";
		while($s7 = mysqli_fetch_array($q7)){
			$id7 = $s7['id'];
			$user_id7 = $s7['user_id'];
			$wykonawca_id7 = $s7['wykonawca_id'];
			$typ7 = $s7['typ'];
				if($typ7 == "nowy"){$typ7 = "Nowy tekst";} else {$typ7 = "Korekta";}
			$tytul7 = $s7['tytul'];
			$kategoria7 = $s7['kategoria'];
			$closed7 = $s7['closed'];
			//----------
			$q7_2 = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $user_id7");
			$s7_2 = mysqli_fetch_array($q7_2);
				$zlecajacy7 = $s7_2['imie']." ".$s7_2['nazwisko']."<BR>".$s7_2['email'];
			//----------
			if(!empty($wykonawca_id7)){
				$q7_3 = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $wykonawca_id7");
				$s7_3 = mysqli_fetch_array($q7_3);
					$wykonawca7 = $s7_3['imie']." ".$s7_3['nazwisko']."<BR>".$s7_3['email'];
			} else {
				$wykonawca7 = "Nie wybrano";
			}
			//----------
			echo "
			<tr>
				<td>$zlecajacy7</td>
				<td>$wykonawca7</td>
				<td>$typ7</td>
				<td>$tytul7</td>
				<td>$kategoria7</td>
				<td style='text-align: center;'>"; if($closed7 == "1"){echo "<i class='fa fa-check-circle' style='color: green; font-size: 16px;'></i>";} else {echo "<i class='fa fa-clock-o' style='color: #969696; font-size: 16px;'></i>";} echo "</td>
				<td><a href='index.php?sid=8&id=$id7' class='btn btn-primary'>Podgląd</a></td>
			</tr>
			";
		}
		echo "</table>";
	} else {errorIMG("Brak zleceń!");}
	//-----------
	echo '</div></section>';
break;

case 8:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Podgląd zlecenia</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	$id8 = $_GET['id'];
	$q8 = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $id8");
	$n8 = mysqli_num_rows($q8);
	if($n8 > 0){
		$s8 = mysqli_fetch_array($q8);
		
			$user_id8 = $s8['user_id'];
			$wykonawca_id8 = $s8['wykonawca_id'];
			$typ8 = $s8['typ'];
				if($typ8 == "nowy"){$typ8 = "Nowy tekst";} else {$typ8 = "Korekta";}
			$tytul8 = $s8['tytul'];
			$kategoria8 = $s8['kategoria'];
			$closed8 = $s8['closed'];
				if($closed8 == "1"){$closedName8 = "<span style='font-weight: bold; color: #4b9700;'><i class='fa fa-check-circle' style='font-size: 16px;'></i> Tak</span>";} else {$closedName8 = "<span style='font-weight: bold; color: #aaaaaa;'><i class='fa fa-clock-o' style='font-size: 16px;'></i> Nie</span>";}
			//----------
			$q8_2 = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $user_id8");
			$s8_2 = mysqli_fetch_array($q8_2);
				$zlecajacy8 = $s8_2['imie']." ".$s8_2['nazwisko']."<BR>".$s8_2['email'];
			//----------
			if(!empty($wykonawca_id8)){
				$q8_3 = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $wykonawca_id8");
				$s8_3 = mysqli_fetch_array($q8_3);
					$wykonawca8 = $s8_3['imie']." ".$s8_3['nazwisko']."<BR>".$s8_3['email'];
			} else {
				$wykonawca8 = "Nie wybrano";
			}
			$typ_tekstu8 = $s8['typ_tekstu'];
			$dlugosc_od8 = $s8['dlugosc_od'];
			$dlugosc_do8 = $s8['dlugosc_do'];
				if($dlugosc_do8 == "0" OR empty($dlugosc_do8) OR $dlugosc_do8 == $dlugosc_od8){
					$dlugosc8 = $dlugosc_od8." znaków";
				} else {
					$dlugosc8 = "Od $dlugosc_od8 do $dlugosc_do8 znaków";
				}
			$cena8 = $s8['cena'];
			$slowa_kluczowe8 = $s8['slowa_kluczowe'];
			$opis8 = $s8['opis'];
			$tekst_korekta_probna8 = $s8['tekst_korekta_probna'];
				if(empty($tekst_korekta_probna8)){$tekst_korekta_probna8 = "Brak tekstu";}
			$korekta_plik8 = $s8['korekta_plik'];
			//===================
			echo "<h3><B>$tytul8</B></h3>";
			echo "
			<div class='row'>
				<div class='col-md-4' style='margin-bottom: 10px;'>
					<h4 style='color: #aa0000;'>Zleceniodawca</h4>
					$zlecajacy8
					<hr>
					<h4 style='color: #aa0000;'>Wykonawca</h4>
					$wykonawca8
					<HR>
					<h4 style='color: #aa0000;'>Zlecenie zamknięte</h4>
					$closedName8
					<HR>
					<a class='btn btn-danger' href='index.php?sid=9&id=$id8'><i class='fa fa-trash'></i> Usuń zlecenie</a><BR>
					<span style='font-size: 12px;'><i class='fa fa-info-circle'></i> Po usunięciu zlecenia środki zostaną przywrócone na konto Zleceniodawcy.<BR>Wyjątkiem jest zlecenie, które zostało już zrealizowane i zakończone.</span>
				</div>
				<div class='col-md-4' style='margin-bottom: 10px;'>
					<h4 style='color: #aa0000;'>Typ zlecenia</h4>
					<B>$typ8</B>
					<h4 style='color: #aa0000;'>Kategoria</h4>
					$kategoria8
					<h4 style='color: #aa0000;'>Typ tekstu</h4>
					$typ_tekstu8
					<h4 style='color: #aa0000;'>Długość tekstu</h4>
					$dlugosc8
					<h4 style='color: #aa0000; font-weight: bold;'>Cena</h4>
					<B>$cena8 zł / 1.000 znaków</B>
				</div>
				<div class='col-md-4' style='margin-bottom: 10px;'>
					<h4 style='color: #aa0000;'>Opis zlecenia</h4>
					$opis8
					<h4 style='color: #aa0000;'>Słowa kluczowe</h4>
					$slowa_kluczowe8
					<h4 style='color: #aa0000;'>Korekta próbna</h4>
					$tekst_korekta_probna8
					<h4 style='color: #aa0000;'>Plik korekty właściwej</h4>
					"; if(!empty($korekta_plik8)){echo "<a href='../download/$korekta_plik8' class='btn btn-primary'><i class='fa fa-cloud-download'></i> Pobierz</a>";} else {echo "Brak pliku";} echo "
				</div>
			</div>
			";
			//===================
	} else {header("Location: index.php?sid=7");}
	//-----------
	echo '</div></section>';
break;

case 9:
	$id9 = $_GET['id'];
	$q9 = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $id9");
	$s9 = mysqli_fetch_array($q9);
		$cena9 = $s9['cena'];
		$user_id9 = $s9['user_id'];
		$dlugosc_od9 = $s9['dlugosc_od'];
		$dlugosc_do9 = $s9['dlugosc_do'];
		$closed9 = $s9['closed'];
		
		if($dlugosc_od9 == $dlugosc_do9 OR $dlugosc_do9 == "0" OR empty($dlugosc_do9)){
			$dlugosc9 = $dlugosc_od9/1000;
		} else {
			$dlugosc9 = $dlugosc_do9/1000;
		}
		
		$total9 = $cena9 * $dlugosc9;
		$prowizja9 = ($total9 * PROWIZJA)/100;
		
		$zwrot9 = $prowizja9 + $total9;
		
		$qGetWallet9 = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $user_id9");
		$sGetWallet9 = mysqli_fetch_array($qGetWallet9);
			$newWallet9 = $sGetWallet9['wallet'] + $zwrot9;
		
		if(mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `zlecenie_id` = $id9 AND `closed` = '1'")) > 0 AND $closed9 == '1'){
			// DO NOTHING
		} else {
		mysqli_query($connect,"UPDATE `users` SET `wallet` = '$newWallet9' WHERE `id` = $user_id9");
		mysqli_query($connect,"DELETE FROM `realizacje` WHERE `zlecenie_id` = $id9");
		}
		
		mysqli_query($connect,"DELETE FROM `zlecenia` WHERE `id` = $id9");
		header("Location: index.php?sid=7&correct=POS_DELETED");
		
break;

case 10:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">FAQ</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	echo "
	<h3>Dodaj pozycję</h3>
	<form action='index.php?sid=11' method='post'>
		<table class='table table-bordered'>
			<tr>
				<td style='font-weight: bold; padding: 14px; width: 1%;' nowrap='nowrap'>Pytanie:</td>
				<td><input type='text' name='pytanie' class='form form-control' required></td>
			</tr>
			<tr>
				<td style='font-weight: bold; padding: 14px; width: 1%;' nowrap='nowrap'>Odpowiedź:</td>
				<td><input type='text' name='odpowiedz' class='form form-control' required></td>
			</tr>
			<tr>
				<td colspan='2' style='text-align: right;'><input type='submit' class='btn btn-primary' value='Dodaj'></td>
			</tr>
		</table>
	</form>
	";
	
	$q10 = mysqli_query($connect,"SELECT * FROM `faq` ORDER BY `id` DESC");
	$n10 = mysqli_num_rows($q10);
	if($n10 > 0){
		echo "<div style='height: 15px;'></div><h4>Dostępne pozycje:</h4>";
		echo "<table class='table table-striped'>";
		echo "
		<tr>
			<td style='font-weight: bold;'>Pytanie</td>
			<td style='font-weight: bold;'>Odpowiedź</td>
			<td style='font-weight: bold; text-align: right;'>Operacje</td>
		</tr>
		";
		while($s10 = mysqli_fetch_array($q10)){
			$pytanie10 = $s10['pytanie'];
			$odpowiedz10 = $s10['odpowiedz'];
			$id10 = $s10['id'];
			echo "
			<tr>
				<td>$pytanie10</td>
				<td>$odpowiedz10</td>
				<td style='text-align: right;'>
					<a href='index.php?sid=12&id=$id10' data-toggle='tooltip' title='Edytuj'><i class='fa fa-edit' style='font-size: 17px;'></i></a>&nbsp;&nbsp;
					<a href='index.php?sid=14&id=$id10' data-toggle='tooltip' title='Usuń pozycję' onclick=\"return confirm('Jesteś pewien, że chcesz usunąć tę pozycję?');\" style='color: red;'><i class='fa fa-trash'  style='font-size: 17px;'></i></a>
				</td>
			</tr>
			";
		}
		echo "</table>";
	}
	//-----------
echo '</div></section>';
break;

case 11:
$pytanie11 = addslashes($_POST['pytanie']);
$odpowiedz11 = addslashes($_POST['odpowiedz']);
mysqli_query($connect,"INSERT INTO `faq` (`pytanie`, `odpowiedz`) VALUES ('$pytanie11', '$odpowiedz11')");
header("Location: index.php?sid=10&correct=ADDED");
break;

case 12:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">FAQ</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	$id12 = $_GET['id'];
	$q12 = mysqli_query($connect,"SELECT * FROM `faq` WHERE `id` = '$id12'");
	$s12 = mysqli_fetch_array($q12);
		$pytanie12 = $s12['pytanie'];
		$odpowiedz12 = $s12['odpowiedz'];
		
	echo "
	<h3>Edytuj profil kierowcy</h3>
	<form action='index.php?sid=13' method='post'>
		<table class='table table-bordered'>
			<tr>
				<td style='font-weight: bold; padding: 14px; width: 1%;' nowrap='nowrap'>Pytanie:</td>
				<td><input type='text' name='pytanie' class='form form-control' value='$pytanie12' required></td>
			</tr>
			<tr>
				<td style='font-weight: bold; padding: 14px; width: 1%;' nowrap='nowrap'>Odpowiedź:</td>
				<td><input type='text' name='odpowiedz' class='form form-control' value='$odpowiedz12' required></td>
			</tr>
			<tr>
				<td colspan='2' style='text-align: right;'><input type='hidden' name='id' value='$id12'><input type='submit' class='btn btn-primary' value='Zapisz zmiany'></td>
			</tr>
		</table>
	</form>
	";
	//-----------
echo '</div></section>';
break;

case 13:
	$pytanie13 = addslashes($_POST['pytanie']);
	$odpowiedz13 = addslashes($_POST['odpowiedz']);
	$id13 = $_POST['id'];
	
	mysqli_query($connect,"UPDATE `faq` SET `pytanie` = '$pytanie13' WHERE `id` = $id13");
	mysqli_query($connect,"UPDATE `faq` SET `odpowiedz` = '$odpowiedz13' WHERE `id` = $id13");
	header("Location: index.php?sid=10&correct=SAVED");
break;

case 14:
$id14 = $_GET['id'];
mysqli_query($connect,"DELETE FROM `faq` WHERE `id` = $id14");
header("Location: index.php?sid=10&correct=POS_DELETED");
break;

case 15:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Regulamin</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	$try15Post = $_POST['try'];
	$tresc15Post = addslashes($_POST['tresc']);
	if(!empty($try15Post) AND $try15Post == "1"){
		mysqli_query($connect,"TRUNCATE TABLE `terms`");
		mysqli_query($connect,"INSERT INTO `terms` (`tresc`) VALUES ('$tresc15Post')");
		header("Location: index.php?sid=15&correct=SAVED");
	}
	//===============
	$q15 = mysqli_query($connect,"SELECT * FROM `terms` ORDER BY `id` DESC LIMIT 1");
	$s15 = mysqli_fetch_array($q15);
		$tresc15 = $s15['tresc'];
	echo "
	<h3>Regulamin</h3>
	<div style='height: 20px;'></div>
	<form action='' method='post'>
		<table class='table table-bordered'>
			<tr>
				<td><textarea name='tresc' id='summernote' style='height: 450px;'>$tresc15</textarea></td>
			</tr>
			<tr>
				<td style='text-align: right;'><input type='hidden' name='try' value='1'><input type='submit' class='btn btn-success' value='Zapisz zmiany'></td>
			</tr>
		</table>
	</form>
	";
	//-----------
echo '</div></section>';
break;

case 16:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Polityka Prywatności i Cookies</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	$try16Post = $_POST['try'];
	$tresc16Post = addslashes($_POST['tresc']);
	if(!empty($try16Post) AND $try16Post == "1"){
		mysqli_query($connect,"TRUNCATE TABLE `privacy`");
		mysqli_query($connect,"INSERT INTO `privacy` (`tresc`) VALUES ('$tresc16Post')");
		header("Location: index.php?sid=16&correct=SAVED");
	}
	//===============
	$q16 = mysqli_query($connect,"SELECT * FROM `privacy` ORDER BY `id` DESC LIMIT 1");
	$s16 = mysqli_fetch_array($q16);
		$tresc16 = $s16['tresc'];
	echo "
	<h3>Polityka Prywatności i Cookies</h3>
	<div style='height: 20px;'></div>
	<form action='' method='post'>
		<table class='table table-bordered'>
			<tr>
				<td><textarea name='tresc' id='summernote' style='height: 450px;'>$tresc16</textarea></td>
			</tr>
			<tr>
				<td style='text-align: right;'><input type='hidden' name='try' value='1'><input type='submit' class='btn btn-success' value='Zapisz zmiany'></td>
			</tr>
		</table>
	</form>
	";
	//-----------
echo '</div></section>';
break;

case 17:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Partnerzy</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	$try17Post = $_POST['try'];
	$tresc17Post = addslashes($_POST['tresc']);
	if(!empty($try17Post) AND $try17Post == "1"){
		mysqli_query($connect,"TRUNCATE TABLE `partners`");
		mysqli_query($connect,"INSERT INTO `partners` (`tresc`) VALUES ('$tresc17Post')");
		header("Location: index.php?sid=17&correct=SAVED");
	}
	//===============
	$q17 = mysqli_query($connect,"SELECT * FROM `partners` ORDER BY `id` DESC LIMIT 1");
	$s17 = mysqli_fetch_array($q17);
		$tresc17 = $s17['tresc'];
	echo "
	<h3>Partnerzy</h3>
	<div style='height: 20px;'></div>
	<form action='' method='post'>
		<table class='table table-bordered'>
			<tr>
				<td><textarea name='tresc' id='summernote' style='height: 450px;'>$tresc17</textarea></td>
			</tr>
			<tr>
				<td style='text-align: right;'><input type='hidden' name='try' value='1'><input type='submit' class='btn btn-success' value='Zapisz zmiany'></td>
			</tr>
		</table>
	</form>
	";
	//-----------
echo '</div></section>';
break;

case 18:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">O Nas</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	$try18Post = $_POST['try'];
	$tresc18Post = addslashes($_POST['tresc']);
	if(!empty($try18Post) AND $try18Post == "1"){
		mysqli_query($connect,"TRUNCATE TABLE `about`");
		mysqli_query($connect,"INSERT INTO `about` (`tresc`) VALUES ('$tresc18Post')");
		header("Location: index.php?sid=18&correct=SAVED");
	}
	//===============
	$q18 = mysqli_query($connect,"SELECT * FROM `about` ORDER BY `id` DESC LIMIT 1");
	$s18 = mysqli_fetch_array($q18);
		$tresc18 = $s18['tresc'];
	echo "
	<h3>O Nas</h3>
	<div style='height: 20px;'></div>
	<form action='' method='post'>
		<table class='table table-bordered'>
			<tr>
				<td><textarea name='tresc' id='summernote' style='height: 450px;'>$tresc18</textarea></td>
			</tr>
			<tr>
				<td style='text-align: right;'><input type='hidden' name='try' value='1'><input type='submit' class='btn btn-success' value='Zapisz zmiany'></td>
			</tr>
		</table>
	</form>
	";
	//-----------
echo '</div></section>';
break;

case 19:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Pisz dla nas</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	$try19Post = $_POST['try'];
	$tresc19Post = addslashes($_POST['tresc']);
	if(!empty($try19Post) AND $try19Post == "1"){
		mysqli_query($connect,"TRUNCATE TABLE `pisz_dla_nas`");
		mysqli_query($connect,"INSERT INTO `pisz_dla_nas` (`tresc`) VALUES ('$tresc19Post')");
		header("Location: index.php?sid=19&correct=SAVED");
	}
	//===============
	$q19 = mysqli_query($connect,"SELECT * FROM `pisz_dla_nas` ORDER BY `id` DESC LIMIT 1");
	$s19 = mysqli_fetch_array($q19);
		$tresc19 = $s19['tresc'];
	echo "
	<h3>Pisz dla nas</h3>
	<div style='height: 20px;'></div>
	<form action='' method='post'>
		<table class='table table-bordered'>
			<tr>
				<td><textarea name='tresc' id='summernote' style='height: 450px;'>$tresc19</textarea></td>
			</tr>
			<tr>
				<td style='text-align: right;'><input type='hidden' name='try' value='1'><input type='submit' class='btn btn-success' value='Zapisz zmiany'></td>
			</tr>
		</table>
	</form>
	";
	//-----------
echo '</div></section>';
break;

case 20:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Zasady współpracy</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	$try20Post = $_POST['try'];
	$tresc20Post = addslashes($_POST['tresc']);
	if(!empty($try20Post) AND $try20Post == "1"){
		mysqli_query($connect,"TRUNCATE TABLE `zasady_wspolpracy`");
		mysqli_query($connect,"INSERT INTO `zasady_wspolpracy` (`tresc`) VALUES ('$tresc20Post')");
		header("Location: index.php?sid=20&correct=SAVED");
	}
	//===============
	$q20 = mysqli_query($connect,"SELECT * FROM `zasady_wspolpracy` ORDER BY `id` DESC LIMIT 1");
	$s20 = mysqli_fetch_array($q20);
		$tresc20 = $s20['tresc'];
	echo "
	<h3>Zasady współpracy</h3>
	<div style='height: 20px;'></div>
	<form action='' method='post'>
		<table class='table table-bordered'>
			<tr>
				<td><textarea name='tresc' id='summernote' style='height: 450px;'>$tresc20</textarea></td>
			</tr>
			<tr>
				<td style='text-align: right;'><input type='hidden' name='try' value='1'><input type='submit' class='btn btn-success' value='Zapisz zmiany'></td>
			</tr>
		</table>
	</form>
	";
	//-----------
echo '</div></section>';
break;

case 21:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Newsletter</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	$q21 = mysqli_query($connect,"SELECT * FROM `newsletter` ORDER BY `id` DESC");
	$n21 = mysqli_num_rows($q21);
	if($n21 > 0){
		echo "<table class='table table-striped'>
		<tr>
			<td style='font-weight: bold;'>Adres e-mail</td>
			<td style='font-weight: bold; width: 1%; text-align: center;' nowrap='nowrap'>Akcje</td>
		</tr>
		";
		while($s21 = mysqli_fetch_array($q21)){
			$id21 = $s21['id'];
			$email21 = $s21['email'];
			echo "
			<tr>
				<td>$email21</td>
				<td style='text-align: center;'><a class='btn btn-danger' href='index.php?sid=22&id=$id21'><i class='fa fa-trash'></i> Usuń adres</a></td>
			</tr>
			";
		}
		echo "</table>";
	} else {errorIMG("Brak adresów e-mail!");}
	//-----------
echo '</div></section>';
break;

case 22:
$id22 = $_GET['id'];
mysqli_query($connect,"DELETE FROM `newsletter` WHERE `id` = $id22");
header("Location: index.php?sid=21&correct=POS_DELETED");
break;

case 23:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Zarządzanie portfelem użytkownika</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	$id23 = $_GET['id'];
	
	$q23 = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $id23");
	$s23 = mysqli_fetch_array($q23);
		$imie23 = $s23['imie']." ".$s23['nazwisko'];
		$wallet23 = $s23['wallet'];
		echo "
		<h3>Portfel użytkownika <span style='color: #7c1c1c;'>$imie23</span></h3>
		<form action='index.php?sid=24' method='post'>
		<table class='table table-bordered'>
			<tr>
				<td style='padding: 14px; text-align: center; font-weight: bold;'>Zarządzaj zawartością portfela</td>
			</tr>
			<tr>
				<td style='text-align: center;'><input type='text' name='wallet' class='form form-control' style='width: 250px; margin: 0 auto; text-align: center; font-weight: bold; color: #0080c0;' value='$wallet23' required></td>
			</tr>
			<tr>
				<td style='text-align: center;'><input type='hidden' name='id' value='$id23'><input type='submit' class='btn btn-primary' value='Zapisz zmiany'></td>
			</tr>
		</table>
		</form>
		<div style='height: 20px; background: #dddddd;'></div>
		<form action='index.php?sid=25' method='post'>
		<table class='table table-bordered'>
			<tr>
				<td style='padding: 14px; text-align: center; font-weight: bold; color: #5cb900;'>Dodaj kwotę do portfela</td>
			</tr>
			<tr>
				<td style='text-align: center;'><input type='text' name='kwota' class='form form-control' style='width: 250px; margin: 0 auto; text-align: center; font-weight: bold; color: #5cb900;' required></td>
			</tr>
			<tr>
				<td style='text-align: center;'><input type='text' name='opis' class='form form-control' style='width: 250px; margin: 0 auto; text-align: center; font-weight: bold; color: #5cb900;' placeholder='Podaj tytuł operacji' required></td>
			</tr>
			<tr>
				<td style='text-align: center;'><input type='hidden' name='id' value='$id23'><input type='submit' class='btn btn-success' value='Dodaj'></td>
			</tr>
		</table>
		</form>
		<div style='height: 20px; background: #dddddd;'></div>
		<form action='index.php?sid=26' method='post'>
		<table class='table table-bordered'>
			<tr>
				<td style='padding: 14px; text-align: center; font-weight: bold; color: #ca0000;'>Odejmij kwotę od portfela</td>
			</tr>
			<tr>
				<td style='text-align: center;'><input type='text' name='kwota' class='form form-control' style='width: 250px; margin: 0 auto; text-align: center; font-weight: bold; color: #7c1c1c;' required></td>
			</tr>
			<tr>
				<td style='text-align: center;'><input type='text' name='opis' class='form form-control' style='width: 250px; margin: 0 auto; text-align: center; font-weight: bold; color: #7c1c1c;' placeholder='Podaj tytuł operacji' required></td>
			</tr>
			<tr>
				<td style='text-align: center;'><input type='hidden' name='id' value='$id23'><input type='submit' class='btn btn-danger' value='Odejmij'></td>
			</tr>
		</table>
		</form>
		";
	//-----------
echo '</div></section>';
break;

case 24:
	$wallet24 = $_POST['wallet'];
	$wallet24 = str_replace(",",".",$wallet24);
	if(empty($wallet24)){$wallet24 = "0";}
	$id24 = $_POST['id'];
	mysqli_query($connect,"UPDATE `users` SET `wallet` = '$wallet24' WHERE `id` = $id24");
	header("Location: index.php?sid=23&id=$id24&correct=SAVED");
break;

case 25:
$id25 = $_POST['id'];
$opis25 = addslashes($_POST['opis']);
$kwota25 = $_POST['kwota'];
//----------------
$q25 = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $id25");
$s25 = mysqli_fetch_array($q25);
$wallet25 = $s25['wallet'];
$newWallet25 = $wallet25 + $kwota25;
mysqli_query($connect,"UPDATE `users` SET `wallet` = '$newWallet25' WHERE `id` = $id25");
mysqli_query($connect,"INSERT INTO `wallet_history` (`user_id`,`kwota`,`opis`,`data`) VALUES ('$id25','$kwota25','$opis25','".date("Y-m-d H:i")."')");
header("Location: index.php?sid=23&id=$id25&correct=SAVED");
break;

case 26:
$id26 = $_POST['id'];
$opis26 = addslashes($_POST['opis']);
$kwota26 = $_POST['kwota'];
//----------------
$q26 = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $id26");
$s26 = mysqli_fetch_array($q26);
$wallet26 = $s26['wallet'];
$newWallet26 = $wallet26 - $kwota26;
mysqli_query($connect,"UPDATE `users` SET `wallet` = '$newWallet26' WHERE `id` = $id26");
mysqli_query($connect,"INSERT INTO `wallet_history` (`user_id`,`kwota`,`opis`,`data`) VALUES ('$id26','-$kwota26','$opis26','".date("Y-m-d H:i")."')");
header("Location: index.php?sid=23&id=$id26&correct=SAVED");
break;

case 27:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Dane kontaktowe</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	$q27 = mysqli_query($connect,"SELECT * FROM `contact` ORDER BY `id` DESC LIMIT 1");
	$s27 = mysqli_fetch_array($q27);
		$dane_firmy27 = $s27['dane_firmy'];
		$email27 = $s27['email'];
		$telefon27 = $s27['telefon'];
		$instagram27 = $s27['instagram'];
		$facebook27 = $s27['facebook'];
		$google27 = $s27['google'];
		
	echo "
	<form action='index.php?sid=28' method='post'>
		<table class='table table-bordered'>
			<tr>
				<td style='font-weight: bold; padding: 14px; width: 1%;' nowrap='nowrap'>Adres e-mail:</td>
				<td><input type='email' name='email' class='form form-control' value='$email27' required></td>
			</tr>
			<tr>
				<td style='font-weight: bold; padding: 14px; width: 1%;' nowrap='nowrap'>Telefon:</td>
				<td><input type='text' name='telefon' class='form form-control' value='$telefon27' required></td>
			</tr>
			<tr>
				<td style='font-weight: bold; padding: 14px; width: 1%;' nowrap='nowrap'>Dane firmy:</td>
				<td><textarea name='dane_firmy' class='form form-control' style='height: 80px;' required>$dane_firmy27</textarea></td>
			</tr>
			<tr>
				<td style='font-weight: bold; padding: 14px; width: 1%;' nowrap='nowrap'>Facebook:</td>
				<td><input type='text' name='facebook' class='form form-control' value='$facebook27'></td>
			</tr>
			<tr>
				<td style='font-weight: bold; padding: 14px; width: 1%;' nowrap='nowrap'>Instagram:</td>
				<td><input type='text' name='instagram' class='form form-control' value='$instagram27'></td>
			</tr>
			<tr>
				<td style='font-weight: bold; padding: 14px; width: 1%;' nowrap='nowrap'>Google:</td>
				<td><input type='text' name='google' class='form form-control' value='$google27'></td>
			</tr>
			<tr>
				<td colspan='2' style='text-align: right;'><input type='submit' class='btn btn-success' value='Zapisz zmiany'></td>
			</tr>
		</table>
	</form>
	";
	//-----------
echo '</div></section>';
break;

case 28:
$email28 = addslashes($_POST['email']);
$telefon28 = addslashes($_POST['telefon']);
$dane_firmy28 = addslashes($_POST['dane_firmy']);
$facebook28 = addslashes($_POST['facebook']);
$instagram28 = addslashes($_POST['instagram']);
$google28 = addslashes($_POST['google']);
mysqli_query($connect,"TRUNCATE TABLE `contact`");
mysqli_query($connect,"INSERT INTO `contact` (`email`,`telefon`,`dane_firmy`,`instagram`,`facebook`,`google`) VALUES ('$email28','$telefon28','$dane_firmy28','$instagram28','$facebook28','$google28')");
header("Location: index.php?sid=27&correct=SAVED");
break;

case 29:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Statystyki - Strona Główna</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	$q29 = mysqli_query($connect,"SELECT * FROM `home_stats` ORDER BY `id` DESC LIMIT 1");
	$s29 = mysqli_fetch_array($q29);
		$blok1_line1 = $s29['blok1_line1'];
		$blok1_numbers = $s29['blok1_numbers'];
		$blok1_line2 = $s29['blok1_line2'];
		$blok2_line1 = $s29['blok2_line1'];
		$blok2_numbers = $s29['blok2_numbers'];
		$blok2_line2 = $s29['blok2_line2'];
		$blok3_line1 = $s29['blok3_line1'];
		$blok3_numbers = $s29['blok3_numbers'];
		$blok3_line2 = $s29['blok3_line2'];
		$blok4_line1 = $s29['blok4_line1'];
		$blok4_numbers = $s29['blok4_numbers'];
		$blok4_line2 = $s29['blok4_line2'];
		$blok5_line1 = $s29['blok5_line1'];
		$blok5_numbers = $s29['blok5_numbers'];
		$blok5_line2 = $s29['blok5_line2'];
	
	echo "
	<form action='index.php?sid=30' method='post'>
		<table class='table table-bordered'>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Blok #1, linia 1:</td>
				<td><input type='text' class='form form-control' name='blok1_line1' value='$blok1_line1'></td>
			</tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Blok #1, liczba:</td>
				<td><input type='text' class='form form-control' name='blok1_numbers' value='$blok1_numbers'></td>
			</tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Blok #1, linia 2:</td>
				<td><input type='text' class='form form-control' name='blok1_line2' value='$blok1_line2'></td>
			</tr>
			<tr><td colspan='2' style='background: #e9e9e9;'>&nbsp;</td></tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Blok #2, linia 1:</td>
				<td><input type='text' class='form form-control' name='blok2_line1' value='$blok2_line1'></td>
			</tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Blok #2, liczba:</td>
				<td><input type='text' class='form form-control' name='blok2_numbers' value='$blok2_numbers'></td>
			</tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Blok #2, linia 2:</td>
				<td><input type='text' class='form form-control' name='blok2_line2' value='$blok2_line2'></td>
			</tr>
			<tr><td colspan='2' style='background: #e9e9e9;'>&nbsp;</td></tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Blok #3, linia 1:</td>
				<td><input type='text' class='form form-control' name='blok3_line1' value='$blok3_line1'></td>
			</tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Blok #3, liczba:</td>
				<td><input type='text' class='form form-control' name='blok3_numbers' value='$blok3_numbers'></td>
			</tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Blok #3, linia 2:</td>
				<td><input type='text' class='form form-control' name='blok3_line2' value='$blok3_line2'></td>
			</tr>
			<tr><td colspan='2' style='background: #e9e9e9;'>&nbsp;</td></tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Blok #4, linia 1:</td>
				<td><input type='text' class='form form-control' name='blok4_line1' value='$blok4_line1'></td>
			</tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Blok #4, liczba:</td>
				<td><input type='text' class='form form-control' name='blok4_numbers' value='$blok4_numbers'></td>
			</tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Blok #4, linia 2:</td>
				<td><input type='text' class='form form-control' name='blok4_line2' value='$blok4_line2'></td>
			</tr>
			<tr><td colspan='2' style='background: #e9e9e9;'>&nbsp;</td></tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Blok #5, linia 1:</td>
				<td><input type='text' class='form form-control' name='blok5_line1' value='$blok5_line1'></td>
			</tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Blok #5, liczba:</td>
				<td><input type='text' class='form form-control' name='blok5_numbers' value='$blok5_numbers'></td>
			</tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Blok #5, linia 2:</td>
				<td><input type='text' class='form form-control' name='blok5_line2' value='$blok5_line2'></td>
			</tr>
			<tr><td colspan='2' style='text-align: right;'><input type='submit' class='btn btn-success' value='Zapisz zmiany'></td></tr>
		</table>
	</form>
	";
	//-----------
echo '</div></section>';
break;

case 30:
	$blok1_line1_30 = addslashes($_POST['blok1_line1']);
	$blok1_numbers_30 = addslashes($_POST['blok1_numbers']);
	$blok1_line2_30 = addslashes($_POST['blok1_line2']);
	
	$blok2_line1_30 = addslashes($_POST['blok2_line1']);
	$blok2_numbers_30 = addslashes($_POST['blok2_numbers']);
	$blok2_line2_30 = addslashes($_POST['blok2_line2']);
	
	$blok3_line1_30 = addslashes($_POST['blok3_line1']);
	$blok3_numbers_30 = addslashes($_POST['blok3_numbers']);
	$blok3_line2_30 = addslashes($_POST['blok3_line2']);
	
	$blok4_line1_30 = addslashes($_POST['blok4_line1']);
	$blok4_numbers_30 = addslashes($_POST['blok4_numbers']);
	$blok4_line2_30 = addslashes($_POST['blok4_line2']);
	
	$blok5_line1_30 = addslashes($_POST['blok5_line1']);
	$blok5_numbers_30 = addslashes($_POST['blok5_numbers']);
	$blok5_line2_30 = addslashes($_POST['blok5_line2']);
	
	mysqli_query($connect,"TRUNCATE TABLE `home_stats`");
	mysqli_query($connect,"INSERT INTO `home_stats` (`blok1_line1`, `blok1_numbers`, `blok1_line2`, `blok2_line1`, `blok2_numbers`, `blok2_line2`, `blok3_line1`, `blok3_numbers`, `blok3_line2`, `blok4_line1`, `blok4_numbers`, `blok4_line2`, `blok5_line1`, `blok5_numbers`, `blok5_line2`) VALUES ('$blok1_line1_30', '$blok1_numbers_30', '$blok1_line2_30', '$blok2_line1_30', '$blok2_numbers_30', '$blok2_line2_30', '$blok3_line1_30', '$blok3_numbers_30', '$blok3_line2_30', '$blok4_line1_30', '$blok4_numbers_30', '$blok4_line2_30', '$blok5_line1_30', '$blok5_numbers_30', '$blok5_line2_30');");
	header("Location: index.php?sid=29&correct=SAVED");
break;

case 31:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Filary Wiedzy - górna belka</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	$q31 = mysqli_query($connect,"SELECT * FROM `filary_wiedzy` ORDER BY `id` DESC LIMIT 1");
	$s31 = mysqli_fetch_array($q31);
		$pytanie31_1 = $s31['pytanie1'];
		$odpowiedz31_1 = $s31['odpowiedz1'];
		$pytanie31_2 = $s31['pytanie2'];
		$odpowiedz31_2 = $s31['odpowiedz2'];
		$pytanie31_3 = $s31['pytanie3'];
		$odpowiedz31_3 = $s31['odpowiedz3'];
		$pytanie31_4 = $s31['pytanie4'];
		$odpowiedz31_4 = $s31['odpowiedz4'];
	echo "
	<form action='index.php?sid=32' method='post'>
		<table class='table table-bordered'>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Pytanie #1:</td>
				<td><input type='text' class='form form-control' name='pytanie1' value='$pytanie31_1' required></td>
			</tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Odpowiedż #1:</td>
				<td><textarea class='form form-control' name='odpowiedz1' style='height: 130px;' required>$odpowiedz31_1</textarea></td>
			</tr>
			<tr><td colspan='2' style='background: #e9e9e9;'>&nbsp;</td></tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Pytanie #2:</td>
				<td><input type='text' class='form form-control' name='pytanie2' value='$pytanie31_2' required></td>
			</tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Odpowiedż #2:</td>
				<td><textarea class='form form-control' name='odpowiedz2' style='height: 130px;' required>$odpowiedz31_2</textarea></td>
			</tr>
			<tr><td colspan='2' style='background: #e9e9e9;'>&nbsp;</td></tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Pytanie #3:</td>
				<td><input type='text' class='form form-control' name='pytanie3' value='$pytanie31_3' required></td>
			</tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Odpowiedż #3:</td>
				<td><textarea class='form form-control' name='odpowiedz3' style='height: 130px;' required>$odpowiedz31_3</textarea></td>
			</tr>
			<tr><td colspan='2' style='background: #e9e9e9;'>&nbsp;</td></tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Pytanie #4:</td>
				<td><input type='text' class='form form-control' name='pytanie4' value='$pytanie31_4' required></td>
			</tr>
			<tr>
				<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Odpowiedż #4:</td>
				<td><textarea class='form form-control' name='odpowiedz4' style='height: 130px;' required>$odpowiedz31_4</textarea></td>
			</tr>
			<tr><td colspan='2' style='background: #e9e9e9;'>&nbsp;</td></tr>
			<tr><td colspan='2' style='text-align: right;'><input type='submit' class='btn btn-success' value='Zapisz zmiany'></td></tr>
		</table>
	</form>
	";
	//-----------
echo '</div></section>';
break;

case 32:
	$pytanie32_1 = addslashes($_POST['pytanie1']);
	$odpowiedz32_1 = addslashes($_POST['odpowiedz1']);
	$pytanie32_2 = addslashes($_POST['pytanie2']);
	$odpowiedz32_2 = addslashes($_POST['odpowiedz2']);
	$pytanie32_3 = addslashes($_POST['pytanie3']);
	$odpowiedz32_3 = addslashes($_POST['odpowiedz3']);
	$pytanie32_4 = addslashes($_POST['pytanie4']);
	$odpowiedz32_4 = addslashes($_POST['odpowiedz4']);
	mysqli_query($connect,"TRUNCATE TABLE `filary_wiedzy`");
	mysqli_query($connect,"INSERT INTO `filary_wiedzy` (`pytanie1`,`odpowiedz1`,`pytanie2`,`odpowiedz2`,`pytanie3`,`odpowiedz3`,`pytanie4`,`odpowiedz4`) VALUES ('$pytanie32_1','$odpowiedz32_1','$pytanie32_2','$odpowiedz32_2','$pytanie32_3','$odpowiedz32_3','$pytanie32_4','$odpowiedz32_4')");
	header("Location: index.php?sid=31&correct=SAVED");
break;

case 33:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Zadania dla użytkowników</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	echo "
	<h3>Zadania dla Korektorów</h3>
	<form action='index.php?sid=34' method='post'>
	<table class='table table-bordered'>
		<tr>
			<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Treść zadania:</td>
			<td><textarea class='form form-control' name='tresc' style='height: 170px;' required></textarea></td>
		</tr>
		<tr>
			<td style='text-align: right;' colspan='2'><input type='submit' class='btn btn-success' value='Dodaj zadanie'></td>
		</tr>
	</table>
	</form>
	<div style='height: 20px;'></div>
	";
	$q33 = mysqli_query($connect,"SELECT * FROM `zadania_korektor` ORDER BY `id` DESC");
	$n33 = mysqli_num_rows($q33);
	if($n33 > 0){
		echo "<h4>Dodane zadania dla Korektorów</h4>";
		echo "<table class='table table-striped'>";
			echo "
			<tr>
				<td><B>Treść zadania</B></td>
				<td style='width: 1%;' nowrap='nowrap'>Operacje</td>
			</tr>
			";
			while($s33 = mysqli_fetch_array($q33)){
				$zadanie33 = $s33['zadanie'];
				$id33 = $s33['id'];
				echo "
				<tr>
					<td>$zadanie33</td>
					<td><a href='index.php?sid=35&id=$id33' data-toggle='tooltip' title='Edytuj'><i class='fa fa-edit' style='font-size: 17px;'></i></a>&nbsp;&nbsp;<a href='index.php?sid=37&id=$id33' data-toggle='tooltip' title='Usuń'><i class='fa fa-trash' style='font-size: 17px; color: red;'></i></a></td>
				</tr>
				";
			}
		echo "</table><div style='height: 20px;'></div>";
	}
	//==========================================
	echo "<HR><h3>Zadania dla Copywriterów</h3>
	<form action='index.php?sid=38' method='post'>
	<table class='table table-bordered'>
		<tr>
			<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Treść zadania:</td>
			<td><input type='text' class='form form-control' name='tresc' required></td>
		</tr>
		<tr>
			<td style='text-align: right;' colspan='2'><input type='submit' class='btn btn-success' value='Dodaj zadanie'></td>
		</tr>
	</table>
	</form>
	<div style='height: 20px;'></div>
	";
	$q33_2 = mysqli_query($connect,"SELECT * FROM `zadania_copywriter` ORDER BY `id` DESC");
	$n33_2 = mysqli_num_rows($q33_2);
	if($n33_2 > 0){
		echo "<h4>Dodane zadania dla Copywriterów</h4>";
		echo "<table class='table table-striped'>";
			echo "
			<tr>
				<td><B>Treść zadania</B></td>
				<td style='width: 1%;' nowrap='nowrap'>Operacje</td>
			</tr>
			";
			while($s33_2 = mysqli_fetch_array($q33_2)){
				$zadanie33_2 = $s33_2['zadanie'];
				$id33_2 = $s33_2['id'];
				echo "
				<tr>
					<td>$zadanie33_2</td>
					<td><a href='index.php?sid=39&id=$id33_2' data-toggle='tooltip' title='Edytuj'><i class='fa fa-edit' style='font-size: 17px;'></i></a>&nbsp;&nbsp;<a href='index.php?sid=41&id=$id33_2' data-toggle='tooltip' title='Usuń'><i class='fa fa-trash' style='font-size: 17px; color: red;'></i></a></td>
				</tr>
				";
			}
		echo "</table><div style='height: 20px;'></div>";
	}
	//-----------
echo '</div></section>';
break;

case 34:
$tresc34 = addslashes($_POST['tresc']);
mysqli_query($connect,"INSERT INTO `zadania_korektor` (`zadanie`) VALUES ('$tresc34')");
header("Location: index.php?sid=33&correct=ADDED");
break;

case 35:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Zadania dla użytkowników</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	$id35 = $_GET['id'];
	$q35 = mysqli_query($connect,"SELECT * FROM `zadania_korektor` WHERE `id` = $id35");
	$n35 = mysqli_num_rows($q35);
	if($n35 > 0){
		$s35 = mysqli_fetch_array($q35);
		$tresc35 = $s35['zadanie'];
	} else {header("Location: index.php?sid=33&error=POS_NOT_EXSTS");}
	echo "
	<h3>Edytuj zadanie Korektora</h3>
	<form action='index.php?sid=36' method='post'>
	<table class='table table-bordered'>
		<tr>
			<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Treść zadania:</td>
			<td><textarea class='form form-control' name='tresc' style='height: 170px;' required>$tresc35</textarea></td>
		</tr>
		<tr>
			<td style='text-align: right;' colspan='2'><input type='hidden' name='id' value='$id35'><input type='submit' class='btn btn-success' value='Zapisz zmiany'></td>
		</tr>
	</table>
	</form>
	";
	//-----------
echo '</div></section>';
break;

case 36:
$tresc36 = addslashes($_POST['tresc']);
$id36 = $_POST['id'];
mysqli_query($connect,"UPDATE `zadania_korektor` SET `zadanie` = '$tresc36' WHERE `id` = $id36");
header("Location: index.php?sid=33&correct=SAVED");
break;

case 37:
$id37 = $_GET['id'];
mysqli_query($connect,"DELETE FROM `zadania_korektor` WHERE `id` = $id37");
header("Location: index.php?sid=33&correct=POS_DELETED");
break;

case 38:
$tresc38 = addslashes($_POST['tresc']);
mysqli_query($connect,"INSERT INTO `zadania_copywriter` (`zadanie`) VALUES ('$tresc38')");
header("Location: index.php?sid=33&correct=ADDED");
break;

case 39:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Zadania dla użytkowników</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	$id39 = $_GET['id'];
	$q39 = mysqli_query($connect,"SELECT * FROM `zadania_copywriter` WHERE `id` = $id39");
	$n39 = mysqli_num_rows($q39);
	if($n39 > 0){
		$s39 = mysqli_fetch_array($q39);
		$tresc39 = $s39['zadanie'];
	} else {header("Location: index.php?sid=33&error=POS_NOT_EXSTS");}
echo "
	<h3>Edytuj zadanie Copywritera</h3>
	<form action='index.php?sid=40' method='post'>
	<table class='table table-bordered'>
		<tr>
			<td style='padding: 14px; font-weight: bold; width: 1%;' nowrap='nowrap'>Treść zadania:</td>
			<td><input type='text' class='form form-control' name='tresc' required value='$tresc39'></td>
		</tr>
		<tr>
			<td style='text-align: right;' colspan='2'><input type='hidden' name='id' value='$id39'><input type='submit' class='btn btn-success' value='Zapisz zmiany'></td>
		</tr>
	</table>
	</form>
	";
	//-----------
echo '</div></section>';
break;

case 40:
$tresc40 = addslashes($_POST['tresc']);
$id40 = $_POST['id'];
mysqli_query($connect,"UPDATE `zadania_copywriter` SET `zadanie` = '$tresc40' WHERE `id` = $id40");
header("Location: index.php?sid=33&correct=SAVED");
break;

case 41:
$id41 = $_GET['id'];
mysqli_query($connect,"DELETE FROM `zadania_copywriter` WHERE `id` = $id41");
header("Location: index.php?sid=33&correct=POS_DELETED");
break;

case 42:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Konfiguracja wiadomości e-mail</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	echo '
	<style type="text/css">
		.kursDiv {
			background: #fbfbfb;
			border: 1px solid #f2f2f2;
			border-radius: 6px;
			padding: 20px;
			color: #454545;
			cursor: pointer;
			transition-duration: 1s;
		}
		
		.kursDiv:hover {
			background: #493d55;
			border: 1px solid #3f3648;
			border-radius: 6px;
			padding: 20px;
			color: #fff;
			cursor: pointer;
		}
	</style>
	';
	echo "<div class='row'>";
	echo "
	<!--============================================-->
	<div class='col-md-3' style='margin-bottom: 7px;'>
		<div style='width: 100%;'>
			<div class='kursDiv' style='padding-top: 40px; padding-bottom: 40px;' onClick=\"document.location.href='index.php?sid=43&id=rejestracja';\">
				<CENTER>
					<i class='fa fa-envelope' style='font-size: 35px;'></i>
					<h3 style='font-weight: bold; margin-top: 7px;'>Rejestracja</h3>
				</CENTER>
			</div>
		</div>
	</div>
	<!--============================================-->
	<div class='col-md-3' style='margin-bottom: 7px;'>
		<div style='width: 100%;'>
			<div class='kursDiv' style='padding-top: 40px; padding-bottom: 40px;' onClick=\"document.location.href='index.php?sid=43&id=akceptacja_wykonawcy';\">
				<CENTER>
					<i class='fa fa-envelope' style='font-size: 35px;'></i>
					<h3 style='font-weight: bold; margin-top: 7px;'>Akceptacja wykonawcy</h3>
				</CENTER>
			</div>
		</div>
	</div>
	<!--============================================-->
	";
	echo "</div>";
	//-----------
echo '</div></section>';
break;

case 43:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Konfiguracja wiadomości e-mail</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	$id43 = $_GET['id'];
	switch($id43){
	//====================================================================
	//====================================================================
	case 'rejestracja':
	//====================================================================
	// POSTS =============================================================
	$try43 = $_POST['try'];
	$rejestracja_zleceniodawca_tresc = addslashes($_POST['rejestracja_zleceniodawca_tresc']);
	$rejestracja_wykonawca_tresc = addslashes($_POST['rejestracja_wykonawca_tresc']);
	if(!empty($try43) AND $try43 == "1"){
		mysqli_query($connect,"DELETE FROM `mail_templates` WHERE `mail_id` = 'rejestracja_zleceniodawca'");
		mysqli_query($connect,"INSERT INTO `mail_templates` (`mail_id`,`tresc`) VALUES ('rejestracja_zleceniodawca','$rejestracja_zleceniodawca_tresc')");
		
		mysqli_query($connect,"DELETE FROM `mail_templates` WHERE `mail_id` = 'rejestracja_wykonawca'");
		mysqli_query($connect,"INSERT INTO `mail_templates` (`mail_id`,`tresc`) VALUES ('rejestracja_wykonawca','$rejestracja_wykonawca_tresc')");
		correct(SAVED);
	}
	//====================================================================
		$q43_rejestracja_1 = mysqli_query($connect,"SELECT * FROM `mail_templates` WHERE `mail_id` = 'rejestracja_zleceniodawca' ORDER BY `id` DESC LIMIT 1");
		$s43_rejestracja_1 = mysqli_fetch_array($q43_rejestracja_1);
			$tresc43_rejestracja_1 = $s43_rejestracja_1['tresc'];
			
		$q43_rejestracja_2 = mysqli_query($connect,"SELECT * FROM `mail_templates` WHERE `mail_id` = 'rejestracja_wykonawca' ORDER BY `id` DESC LIMIT 1");
		$s43_rejestracja_2 = mysqli_fetch_array($q43_rejestracja_2);
			$tresc43_rejestracja_2 = $s43_rejestracja_2['tresc'];
		echo "
		<form action='' method='post'>
		<input type='hidden' name='try' value='1'>
		<table class='table table-bordered'>
			<tr>
				<td colspan='2' style='text-align: center; padding: 20px; font-size: 20px; font-weight: bold;'>Wiadomość rejestracyjna - Zleceniodawca</td>
			</tr>
			<tr>
				<td style='font-weight: bold; padding: 14px; width: 1%;' nowrap='nowrap'>Treść wiadomości:</td>
				<td><textarea id='summernote' name='rejestracja_zleceniodawca_tresc'>$tresc43_rejestracja_1</textarea></td>
			</tr>
			<tr>
				<td colspan='2' style='background: #eaeaea;'></td>
			</tr>
			<tr>
				<td colspan='2' style='text-align: center; padding: 20px; font-size: 20px; font-weight: bold;'>Wiadomość rejestracyjna - Wykonawca</td>
			</tr>
			<tr>
				<td style='font-weight: bold; padding: 14px; width: 1%;' nowrap='nowrap'>Treść wiadomości:</td>
				<td><textarea id='summernote2' name='rejestracja_wykonawca_tresc'>$tresc43_rejestracja_2</textarea></td>
			</tr>
			<tr>
				<td colspan='2' style='text-align: right;'><input type='submit' class='btn btn-primary' value='Zapisz zmiany'></td>
			</tr>
		</table>
		</form>
		";
	break;
	
	case 'akceptacja_wykonawcy':
		$try43_2 = $_POST['try2'];
		$akceptacja_wykonawcy_tresc = addslashes($_POST['akceptacja_wykonawcy_tresc']);
		if(!empty($try43_2) AND $try43_2 == "1"){
			mysqli_query($connect,"DELETE FROM `mail_templates` WHERE `mail_id` = 'akceptacja_wykonawcy'");
			mysqli_query($connect,"INSERT INTO `mail_templates` (`mail_id`,`tresc`) VALUES ('akceptacja_wykonawcy','$akceptacja_wykonawcy_tresc')");
			
			correct(SAVED);
		}
		//====================================================================
			$q43_2 = mysqli_query($connect,"SELECT * FROM `mail_templates` WHERE `mail_id` = 'akceptacja_wykonawcy' ORDER BY `id` DESC LIMIT 1");
			$s43_2 = mysqli_fetch_array($q43_2);
				$tresc43_2 = $s43_2['tresc'];
				
			echo "
			<form action='' method='post'>
			<input type='hidden' name='try2' value='1'>
			<table class='table table-bordered'>
				<tr>
					<td colspan='2' style='text-align: center; padding: 20px; font-size: 20px; font-weight: bold;'>Wiadomość informująca o akceptacji zadania wykonawcy</td>
				</tr>
				<tr>
					<td style='font-weight: bold; padding: 14px; width: 1%;' nowrap='nowrap'>Treść wiadomości:</td>
					<td><textarea id='summernote' name='akceptacja_wykonawcy_tresc'>$tresc43_2</textarea></td>
				</tr>
				<tr>
					<td colspan='2' style='text-align: right;'><input type='submit' class='btn btn-primary' value='Zapisz zmiany'></td>
				</tr>
			</table>
			</form>
			";
	break;
	//====================================================================
	//====================================================================
	}
	//-----------
echo '</div></section>';
break;

case 44:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Informacja dla zlecających</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	$q44 = mysqli_query($connect,"SELECT * FROM `tworzenie_legenda` ORDER BY `id` DESC LIMIT 1");
	$s44 = mysqli_fetch_array($q44);
		$legenda44 = $s44['legenda'];
		$informacje44 = $s44['informacje'];
	echo "
	<form action='index.php?sid=45' method='post'>
		<table class='table table-bordered'>
			<tr>
				<td style='font-weight: bold; padding: 14px;'>Legenda:</td>
				<td><textarea name='legenda' id='summernote'>$legenda44</textarea></td>
			</tr>
			<tr>
				<td style='font-weight: bold; padding: 14px;'>Informacje:</td>
				<td><textarea name='informacje' id='summernote2'>$informacje44</textarea></td>
			</tr>
			<tr>
				<td style='text-align: right;' colspan='2'><input type='submit' class='btn btn-primary' value='Zapisz zmiany'></td>
			</tr>
		</table>
	</form>
	";
	//-----------
echo '</div></section>';
break;

case 45:
	$legenda45 = addslashes($_POST['legenda']);
	$informacje45 = addslashes($_POST['informacje']);
	mysqli_query($connect,"TRUNCATE TABLE `tworzenie_legenda`");
	mysqli_query($connect,"INSERT INTO `tworzenie_legenda` (`legenda`,`informacje`) VALUES ('$legenda45','$informacje45')");
	header("Location: index.php?sid=44&correct=SAVED");
break;

case 46:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Ustawienia wypłat</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	$q46 = mysqli_query($connect,"SELECT * FROM `payout_settings` ORDER BY `id` DESC LIMIT 1");
	$s46 = mysqli_fetch_array($q46);
		$min_payout46 = $s46['min_payout'];
		$ramka46 = $s46['ramka'];
	echo "
	<form action='index.php?sid=47' method='post'>
		<div class='row'>
			<div class='col-md-4' style='margin-bottom: 10px;'>
				<h4>Minimalna kwota wypłaty</h4>
				<table class='table table-bordered'>
					<tr>
						<td style='font-weight: bold; padding: 14px;'>Kwota:</td>
						<td><input type='text' name='kwota' class='form form-control' value='$min_payout46' required></td>
					</tr>
				</table>
			</div>
			<div class='col-md-8' style='margin-bottom: 10px;'>
				<h4>Ramka informacyjna</h4>
				<table class='table table-bordered'>
					<tr>
						<td style='font-weight: bold; padding: 14px;'>Treść:</td>
						<td><textarea name='tresc' id='summernote'>$ramka46</textarea></td>
					</tr>
				</table>
			</div>
		</div>
		<div style='margin-top: 10px; text-align: right;'>
			<input type='submit' class='btn btn-primary' value='Zapisz'>
		</div>
	</form>
	";
	//-----------
echo '</div></section>';
break;

case 47:
	$kwota47 = addslashes($_POST['kwota']);
		$kwota47 = str_replace(",",".",$kwota47);
	$tresc47 = addslashes($_POST['tresc']);
	mysqli_query($connect,"TRUNCATE TABLE `payout_settings`");
	mysqli_query($connect,"INSERT INTO `payout_settings` (`min_payout`,`ramka`) VALUES ('$kwota47','$tresc47')");
	header("Location: index.php?sid=46&correct=SAVED");
break;

case 48:
echo '
<section class="tile">
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">Zlecenia wypłat</h1>
	</div>
  <div class="tile-body">';
	//----------
	showRespond($_GET['error'],$_GET['correct']);
	//----------
	$q48 = mysqli_query($connect,"SELECT * FROM `payouts` ORDER BY `id` ASC");
	$n48 = mysqli_num_rows($q48);
	if($n48 > 0){
		echo "<h4>Zlecenia wypłat</h4>";
		echo "<table class='table table-striped'>";
		echo "
		<tr>
			<td style='font-weight: bold; width: 1%;' nowrap='nowrap'>Data zlecenia</td>
			<td style='font-weight: bold;'>Użytkownik</td>
			<td style='font-weight: bold;'>Numer konta</td>
			<td style='font-weight: bold;'>Kwota do wypłaty</td>
			<td style='font-weight: bold; text-align: right;'>Operacje</td>
		</tr>
		";
		while($s48 = mysqli_fetch_array($q48)){
			$data48 = $s48['data'];
			$user_id48 = $s48['user_id'];
			$kwota48 = $s48['kwota'];
			$id48 = $s48['id'];
			$bank_acc48 = $s48['bank_acc'];
			//--------------------------------------
			$q48_2 = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $user_id48");
			$s48_2 = mysqli_fetch_array($q48_2);
				$imie48 = $s48_2['imie']." ".$s48_2['nazwisko'];
			//--------------------------------------
			echo "
			<tr>
				<td style='width: 1%;' nowrap='nowrap'>$data48</td>
				<td>$imie48</td>
				<td>$bank_acc48</td>
				<td>$kwota48 zł</td>
				<td style='text-align: right;'>
					<a href='index.php?sid=49&id=$id48' data-toggle='tooltip' title='Oznacz pozycję jako wypłaconą i usuń ją z listy' onclick=\"return confirm('Jesteś pewien, że chcesz zamknąć tę pozycję?');\" style='color: #5cb900;'><i class='fa fa-check-circle'  style='font-size: 17px;'></i></a>
				</td>
			</tr>
			";
		}
		echo "</table>";
	} else {errorIMG("Brak zleceń wypłat!");}
	//-----------
echo '</div></section>';
break;

case 49:
	$id49 = $_GET['id'];
	mysqli_query($connect,"DELETE FROM `payouts` WHERE `id` = $id49");
	header("Location: index.php?sid=48&correct=POS_DELETED");
break;

//======================================================================
default:
echo "<CENTER><img src='images/404.png'><div style='height: 12px;'></div><h4>Strona nie została znaleziona!</h4></CENTER>";
//-----------
 echo '</div></section>'; 
 break;
//======================================================================
//======================================================================
}
//======================================================================
?>
</div>
</section>