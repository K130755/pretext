<?php
ob_start();
session_start();
error_reporting(0);
include("../admin/inc/conn.php");
//----------------------------
//============================================
$p24_session_id = trim(addslashes(strip_tags($_POST['p24_session_id'])));
$q = mysqli_query($connect,"SELECT * FROM `wallet_doladowania` WHERE `order_id` = '$p24_session_id'") or die("error0");
$n = mysqli_num_rows($q);
if($n > 0){
	$s = mysqli_fetch_array($q);
	$id = $s['id'];
	$user_id = $s['user_id'];
	$kwota = ($_POST['p24_amount'] / 100);
	
	$qGetUser = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $user_id");
	$sGetUser = mysqli_fetch_array($qGetUser);
		$walletOld = $sGetUser['wallet'];
		$walletNew = $walletOld + $kwota;
		mysqli_query($connect,"UPDATE `users` SET `wallet` = '$walletNew' WHERE `id` = $user_id");
		mysqli_query($connect,"INSERT INTO `wallet_counter` (`user_id`,`kwota`,`in`,`out`) VALUES ('$user_id','$kwota','1','0')");
		mysqli_query($connect,"INSERT INTO `wallet_history` (`user_id`,`kwota`,`opis`,`data`) VALUES ('$user_id','$kwota','Doładowanie konta kwotą $kwota','".date("Y-m-d H:i")."')");
	//------------------------------------------
	//------------------------------------------
	// ZWERYFIKUJ I ZAKSIEGUJ PLATNOSC ---------
	//------------------------------------------
	include("p24class.php");
	
	$p24_order_id = trim(addslashes(strip_tags($_POST['p24_order_id'])));
	$p24_merchant_id = trim(addslashes(strip_tags($_POST['p24_merchant_id'])));
	$p24_pos_id = trim(addslashes(strip_tags($_POST['p24_pos_id'])));
	
	$P24 = new Przelewy24("112790","112790","8061c73a1db4de45", "true");
	
	
	foreach($_POST as $k=>$v) $P24->addValue($k,$v);
	//$P24->addValue('p24_currency',"PLN");
  //$P24->addValue('p24_amount',($kwota * 100));
				
        $res = $P24->trnVerify();
	if(isset($res["error"]) and $res["error"] === '0')
            {
                $msg = 'Transakcja została zweryfikowana poprawnie';
            }
        else{
                $msg = 'Błędna weryfikacja transakcji';
        }
				//echo $msg." --- ".print_r($res);
	//------------------------------------------
	mysqli_query($connect,"DELETE FROM `wallet_doladowania` WHERE `id` = $id");
}
//============================================
?>