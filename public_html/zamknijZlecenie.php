<?php include("inc/head.php"); ?>

<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/top.php"); ?>
    <div class="container login-container">
        <div class="row">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9 col-lg-8 pd-t-35">
                        <div class="row row-special-head">
                            <div class="col-12">
                                <div class="special-head">Zamknij zlecenie</div>
                            </div>
                        </div>
												<?php
												$id = trim(addslashes(strip_tags($_GET['id'])));
												$q = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $id AND `user_id` = ".$_SESSION['user_id']);
												$n = mysqli_num_rows($q);
												if($n > 0){
												$s = mysqli_fetch_array($q);
													$cena = $s['cena'];
													$dlugosc_od = $s['dlugosc_od'];
													$dlugosc_do = $s['dlugosc_do'];
													$tytul = $s['tytul'];
													$typ = $s['typ'];
													$wykonawca_id = $s['wykonawca_id'];
													
													mysqli_query($connect,"UPDATE `realizacje` SET `closed` = '1' WHERE `zlecenie_id` = $id AND `canceled` != '1'");
													mysqli_query($connect,"UPDATE `zlecenia` SET `closed` = '1' WHERE `id` = $id");
													//---------------------------------------
													// WALLET STUFF -------------------------
													//---------------------------------------
													if($typ == "nowy"){
														if($dlugosc_od == $dlugosc_do OR empty($dlugosc_do) OR $dlugosc_do == "0"){
															$dlugoscProwizja = $dlugosc_od;
														} else {
															$dlugoscProwizja = $dlugosc_do;
														}
														//$iloscProwizja = $dlugoscProwizja / 1000;
														//$total = ($cena*$iloscProwizja)/1.23;
														
														
														$qWalletMan = mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `zlecenie_id` = $id AND `wykonawca_id` = $wykonawca_id AND `canceled` != '1'");
														$nWalletMan = mysqli_num_rows($qWalletMan);
														if($nWalletMan > 0){
															$sWalletMan = mysqli_fetch_array($qWalletMan);
															$wykonawca_idWalletMan = $sWalletMan['wykonawca_id'];
															$trescWalletMan = $sWalletMan['tresc'];
															
															$dlugosc_tekstu = strlen(trim(strip_tags($trescWalletMan)));
															if($dlugosc_tekstu > $dlugoscProwizja){$dlugosc_tekstu = $dlugoscProwizja;}
															//----------------
															$total = number_format(((($dlugosc_tekstu/1000)*$cena) / 1.23),2);
															$pobrano_od_zlecajacego = number_format((($dlugoscProwizja / 1000) * $cena),2);
															$zwrot_do_zlecajacego = $pobrano_od_zlecajacego - $total;
															//----------------
															
															$qWallet = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $wykonawca_idWalletMan");
															$sWallet = mysqli_fetch_array($qWallet);
															$newWallet = $total+$sWallet['wallet'];
															$count_nowy = $sWallet['count_nowy'];
															$count_korekta = $sWallet['count_korekta'];
															mysqli_query($connect,"UPDATE `users` SET `wallet` = '$newWallet' WHERE `id` = $wykonawca_idWalletMan");
															if($zwrot_do_zlecajacego > 0){
																$qZlecajacy = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = ".$_SESSION['user_id']);
																$sZlecajacy = mysqli_fetch_array($qZlecajacy);
																	$walletOldZlecajacy = $sZlecajacy['wallet'];
																	$walletNewZlecajacy = $walletOldZlecajacy + $zwrot_do_zlecajacego;
																	mysqli_query($connect,"UPDATE `users` SET `wallet` = '$walletNewZlecajacy' WHERE `id` = ".$_SESSION['user_id']);
															}
															//-------------
															// COUNTER ----
															//-------------
															$count_nowy_new = $count_nowy + 1;
															mysqli_query($connect,"UPDATE `users` SET `count_nowy` = '$count_nowy_new' WHERE `id` = $wykonawca_idWalletMan");
															//-------------
															postNotif($wykonawca_idWalletMan,"Zaakceptowano Twoją realizację","Twoja realizacja tekstu w zleceniu <a href='https://pretext.eu/joinOffer-$id'><B>$tytul</B></a> została zatwierdzona przez użytkownika <B>$moj_nick</B>.<BR>Twoje konto zostało zasilone przypisaną kwotą.");
														}
													} else if($typ == "korekta"){
														if($dlugosc_od == $dlugosc_do OR empty($dlugosc_do) OR $dlugosc_do == "0"){
															$dlugoscProwizja = $dlugosc_od;
														} else {
															$dlugoscProwizja = $dlugosc_do;
														}
														//$iloscProwizja = $dlugoscProwizja / 1000;
														//$total = ($cena*$iloscProwizja)/1.23;
														
														
														$qWalletMan = mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `zlecenie_id` = $id AND `wykonawca_id` = $wykonawca_id AND `canceled` != '1'");
														$nWalletMan = mysqli_num_rows($qWalletMan);
														if($nWalletMan > 0){
															$sWalletMan = mysqli_fetch_array($qWalletMan);
															$wykonawca_idWalletMan = $sWalletMan['wykonawca_id'];
															
															if($dlugosc_od != "0" AND !empty($dlugosc_od)){
																$dlugosc_tekstu = $dlugosc_od;
																//----------------
																$total = number_format(((($dlugosc_tekstu/1000)*$cena) / 1.23),2);
																$pobrano_od_zlecajacego = number_format((($dlugoscProwizja / 1000) * $cena),2);
																$zwrot_do_zlecajacego = $pobrano_od_zlecajacego - $total;
																//----------------
																
																$qWallet = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $wykonawca_idWalletMan");
																$sWallet = mysqli_fetch_array($qWallet);
																$newWallet = $total+$sWallet['wallet'];
																$count_nowy = $sWallet['count_nowy'];
																$count_korekta = $sWallet['count_korekta'];
																mysqli_query($connect,"UPDATE `users` SET `wallet` = '$newWallet' WHERE `id` = $wykonawca_idWalletMan");
																if($zwrot_do_zlecajacego > 0){
																	$qZlecajacy = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = ".$_SESSION['user_id']);
																	$sZlecajacy = mysqli_fetch_array($qZlecajacy);
																		$walletOldZlecajacy = $sZlecajacy['wallet'];
																		$walletNewZlecajacy = $walletOldZlecajacy + $zwrot_do_zlecajacego;
																		mysqli_query($connect,"UPDATE `users` SET `wallet` = '$walletNewZlecajacy' WHERE `id` = ".$_SESSION['user_id']);
																}
																//-------------
																// COUNTER ----
																//-------------
																$count_korekta_new = $count_korekta + 1;
																mysqli_query($connect,"UPDATE `users` SET `count_korekta` = '$count_korekta_new' WHERE `id` = $wykonawca_idWalletMan");
																//-------------
																postNotif($wykonawca_idWalletMan,"Zaakceptowano Twoją realizację","Twoja realizacja tekstu w zleceniu <a href='https://pretext.eu/joinOffer-$id'><B>$tytul</B></a> została zatwierdzona przez użytkownika <B>$moj_nick</B>.<BR>Twoje konto zostało zasilone przypisaną kwotą.");
															}
														}
													}
													//---------------------------------------
													//---------------------------------------
													mysqli_query($connect,"DELETE FROM `kolejka` WHERE `zlecenie_id` = $id");
													//---------------------------------------
													header("Location: mojeZlecenia");
												} else {header("Location: mojeZlecenia");}
												?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>