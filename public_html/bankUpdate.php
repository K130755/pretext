<?php
ob_start();
session_start();
include("admin/inc/conn.php");

if(!empty($_SESSION['user_id'])){
	$bank_acc = trim(addslashes(strip_tags($_POST['bank_acc'])));
	mysqli_query($connect,"UPDATE `users` SET `bank_acc` = '$bank_acc' WHERE `id` = ".$_SESSION['user_id']);
	header("Location: wallet?correct=Twoje konto bankowe zostało zaktualizowane!");
} else {header("Location: login");exit;}
?>