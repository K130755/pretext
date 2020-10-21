<?php include("inc/head.php"); ?>
<?php if(!isset($_SESSION['user_id']) AND empty($_SESSION['user_id'])){header("Location: login");} ?>
<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/dashboardTop.php"); ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="nav-uzytkownik">
                    <div class="row">
                        <?php include("inc/dashMenu.php"); ?>
                    </div>
                </div>
            </div>
        </div>
        
				<?php
				showRespond($_GET['error'],$_GET['correct']);
				
				$qMojWallet = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = ".$_SESSION['user_id']);
				$sMojWallet = mysqli_fetch_array($qMojWallet);
					$wallet = $sMojWallet['wallet'];
				//==============================================================
				$qPS = mysqli_query($connect,"SELECT * FROM `payout_settings` ORDER BY `id` DESC LIMIT 1");
				$sPS = mysqli_fetch_array($qPS);
					$min_payout = $sPS['min_payout'];
					$ramka = $sPS['ramka'];
				?>
				<div class="row justify-content-center">
            <div class="col-10">
                <div class="row m-t-100">
                    <div class="col-12">
                        <div class="fw-700 fs-16">Stan Twojego konta:</div>
                        <div class="fs-18 fw-700 fc-v"><?=$wallet;?> punktów</div>
                        <hr class="hr-min" />
                    </div>
                </div>
                <div class="row m-t-50">
                    <?php if($moj_typ != "wykonawca") { ?>
										<div class="col-12 col-md-5 col-lg-4" style="margin-bottom: 10px;">
                        <div class="bordered-l-5">
                            <div class="fs-16 fw-700">Doładuj swoje konto</div>
														<?php
															$kredyt_submit = trim(addslashes(strip_tags($_POST['kredyt_submit'])));
															if($kredyt_submit == "custom"){
																$kredyt_submit = trim(addslashes(strip_tags($_POST['kredyty'])));
															}
															//----------------------------------------
															if(!empty($kredyt_submit) AND $kredyt_submit != "0"){
																echo "<h4>Doładowanie na kwotę <span style='color: #da3070;'>$kredyt_submit zł</span></h4>";
																//======================================
																$hashPlatnosci = sha1(md5(time().rand(999,9999999)));
																//----------------
																mysqli_query($connect,"INSERT INTO `wallet_doladowania` (`user_id`,`order_id`,`data`) VALUES ('".$_SESSION['user_id']."','$hashPlatnosci','".strtotime(date("Y-m-d"))."')");
																//----------------
																$qGetOldOrders5 = mysqli_query($connect,"SELECT * FROM `wallet_doladowania` WHERE `user_id` = ".$_SESSION['user_id']);
																$nGetOldOrders5 = mysqli_num_rows($qGetOldOrders5);
																if($nGetOldOrders5 > 0){
																	while($sGetOldOrders5 = mysqli_fetch_array($qGetOldOrders5)){
																		$dataGetOldOrders5 = $sGetOldOrders5['data'];
																		$data_now5 = strtotime(date("Y-m-d"));
																		$idGetOldOrders5 = $sGetOldOrders5['id'];
																		if(($data_now5 - $dataGetOldOrders5) > 345600){
																			mysqli_query($connect,"DELETE FROM `wallet_doladowania` WHERE `id` = $idGetOldOrders5");
																		}
																	}
																}
																$qClearWalletOrders = mysqli_query($connect,"SELECT * FROM `wallet_doladowania`");
																$nClearWalletOrders = mysqli_num_rows($qClearWalletOrders);
																if($nClearWalletOrders == 0){
																	mysqli_query($connect,"TRUNCATE TABLE `wallet_doladowania`");
																}
																//----------------
																$kredyt_submit = $kredyt_submit * 100;
																$p24_sign100 = md5($hashPlatnosci."|112790|"."$kredyt_submit"."|PLN|8061c73a1db4de45");
																echo '
																<form action="https://secure.przelewy24.pl/trnDirect" method="post" class="form">
																<input type="hidden" name="p24_session_id" value="'.$hashPlatnosci.'">
																<input type="hidden" name="p24_merchant_id" value="112790">
																<input type="hidden" name="p24_pos_id" value="112790">
																<input type="hidden" name="p24_amount" value="'.$kredyt_submit.'">
																<input type="hidden" name="p24_currency" value="PLN">
																<input type="hidden" name="p24_description" value="'.$hashPlatnosci.'">
																<input type="hidden" name="p24_client" value="'.$moje_imie.' '.$moje_nazwisko.'">
																<input type="hidden" name="p24_country" value="PL">
																<input type="hidden" name="p24_email" value="'.$moj_email.'">
																<input type="hidden" name="p24_language" value="pl">
																<input type="hidden" name="p24_encoding" value="UTF-8">
																<input type="hidden" name="p24_url_return" value="https://pretext.eu/paymentProcess">
																<input type="hidden" name="p24_url_status" value="https://pretext.eu/payment/statusPayMe.php">
																<input type="hidden" name="p24_api_version" value="3.2">
																<input type="hidden" name="p24_sign" value="'.$p24_sign100.'">
																';
																echo "<div style='text-align: center; margin-top: 20px;'><button type='submit' class='btn btn-primary' style='padding: 10px; font-weight: bold;'><i class='la la-credit-card'></i>&nbsp;&nbsp;".($kredyt_submit/100)." zł - Zapłać On-Line</button></div></form>";
																
															} else {
														?>
                            <form method="post" accept-charset="utf-8" action="">
                                <table class="table doladowania-table">
                                    <tbody>
                                        <tr>
                                            <td>10 punktów</td>
                                            <td class="credit-price">10 &#122;&#322;</td>
                                            <td class="text-right">
                                                <button type="submit" class="btn btn-primary btn-sm" name="kredyt_submit" value="10">doładuj</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>30 punktów</td>
                                            <td class="credit-price">30 &#122;&#322;</td>
                                            <td class="text-right">
                                                <button type="submit" class="btn btn-primary btn-sm" name="kredyt_submit" value="30">doładuj</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>40 punktów</td>
                                            <td class="credit-price">40 &#122;&#322;</td>
                                            <td class="text-right">
                                                <button type="submit" class="btn btn-primary btn-sm" name="kredyt_submit" value="40">doładuj</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>70 punktów</td>
                                            <td class="credit-price">70 &#122;&#322;</td>
                                            <td class="text-right">
                                                <button type="submit" class="btn btn-primary btn-sm" name="kredyt_submit" value="70">doładuj</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>90 punktów</td>
                                            <td class="credit-price">90 &#122;&#322;</td>
                                            <td class="text-right">
                                                <button type="submit" class="btn btn-primary btn-sm" name="kredyt_submit" value="90">doładuj</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>120 punktów</td>
                                            <td class="credit-price">120 &#122;&#322;</td>
                                            <td class="text-right">
                                                <button type="submit" class="btn btn-primary btn-sm" name="kredyt_submit" value="120">doładuj</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>220 punktów</td>
                                            <td class="credit-price">220 &#122;&#322;</td>
                                            <td class="text-right">
                                                <button type="submit" class="btn btn-primary btn-sm" name="kredyt_submit" value="220">doładuj</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <div>Wprowadź własną liczbę punktów:</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="number" kredyt-cena="1" name="kredyty" class="credit-custom-val form-control" />
                                            </td>
                                            <td class="credit-price" id="kredyt-custom-cena">0 &#122;&#322;</td>
                                            <td class="text-right">
                                                <button type="submit" class="btn btn-primary btn-sm" name="kredyt_submit" value="custom">doładuj</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
														<?php } ?>
                        </div>
                    </div>
										<?php } ?>
                    <div class="col-12 <?php if($moj_typ != "wykonawca"){echo 'col-md-3 col-lg-3';} else {echo 'col-md-7 col-lg-7';} ?>" style="margin-bottom: 10px;">
                        <div class="bordered-l-5">
                            <div class="fs-16 fw-700">Wypłać swoje środki</div>
                            <div class="m-t-10">Dostępne środki: <span class="fc-gold fw-700"><?=$wallet;?> punktów</span></div>
                            <form method="post" accept-charset="utf-8" id="portfel-wyplata-form" action="payout">
                                <div class="form-group text required">
                                    <label for="portfel-wyplac-kredyty-input">Wprowadź liczbę punktów do wypłaty:</label>
                                    <input type="text" class="form-control " name="ilosc" style="max-width:180px;" />
                                </div>
                                <div class="form-group checkbox">
                                    <div>
                                        <input type="checkbox" name="all" value="1">
                                        <label for="wszystko">wypłać wszystko</label>
                                    </div>
                                </div>
                                <div class="portfel-wyplata-submit">
                                    <button type="submit" class="btn btn-primary btn-sm">Zleć wypłatę środków na swoje konto <i class="fa fa-angle-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
										<div class="col-12 <?php if($moj_typ != "wykonawca"){echo 'col-md-4 col-lg-4';} else {echo 'col-md-5 col-lg-5';} ?>" style="margin-bottom: 10px;">
											<div style="background: #f7f7f7; border: 1px solid #cccccc; padding: 10px; width: 100%;">
												<?=$ramka;?>
											</div>
											<div style="margin-top: 20px; text-align: right;">
												<form action="bankUpdate.php" method="post">
													<input type="text" name="bank_acc" class="form form-control" placeholder="Numer konta bankowego" value="<?=$moje_konto_bankowe;?>" required>
													<div style="height: 7px;"></div>
													<input type="submit" class="btn btn-primary" value="Zaktualizuj konto">
												</form>
											</div>
										</div>
                </div>
            </div>
        </div>
				
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>