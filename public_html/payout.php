<?php
ob_start();
session_start();
include("admin/inc/conn.php");
//----------------------------------------------------------------------
$qPS = mysqli_query($connect,"SELECT * FROM `payout_settings` ORDER BY `id` DESC LIMIT 1");
$sPS = mysqli_fetch_array($qPS);
	$min_payout = $sPS['min_payout'];
	$ilosc = trim(addslashes(strip_tags($_POST['ilosc'])));
		$ilosc = str_replace(",",".",$ilosc);
	$all = trim(addslashes(strip_tags($_POST['all'])));
//----------------------------------------------------------------------
if(!empty($_SESSION['user_id'])){
	$q = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = ".$_SESSION['user_id']);
	$n = mysqli_num_rows($q);
	if($n > 0){
		$s = mysqli_fetch_array($q);
		$wallet = $s['wallet'];
		$bank_acc = $s['bank_acc'];
		if($all == "1"){$wyplac = $wallet;} else {$wyplac = $ilosc;}
		if($wyplac >= $min_payout){
			if($wyplac <= $wallet){
				if(!empty($bank_acc)){
					$newWallet = $wallet - $wyplac;
					mysqli_query($connect,"UPDATE `users` SET `wallet` = '$newWallet' WHERE `id` = ".$_SESSION['user_id']);
					mysqli_query($connect,"INSERT INTO `wallet_history` (`user_id`,`kwota`,`opis`,`data`) VALUES ('".$_SESSION['user_id']."','-$wyplac','Wypłata środków na konto bankowe','".date("Y-m-d H:i")."')");
					mysqli_query($connect,"INSERT INTO `wallet_counter` (`user_id`,`kwota`,`in`,`out`) VALUES ('".$_SESSION['user_id']."','$wyplac','0','1')");
					mysqli_query($connect,"INSERT INTO `payouts` (`user_id`,`kwota`,`data`,`bank_acc`) VALUES ('".$_SESSION['user_id']."','$wyplac','".date("Y-m-d H:i")."','$bank_acc')");
					header("Location: wallet?correct=Przyjęliśmy Twoje zlecenie. Wypłata zostanie zrealizowana w ciągu 48h.");
				} else {header("Location: wallet?error=Wprowadź numer konta bankowego do wypłat!");}
			} else {header("Location: wallet?error=Brak wystarczających środków w portfelu!");}
		} else {header("Location: wallet?error=Minimalna kwota do wypłaty to $min_payout złotych!");}
	} else {header("Location: logout");exit;}
} else {header("Location: login");exit;}
?>