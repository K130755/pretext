<?php include("inc/head.php"); ?>
<?php if(!isset($_SESSION['user_id']) AND empty($_SESSION['user_id'])){header("Location: login");} ?>
<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>" onLoad="checkType();">
		<?php include("inc/dashboardTop.php"); ?>
    <div class="container">
				<?php
				showRespond($_GET['error'],$_GET['correct']);
				
				$id = trim(addslashes(strip_tags($_GET['id'])));
				//==============================================================
				$qSecurity = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $id AND `user_id` = ".$_SESSION['user_id']);
				$nSecurity = mysqli_num_rows($qSecurity);

				if($nSecurity == 0){header("Location: mojeZlecenia");exit;}else{
					$sLock = mysqli_fetch_array($qSecurity);
					if($sLock['wykonawca_id']=='0'){$Locked = false;}else{$Locked=true;}
				}


				//##############################################################
				$nCheckKorProbAcc = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `zlecenie_id` = $id AND `korekta_probna_zatwierdzona` = '1'"));
				
				$qRealizacja = mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `zlecenie_id` = $id AND `canceled` != '1'");
				$nRealizacja = mysqli_num_rows($qRealizacja);
				if($nRealizacja > 0){
					while($sRealizacja = mysqli_fetch_array($qRealizacja)){
						$wykonawca_idRealizacja = $sRealizacja['wykonawca_id'];
						//--------------
						$qWykonawca = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $wykonawca_idRealizacja");
						$sWykonawca = mysqli_fetch_array($qWykonawca);
							$imieWykonawca = $sWykonawca['imie']." ".$sWykonawca['nazwisko'];
						//--------------
						$typRealizacja = $sRealizacja['typ'];
						$korekta_probnaRealizacja = $sRealizacja['korekta_probna'];
						$trescRealizacja = $sRealizacja['tresc'];
						$korekta_probna_zatwierdzonaRealizacja = $sRealizacja['korekta_probna_zatwierdzona'];
						$korekta_plikRealizacja = $sRealizacja['korekta_plik'];
						
						if($nCheckKorProbAcc == 0 OR ($nCheckKorProbAcc > 0 AND $korekta_probna_zatwierdzonaRealizacja == "1")){
						
						echo '
						<div class="row">
								<div class="col-12">
										<div class="special-head">Realizacja - '.$imieWykonawca.'</div>
								</div>
						</div>
						';
						echo '
						<div class="row">
							<div class="col-12 col-md" style="text-align: right;"><a href="message-'.$wykonawca_idRealizacja.'"><i class="fa fa-envelope"></i> Wyślij wiadomość do wykonawcy</a></div>
						</div>
						<div style="height: 10px;"></div>
						';
						if(!empty($korekta_probnaRealizacja)){
							echo '
							<div style="margin-top: 10px; margin-bottom: 10px; background: #f8f8f8; border-left: 3px solid '; if($korekta_probna_zatwierdzonaRealizacja == "1"){echo "#428400;";}else{echo '#da3070;';} echo ' padding: 15px;">
								<h5 style="font-weight: bold;">Korekta próbna wykonawcy</h5>
								'.$korekta_probnaRealizacja.'
								';
								if($korekta_probna_zatwierdzonaRealizacja != "1"){
								echo '
								<div style="height: 15px;"></div>
								<div style="text-align: right;">
									<a href="acceptKorektaProbna-'.$id.'&wykonawca='.$wykonawca_idRealizacja.'" class="btn btn-primary"><i class="fa fa-check-circle"></i> Zaakceptuj korektę próbną</a>
								</div>
								';
								}
								echo '
							</div>
							';
							echo "<div style='height: 25px;'></div>";
						}
						if(!empty($trescRealizacja) OR !empty($korekta_plikRealizacja)){
							echo '
							<div style="margin-top: 0px; margin-bottom: 20px; background: #f8f8f8; border-left: 3px solid #428400; padding: 15px;">
								<h5 style="font-weight: bold;">Realizacja wykonawcy</h5>
								'.$trescRealizacja;
								if(!empty($korekta_plikRealizacja)){
									echo "
									<div style='height: 15px;'></div>
										<a class='btn btn-success' target='_blank' href='download/$korekta_plikRealizacja'><i class='fa fa-download'></i> Pobierz plik korekty właściwej</a>
									<div style='height: 15px;'></div>
									";
								}
								echo '
								<div style="height: 15px;"></div>
								<div style="text-align: right;">
								';
									if($typRealizacja == "nowy"){
										echo '<a href="zlecPoprawki-'.$id.'&wykonawca='.$wykonawca_idRealizacja.'" class="btn btn-info"><i class="fa fa-reply"></i> Oddaj do poprawek</a>&nbsp;&nbsp;';
									}
								echo '
									<a href="postAgain-'.$id.'" class="btn btn-primary"><i class="fa fa-trash"></i> Odrzuć i wystaw zlecenie ponownie</a>&nbsp;&nbsp;
									<a href="zamknijZlecenie-'.$id.'" class="btn btn-success"><i class="fa fa-check-circle"></i> Zaakceptuj i zamknij zlecenie</a>
								</div>
							</div>
							';
						}
						
						}
						
					}
				}
				?>
        <div class="row">
            <div class="col-12">
                <div class="special-head">Podgląd zlecenia</div>
            </div>
        </div>
				<?php
				$try = trim(addslashes(strip_tags($_POST['try'])));
				$typ = trim(addslashes(strip_tags($_POST['rodzaj'])));
				$podtyp = trim(addslashes(strip_tags($_POST['podtyp'])));
				$tytul = trim(addslashes(strip_tags($_POST['tytul'])));
				$kategoria = trim(addslashes(strip_tags($_POST['kategoria'])));
				$typ_tekstu = trim(addslashes(strip_tags($_POST['typ_tekstu'])));
				$dlugosc_od = trim(addslashes(strip_tags($_POST['dlugosc_od'])));
				$dlugosc_do = trim(addslashes(strip_tags($_POST['dlugosc_do'])));
				$cena = trim(addslashes(strip_tags($_POST['cena'])));
					$cena = str_replace(",",".",$cena);
				$slowa_kluczowe = trim(addslashes(strip_tags($_POST['tagi'])));
				$opis = trim(addslashes(strip_tags($_POST['opis'])));
				$tekst_probny = trim(addslashes(strip_tags($_POST['tekst_probny'])));
				$wykonawca_skutecznosc = trim(addslashes(strip_tags($_POST['wykonawca_skutecznosc'])));
				$wykonawca_doswiadczenie = trim(addslashes(strip_tags($_POST['wykonawca_doswiadczenie'])));
					$wykonawca_specjalizacje1 = trim(addslashes(strip_tags($_POST['ogranicz_kategoria'][0])));
					$wykonawca_specjalizacje2 = trim(addslashes(strip_tags($_POST['ogranicz_kategoria'][1])));
					$wykonawca_specjalizacje3 = trim(addslashes(strip_tags($_POST['ogranicz_kategoria'][2])));
					$wykonawca_specjalizacje4 = trim(addslashes(strip_tags($_POST['ogranicz_kategoria'][3])));
					$wykonawca_specjalizacje5 = trim(addslashes(strip_tags($_POST['ogranicz_kategoria'][4])));
					$wykonawca_specjalizacje6 = trim(addslashes(strip_tags($_POST['ogranicz_kategoria'][5])));
					$wykonawca_specjalizacje7 = trim(addslashes(strip_tags($_POST['ogranicz_kategoria'][6])));
					$wykonawca_specjalizacje8 = trim(addslashes(strip_tags($_POST['ogranicz_kategoria'][7])));
					$wykonawca_specjalizacje9 = trim(addslashes(strip_tags($_POST['ogranicz_kategoria'][8])));
					$wykonawca_specjalizacje10 = trim(addslashes(strip_tags($_POST['ogranicz_kategoria'][9])));
					$wykonawca_specjalizacje11 = trim(addslashes(strip_tags($_POST['ogranicz_kategoria'][10])));
					$wykonawca_specjalizacje12 = trim(addslashes(strip_tags($_POST['ogranicz_kategoria'][11])));
					$wykonawca_specjalizacje13 = trim(addslashes(strip_tags($_POST['ogranicz_kategoria'][12])));
					$wykonawca_specjalizacje14 = trim(addslashes(strip_tags($_POST['ogranicz_kategoria'][13])));
					$wykonawca_specjalizacje15 = trim(addslashes(strip_tags($_POST['ogranicz_kategoria'][14])));
					//----------------
					if(!empty($wykonawca_specjalizacje1)){$wykonawca_specjalizacje .= ",$wykonawca_specjalizacje1";}
					if(!empty($wykonawca_specjalizacje2)){$wykonawca_specjalizacje .= ",$wykonawca_specjalizacje2";}
					if(!empty($wykonawca_specjalizacje3)){$wykonawca_specjalizacje .= ",$wykonawca_specjalizacje3";}
					if(!empty($wykonawca_specjalizacje4)){$wykonawca_specjalizacje .= ",$wykonawca_specjalizacje4";}
					if(!empty($wykonawca_specjalizacje5)){$wykonawca_specjalizacje .= ",$wykonawca_specjalizacje5";}
					if(!empty($wykonawca_specjalizacje6)){$wykonawca_specjalizacje .= ",$wykonawca_specjalizacje6";}
					if(!empty($wykonawca_specjalizacje7)){$wykonawca_specjalizacje .= ",$wykonawca_specjalizacje7";}
					if(!empty($wykonawca_specjalizacje8)){$wykonawca_specjalizacje .= ",$wykonawca_specjalizacje8";}
					if(!empty($wykonawca_specjalizacje9)){$wykonawca_specjalizacje .= ",$wykonawca_specjalizacje9";}
					if(!empty($wykonawca_specjalizacje10)){$wykonawca_specjalizacje .= ",$wykonawca_specjalizacje10";}
					if(!empty($wykonawca_specjalizacje11)){$wykonawca_specjalizacje .= ",$wykonawca_specjalizacje11";}
					if(!empty($wykonawca_specjalizacje12)){$wykonawca_specjalizacje .= ",$wykonawca_specjalizacje12";}
					if(!empty($wykonawca_specjalizacje13)){$wykonawca_specjalizacje .= ",$wykonawca_specjalizacje13";}
					if(!empty($wykonawca_specjalizacje14)){$wykonawca_specjalizacje .= ",$wykonawca_specjalizacje14";}
					if(!empty($wykonawca_specjalizacje15)){$wykonawca_specjalizacje .= ",$wykonawca_specjalizacje15";}
				if(!empty($try) AND $try == "1"){
					if(!empty($tytul)){
						//================================
						// KOREKTA CEN ===================
						//================================
						$qoldPrice = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $id AND `user_id` = ".$_SESSION['user_id']);
						$soldPrice = mysqli_fetch_array($qoldPrice);
							$dlugosc_odoldPrice = $soldPrice['dlugosc_od'];
							$dlugosc_dooldPrice = $soldPrice['dlugosc_do'];
							$cenaoldPrice = $soldPrice['cena'];
							
							if($dlugosc_od != $dlugosc_odoldPrice OR $dlugosc_do != $dlugosc_dooldPrice OR $cena != $cenaoldPrice){
								if($nRealizacja > 0){
									header("Location: edytujZlecenie-$id&error=Nie możesz zmienić ceny i długości tekstu, jeden z wykonawców już podjął się realizacji!");exit;
								} else {
									//----------------------------------------------------
									if($dlugosc_odoldPrice == $dlugosc_dooldPrice OR empty($dlugosc_dooldPrice) OR $dlugosc_dooldPrice == "0"){
										$dlugoscProwizjaoldPrice = $dlugosc_odoldPrice;
									} else {
										$dlugoscProwizjaoldPrice = $dlugosc_dooldPrice;
									}
									$iloscProwizjaoldPrice = $dlugoscProwizjaoldPrice / 1000;
									
									
									$prowizjaoldPrice = number_format((($cenaoldPrice*$iloscProwizjaoldPrice)*PROWIZJA)/100,2);
									$totalProwizjaoldPrice = ($cenaoldPrice*$iloscProwizjaoldPrice)+$prowizjaoldPrice; // ZWROT
									
									$moj_nowy_walletoldPrice = $moj_wallet + $totalProwizjaoldPrice;
									//----------------------------------------------------
									if($dlugosc_od == $dlugosc_do OR empty($dlugosc_do) OR $dlugosc_do == "0"){
										$dlugoscProwizja = $dlugosc_od;
									} else {
										$dlugoscProwizja = $dlugosc_do;
									}
									$iloscProwizja = $dlugoscProwizja / 1000;
									
									
									$prowizja = number_format((($cena*$iloscProwizja)*PROWIZJA)/100,2);
									$totalProwizja = ($cena*$iloscProwizja)+$prowizja;
									if($moj_nowy_walletoldPrice >= $totalProwizja){
										mysqli_query($connect,"UPDATE `users` SET `wallet` = '$moj_nowy_walletoldPrice' WHERE `id` = ".$_SESSION['user_id']);
										//---
										$newWalletoldPrice = $moj_nowy_walletoldPrice - $totalProwizja;
										mysqli_query($connect,"UPDATE `users` SET `wallet` = '$newWalletoldPrice' WHERE `id` = ".$_SESSION['user_id']);
										//---
									} else {header("Location: edytujZlecenie-$id&error=Nie masz wystarczających środków na koncie, aby zmienić zakres cenowy tego zlecenia!");exit;}
									//----------------------------------------------------
								}
							}
						//================================
						// ULUBIENI ======================
						//================================
						$dla_ulubionych = "";
						$qFavs3 = mysqli_query($connect,"SELECT * FROM `favourites` WHERE `user_id` = ".$_SESSION['user_id']);
						$nFavs3 = mysqli_num_rows($qFavs3);
						if($nFavs3 > 0){
							while($sFavs3 = mysqli_fetch_array($qFavs3)){
								$idFavs3 = $sFavs3['lubiany'];
								if(!empty($_POST['dla_ulubionych'.$idFavs3]) AND $_POST['dla_ulubionych'.$idFavs3] == "1"){
									$dla_ulubionych .= ",$idFavs3";
								}
							}
						}
						//================================
						$plik_tmp = $_FILES['plik']['tmp_name'];
						$plik_nazwa = $_FILES['plik']['name'];
						$ext = pathinfo($_FILES['plik']['name'], PATHINFO_EXTENSION);
						$plik_nazwa = sha1(md5(time().rand(9999999,999999999999).$moj_email)).".".$ext;

						if(is_uploaded_file($plik_tmp)) {
							if($ext != "php" AND $ext != "PHP" AND $ext != "js" AND $ext != "JS"){
								move_uploaded_file($plik_tmp, "download/$plik_nazwa");
								//----------------
								$qPlikOld = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $id");
								$sPlikOld = mysqli_fetch_array($qPlikOld);
								$plikOld = $sPlikOld['korekta_plik'];
								if(!empty($plikOld)){
									unlink("download/$plikOld");
								}
								//----------------
								mysqli_query($connect,"UPDATE `zlecenia` SET `korekta_plik` = '$plik_nazwa' WHERE `id` = $id");
							} else {$plik_nazwa = "";}
						} else {$plik_nazwa = "";}
						//================================
						
						mysqli_query($connect,"UPDATE `zlecenia` SET `typ` = '$typ' WHERE `id` = $id");
						mysqli_query($connect,"UPDATE `zlecenia` SET `podtyp` = '$podtyp' WHERE `id` = $id");
						mysqli_query($connect,"UPDATE `zlecenia` SET `tytul` = '$tytul' WHERE `id` = $id");
						mysqli_query($connect,"UPDATE `zlecenia` SET `kategoria` = '$kategoria' WHERE `id` = $id");
						mysqli_query($connect,"UPDATE `zlecenia` SET `typ_tekstu` = '$typ_tekstu' WHERE `id` = $id");
						mysqli_query($connect,"UPDATE `zlecenia` SET `dlugosc_od` = '$dlugosc_od' WHERE `id` = $id");
						mysqli_query($connect,"UPDATE `zlecenia` SET `dlugosc_do` = '$dlugosc_do' WHERE `id` = $id");
						mysqli_query($connect,"UPDATE `zlecenia` SET `cena` = '$cena' WHERE `id` = $id");
						mysqli_query($connect,"UPDATE `zlecenia` SET `slowa_kluczowe` = '$slowa_kluczowe' WHERE `id` = $id");
						mysqli_query($connect,"UPDATE `zlecenia` SET `opis` = '$opis' WHERE `id` = $id");
						mysqli_query($connect,"UPDATE `zlecenia` SET `wykonawca_skutecznosc` = '$wykonawca_skutecznosc' WHERE `id` = $id");
						mysqli_query($connect,"UPDATE `zlecenia` SET `wykonawca_doswiadczenie` = '$wykonawca_doswiadczenie' WHERE `id` = $id");
						mysqli_query($connect,"UPDATE `zlecenia` SET `wykonawca_specjalizacje` = '$wykonawca_specjalizacje' WHERE `id` = $id");
						mysqli_query($connect,"UPDATE `zlecenia` SET `tekst_koretka_probna` = '$tekst_probny' WHERE `id` = $id");
						mysqli_query($connect,"UPDATE `zlecenia` SET `dla_ulubionych` = '$dla_ulubionych' WHERE `id` = $id");
						
						header("Location: mojeZlecenia?correct=Zmiany zostaly zapisane!");
					}
				} else {
				//==============================================================
				//==============================================================
				$qGetOffer = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $id AND `user_id` = ".$_SESSION['user_id']);
				$nGetOffer = mysqli_num_rows($qGetOffer);
				if($nGetOffer > 0){
					$sGetOffer = mysqli_fetch_array($qGetOffer);
					//---------------
					$wykonawca_idGetOffer = $sGetOffer['wykonawca_id'];
					$typGetOffer = $sGetOffer['typ'];
					$podtypGetOffer = $sGetOffer['podtyp'];
					$tytulGetOffer = $sGetOffer['tytul'];
					$kategoriaGetOffer = $sGetOffer['kategoria'];
					$typ_tekstuGetOffer = $sGetOffer['typ_tekstu'];
					$dlugosc_odGetOffer = $sGetOffer['dlugosc_od'];
					$dlugosc_doGetOffer = $sGetOffer['dlugosc_do'];
					$cenaGetOffer = $sGetOffer['cena'];
					$slowa_kluczoweGetOffer = $sGetOffer['slowa_kluczowe'];
					$opisGetOffer = $sGetOffer['opis'];
					$wykonawca_skutecznoscGetOffer = $sGetOffer['wykonawca_skutecznosc'];
					$wykonawca_doswiadczenieGetOffer = $sGetOffer['wykonawca_doswiadczenie'];
					$wykonawca_specjalizacjeGetOffer = $sGetOffer['wykonawca_specjalizacje'];
					$tekst_korekta_probnaGetOffer = $sGetOffer['tekst_korekta_probna'];
					$korekta_plikGetOffer = $sGetOffer['korekta_plik'];
					$closedGetOffer = $sGetOffer['closed'];
					$dla_ulubionychGetOffer = $sGetOffer['dla_ulubionych'];
					//---------------
					if($typGetOffer == "nowy"){
						echo '
						<script type="text/javascript">
						function checkType(){
							document.getElementById(\'rodzaj-tekst\').click();
							';
							if(!empty($wykonawca_skutecznoscGetOffer) OR !empty($wykonawca_doswiadczenieGetOffer) OR !empty($wykonawca_specjalizacjeGetOffer)){
								echo "
								document.getElementById('ogranicz').click();
								";
							}
							echo '
						}
						</script>
						';
					} else {
						echo '
						<script type="text/javascript">
						function checkType(){
							document.getElementById(\'rodzaj-korekta\').click();
							';
							if(!empty($wykonawca_skutecznoscGetOffer) OR !empty($wykonawca_doswiadczenieGetOffer) OR !empty($wykonawca_specjalizacjeGetOffer)){
								echo "
								document.getElementById('ogranicz').click();
								";
							}
							echo '
						}
						</script>
						';
					}
					if($closedGetOffer == "1"){header("Location: mojeZlecenia");exit;}
				} else {header("Location: mojeZlecenia");}
				?>
        <form enctype="multipart/form-data" method="post" accept-charset="utf-8" action="">
            <div style="display:none;">
                <input type="hidden" name="try" value="1" />
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-10">
                    <div class="row align-items-end">
                        <div class="col-12 col-md-12 col-lg-8">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group radio required">
                                        <label>Co chcesz zlecić?</label>
                                        <input type="hidden" class="form-control " name="rodzaj" value="" />
                                        <div>
                                            <input type="radio" name="rodzaj" value="nowy" active-form="tekst" id="rodzaj-tekst" required="required" style="float: left; margin-top: 4px;" <?php if($Locked): ?> disabled <?php endif;?>>
                                            <label for="rodzaj-tekst">Stworzenie nowego tekstu</label>
                                        </div>
                                        <div>
                                            <input type="radio" name="rodzaj" value="korekta" active-form="korekta" id="rodzaj-korekta" required="required" style="float: left; margin-top: 4px;"<?php if($Locked): ?> disabled <?php endif;?>>
                                            <label for="rodzaj-korekta">Korektę tekstu</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-end">
                                <div class="col-12 col-md">
                                    <div class="form-group text required">
                                        <label for="tytul">Tytuł:</label>
                                        <input type="text" class="form-control" value="<?=$tytulGetOffer;?>" name="tytul" required="required" maxlength="150" id="tytul" <?php if($Locked): ?> disabled <?php endif;?> />
                                    </div> 
                                </div>
                                <div class="col-12 col-md-auto form-mb-10 " form-active-for="korekta">
                                    <div class="form-group radio">
                                        <input type="hidden" class="form-control " name="korekta_typ" value="" />
                                        <div>
                                            <input type="radio" name="podtyp" value="redakcja" id="korekta-typ-redakcja" <?php if($podtypGetOffer == "redakcja"){echo "checked='checked'";} ?> style="float: left; margin-top: 4px;" <?php if($Locked): ?> disabled <?php endif;?>>
                                            <label for="korekta-typ-redakcja">Redakcja</label>
                                        </div>
                                        <div>
                                            <input type="radio" name="podtyp" value="korekta" id="korekta-typ-korekta" <?php if($podtypGetOffer == "korekta"){echo "checked='checked'";} ?> style="float: left; margin-top: 4px;"<?php if($Locked): ?> disabled <?php endif;?>>
                                            <label for="korekta-typ-korekta">Korekta</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg " form-active-for="korekta">
                            <div class="korekta-typ-info">
                                <p><b>Redakcja - </b>wszechstronne opracowanie tekstu zarówno pod względem językowym, logicznym, strukturalnym, jak i typograficznym.
                                    <br>
                                </p>
                                <p><b>Korekta -</b> poprawienie wszelkich błędów ortograficznych, interpunkcyjnych, fleksyjnych, uchybień składniowych i wychwyceniu literówek.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-8 col-xxl-7">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="form-group select required">
                                        <label for="kategoria-id">Wybierz kategorię:</label>
                                        <?php if(!$Locked):?>
                                        <select class="form-control " name="kategoria" required="required" id="kategoria-id">
																						<option value="<?=$kategoriaGetOffer;?>"><?=$kategoriaGetOffer;?></option>
                                            <option value="" disabled>---------------</option>
                                            <option value="Biznes i prawo">Biznes i prawo</option>
                                            <option value="Budownictwo">Budownictwo i nieruchomości</option>
                                            <option value="E-commerce">E-commerce</option>
                                            <option value="Edukacja">Edukacja</option>
                                            <option value="Erotyka">Erotyka</option>
                                            <option value="Informacje i publicystyka">Informacje i publicystyka</option>
                                            <option value="Kultura i rozrywka">Kultura i rozrywka</option>
                                            <option value="Motoryzacja">Motoryzacja</option>
                                            <option value="Moda">Moda</option>
                                            <option value="Nowe technologie">Nowe technologie</option>
                                            <option value="Sport">Sport</option>
                                            <option value="Styl życia">Styl życia</option>
                                            <option value="Turystyka i gastronomia">Turystyka i gastronomia</option>
                                            <option value="Zdrowie i medycyna">Zdrowie i medycyna</option>
                                            <option value="Inne">Inne</option>
                                        </select><span class="nice-select"><i class="fa fa-angle-down"></i></span>
                                        <?php else:?>
                                        	 <input type="text" class="form-control" value="<?=$kategoriaGetOffer;?>" name="Kategoria:"  maxlength="150" id="kategoria"  disabled  />
                                        	<?php endif; ?>
                                        <span class="nice-unselect"><i class="fa fa-times"></i></span></div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="form-group select required">
                                        <label for="typ-id">Typ tekstu:</label>
                                     <?php if(!$Locked):?>
                                        <select class="form-control " name="typ_tekstu" required="required" id="typ-id"  >
																						<option value="<?=$typ_tekstuGetOffer;?>"><?=$typ_tekstuGetOffer;?></option>
                                            <option value="" disabled>-----------</option>
                                            <option value="Opis">Opis</option>
                                            <option value="Tekst preclowy">Tekst preclowy</option>
                                            <option value="Tekst synonimiczny">Tekst synonimiczny</option>
                                            <option value="Tekst zapleczowy">Tekst zapleczowy</option>
                                            <option value="Recenzja">Recenzja </option>
                                            <option value="Tekst marketingowy">Tekst marketingowy</option>
                                            <option value="Artykuły specjalistyczne i naukowe">Artykuły specjalistyczne i naukowe</option>
                                            <option value="Prace naukowe">Prace naukowe</option>
                                            <option value="Korekta">Korekta</option>
                                            <option value="Inne">Inne</option>
                                       
                                        </select><span class="nice-select"><i class="fa fa-angle-down"></i></span>
                                        <?php else:?>
                                        	 <input type="text" class="form-control" value="<?=$typGetOffer;?>" name="Typ tekstu"  maxlength="150" id="typ"  disabled  />
                                        	<?php endif; ?>
                                        <span class="nice-unselect"><i class="fa fa-times"></i></span></div>
                                </div>
                            </div>
                            <div class="row align-items-end form-zlecenie-prices m-t-50">
                                <div class="col-12 col-md-6 col-lg-4 " form-active-for="korekta">
                                    <div class="form-group number required">
                                        <label for="dlugosc-od">Długość tekstu korekty:</label>
                                        <input type="number" class="form-control count-znaki" value="<?=$dlugosc_odGetOffer;?>" name="dlugosc_od" max-price="#zlecenie-wartosc-max" disabled="disabled" required="required" id="dlugosc-od" <?php if($Locked): ?> disabled <?php endif;?>/><span class="after-text">/ Znaków</span></div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4 active" form-active-for="tekst">
                                    <div class="form-group number required">
                                        <label for="dlugosc-od">Długość tekstu:</label><span class="bef-text">od</span>
                                        <input type="number" class="form-control " value="<?=$dlugosc_odGetOffer;?>" name="dlugosc_od" required="required" id="dlugosc-od" <?php if($Locked): ?> disabled <?php endif;?>/><span class="after-text">/ Znaków</span></div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4 active" form-active-for="tekst">
                                    <div class="form-group number required"><span class="bef-text">do</span>
                                        <input type="number" class="form-control count-znaki" name="dlugosc_do" value="<?php if($typGetOffer == "nowy"){echo $dlugosc_doGetOffer;} ?>" max-price="#zlecenie-wartosc-max" required="required" id="dlugosc-do"<?php if($Locked): ?> disabled <?php endif;?> /><span class="after-text">/ Znaków</span></div>
                                </div>
                                <div class="col-12 form-mb-minus-5 col-md-6 col-lg-4">
                                    <div class="form-group text required">
                                        <label for="cena">Cena (brutto) za 1000 znaków:</label>
                                        <input type="number" class="form-control " name="cena" autocomplete="off" data-type="float" max-price="#zlecenie-wartosc-max" required="required" min="4" value="<?=$cenaGetOffer;?>" id="cena"  <?php if($Locked): ?> disabled <?php endif;?>/><span class="after-text">/ &#122;&#322;</span>
                                        <div class="fc-v"><span id="zlecenie-wartosc-max"><?php if($typGetOffer == "nowy"){echo number_format((($cenaGetOffer/1000)*$dlugosc_doGetOffer),2);}else{echo number_format((($cenaGetOffer/1000)*$dlugosc_odGetOffer),2);} ?> &#122;&#322;</span> za całość</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-10 active" form-active-for="tekst">
                                <div class="col-12">
                                    <div><i class="fa fa-info info-ico"></i> 1800 znaków to około 1 strona maszynopisu</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xxl-5 align-self-end m-b-15">
                            <div class="zlecenie-cena-info">
                                <p>Minimalna cena za 1000 znaków wynosi <b style="color:#cd2d69;">4 zł brutto.</b></p>
                                <p><b><span style="font-size: 18px;">Pamiętaj!</span></b></p>
                                <p>Stawka, którą definiujesz wpływa na szybkość wykonania zlecenia oraz jakość tekstu.</p>
                                <p><b>Przykładowe ceny rynkowe:</b></p>
                                <ul>
                                    <li><span>tekst słabej jakości: 12 zł / 1000 znaków</span></li>
                                    <li><span>tekst średniej jakości: 20 zł / 1000 znaków</span></li>
                                    <li><span>tekst dobrej jakości: 35 </span><span>zł / 1000 znaków</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-30 active" form-active-for="tekst">
                        <div class="col-12">
                            <div class="form-group textarea">
                                <label for="tagi">Podaj słowa kluczowe dla tekstu:</label>
                                <textarea class="form-control " name="tagi" id="tagi" rows="5" <?php if($Locked): ?> disabled <?php endif;?>><?=$slowa_kluczoweGetOffer;?> </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-12">
                            <div class="form-group textarea required">
                                <label for="opis">Opis zlecenia:</label>
                                <textarea class="form-control " name="opis" required="required" id="opis" rows="5"
                                 <?php if($Locked): ?> disabled <?php endif;?>><?=$opisGetOffer;?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-50 " form-active-for="korekta">
                        <div class="col-12">
                            <div class="form-group textarea required">
                                <label for="tekst-probny">Tutaj wklej tekst do korekty próbnej (1500 - 2200 znaków).</label>
                                <textarea class="form-control " name="tekst_probny" required="required" disabled="disabled" min="0" max="2200" maxlength="2200" counter="#tekst-probny-length-counter" count-spaces="true" maxlengthcounter="true" id="tekst-probny" rows="5"><?=$tekst_korekta_probnaGetOffer;?></textarea>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group checkbox">
                                            <input type="hidden" class="form-control " name="bez_proby" value="0" />
                                            <div>
                                                <input type="checkbox" name="bez_proby" value="1" id="bez-proby" <?php if($Locked): ?> disabled <?php endif;?>>
                                                <label for="bez-proby">Zrezygnuj z korekty próbnej.</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 text-right"><span id="tekst-probny-length-counter">0/2200</span> znaków</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row " form-active-for="korekta">
                        <div class="col-12 col-xxl-9">
                            <div class="korekta-plik-container">
                                <div class="row align-items-center">
                                    <div class="col-12 col-lg-9 col-xxl-10 text-center">
                                        <label for="plik" id="file-korekta-preview">Wgraj plik do korekty właściwej<span class="help-info" data-toggle="popover-info" data-placement="auto" data-container="body" data-content="&lt;p&gt;Maksymalny rozmiar pliku to 15 MB&lt;/p&gt;" data-html="true" data-trigger="hover | click"><i class="fa fa-info"></i></span></label>
                                    </div>
                                    <div class="col-12 col-lg-3 col-xxl-2 form-mb-0">
                                        <div class="form-group file required">
                                            <div class="file-add">
                                                <input type="file" name="plik" disabled="disabled" file-type="other" accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-word.document.macroEnabled.12" preview-target="#file-korekta-preview" id="plik">
                                                <button type="button" class="btn btn-sm btn-info btn-block like-dark">Wybierz...</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
														<?php if(!empty($korekta_plikGetOffer)){echo "<div style='height: 15px;'></div><a href='download/$korekta_plikGetOffer' target='_blank' class='btn btn-info'><i class='fa fa-download'></i> Pobierz aktualny plik korekty właściwej</a><div style='height: 15px;'></div>";} ?>
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-12">
                            <div class="form-group radio">
                                <input type="hidden" class="form-control " name="target_typ" value="" />
                                <div>
                                    <input type="radio" name="target_typ" value="all" id="target-typ-all" <?php if(empty($dla_ulubionychGetOffer)){echo "checked";} ?> onClick="document.getElementById('dla_ulubionych').style.display='none';" style="float: left; margin-top: 4px;"<?php if($Locked): ?> disabled <?php endif;?>>
                                    <label for="target-typ-all">Chcę umieścić ogłoszenie widoczne dla wszystkich wykonawców</label>
                                </div>
																<div>
                                    <input type="radio" name="target_typ" id="target-typ-fav" value="favourites" <?php if(!empty($dla_ulubionychGetOffer)){echo "checked";} ?> onClick="document.getElementById('dla_ulubionych').style.display='block';" style="float: left; margin-top: 4px;"<?php if($Locked): ?> disabled <?php endif;?>>
                                    <label for="target-typ-fav">Chcę umieścić ogłoszenie dostępne dla wybranych twórców z mojej listy ulubionych</label>
                                </div>
																<div id="dla_ulubionych" style="display: <?php if(!empty($dla_ulubionychGetOffer)){echo "block";} else {echo "none";} ?>; margin-top: 10px;">
																	<?php
																	$qFavs = mysqli_query($connect,"SELECT * FROM `favourites` WHERE `user_id` = ".$_SESSION['user_id']);
																	$nFavs = mysqli_num_rows($qFavs);
																	if($nFavs > 0){
																		echo "<div class='row' style='width: 100%;'>";
																			while($sFavs = mysqli_fetch_array($qFavs)){
																				$lubianyFavs = $sFavs['lubiany'];
																				$qFavs2 = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $lubianyFavs");
																				$sFavs2 = mysqli_fetch_array($qFavs2);
																				$imgFavs2 = $sFavs2['img'];
																				if(empty($imgFavs2)){$imgFavs2 = "no_photo.png";}
																				$nickFavs2 = $sFavs['nick'];
																				if(empty($nickFavs2)){$nickFavs2 = $sFavs2['imie']." ".mb_substr($sFavs2['nazwisko'],0,1).".";}
																				//---
																				$qCheckLubianyOffer = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $id AND `dla_ulubionych` LIKE '%,$lubianyFavs%'");
																				$nCheckLubianyOffer = mysqli_num_rows($qCheckLubianyOffer);
																				//---
																				echo "
																				<div class='col-md-2'>
																					<img src='images/users/$imgFavs2' style='max-width: 90px; margin-right: 3px;'>
																					<input type='checkbox' name='dla_ulubionych$lubianyFavs' value='1' style='position: relative; top: 3px;' "; if($nCheckLubianyOffer > 0){echo "checked";} echo "<?php if($Locked): ?> disabled <?php endif;?>> <B>$nickFavs2</B>
																				</div>
																				";
																			}
																		echo "</div>";
																	} else {error("Nie masz żadnych twórców na swojej liście ulubionych!");}
																	?>
																</div>
                            </div>
                        </div>
                    </div>
                    <div class="active" form-active-for-2="all">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group checkbox">
                                    <input type="hidden" class="form-control " name="ogranicz" value="0" />
                                    <div>
                                        <input type="checkbox" name="ogranicz" value="1" active-form-3="ograniczenia" id="ogranicz"<?php if($Locked): ?> disabled <?php endif;?>>
                                        <label for="ogranicz">Ogranicz listę wykonawców.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" form-active-for-3="ograniczenia">
                            <div class="col-12 col-md-4">
                                <div class="form-group select">
                                    <label for="ogranicz-proc">Skuteczność zaakceptowanych tekstów:</label>
                                    <select class="form-control " name="wykonawca_skutecznosc" id="ogranicz-proc">
																				<option value="<?=$wykonawca_skutecznoscGetOffer;?>"><?=$wykonawca_skutecznoscGetOffer;?></option>
                                        <option value="" disabled>--------------</option>
                                        <option value="10">Powyżej 10%</option>
                                        <option value="20">Powyżej 20%</option>
                                        <option value="30">Powyżej 30%</option>
                                        <option value="40">Powyżej 40%</option>
                                        <option value="50">Powyżej 50%</option>
                                        <option value="60">Powyżej 60%</option>
                                        <option value="70">Powyżej 70%</option>
                                        <option value="80">Powyżej 80%</option>
                                        <option value="90">Powyżej 90%</option>
                                        <option value="100">100%</option>
                                    </select><span class="nice-select"><i class="fa fa-angle-down"></i></span><span class="nice-unselect"><i class="fa fa-times"></i></span></div>
                                <div class="form-group select">
                                    <label for="ogranicz-ilosc">Doświadczenie powyżej:</label>
                                    <select class="form-control " name="wykonawca_doswiadczenie" id="ogranicz-ilosc">
																				<option value="<?=$wykonawca_doswiadczenieGetOffer;?>"><?=$wykonawca_doswiadczenieGetOffer;?></option>
                                        <option value="" disabled>--------------</option>
                                        <option value="20">20 napisanych tekstów</option>
                                        <option value="50">50 napisanych tekstów</option>
                                        <option value="100">100 napisanych tekstów</option>
                                        <option value="200">200 napisanych tekstów</option>
                                        <option value="500">500 napisanych tekstów</option>
                                        <option value="1000">1000 napisanych tekstów</option>
                                    </select><span class="nice-select"><i class="fa fa-angle-down"></i></span><span class="nice-unselect"><i class="fa fa-times"></i></span></div>
                            </div>
                            <div class="col-12 col-md-8 list-col-3">
                                <div class="form-group select">
                                    <label for="ogranicz-kategoria">Specjalizacja w kategoriach:</label>
                                    <input type="hidden" class="form-control " name="ogranicz_kategoria" value="" />
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Biznes i prawo" id="ogranicz-kategoria-1" <?php if(zlecenieCheckKategoria($id,"Biznes i prawo") == "1"){echo "checked";} ?>>
                                            <label for="ogranicz-kategoria-1">Biznes i prawo</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Budownictwo i nieruchomości" id="ogranicz-kategoria-2" <?php if(zlecenieCheckKategoria($id,"Budownictwo i nieruchomości") == "1"){echo "checked";} ?>>
                                            <label for="ogranicz-kategoria-2">Budownictwo i nieruchomości</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="E-commerce" id="ogranicz-kategoria-3" <?php if(zlecenieCheckKategoria($id,"E-commerce") == "1"){echo "checked";} ?>>
                                            <label for="ogranicz-kategoria-3">E-commerce</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Edukacja" id="ogranicz-kategoria-4" <?php if(zlecenieCheckKategoria($id,"Edukacja") == "1"){echo "checked";} ?>>
                                            <label for="ogranicz-kategoria-4">Edukacja</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Erotyka" id="ogranicz-kategoria-5" <?php if(zlecenieCheckKategoria($id,"Erotyka") == "1"){echo "checked";} ?>>
                                            <label for="ogranicz-kategoria-5">Erotyka</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Informacje i publicystyka" id="ogranicz-kategoria-6" <?php if(zlecenieCheckKategoria($id,"Informacje i publicystyka") == "1"){echo "checked";} ?>>
                                            <label for="ogranicz-kategoria-6">Informacje i publicystyka</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Kultura i rozrywka" id="ogranicz-kategoria-7" <?php if(zlecenieCheckKategoria($id,"Kultura i rozrywka") == "1"){echo "checked";} ?>>
                                            <label for="ogranicz-kategoria-7">Kultura i rozrywka</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Motoryzacja" id="ogranicz-kategoria-8" <?php if(zlecenieCheckKategoria($id,"Motoryzacja") == "1"){echo "checked";} ?>>
                                            <label for="ogranicz-kategoria-8">Motoryzacja</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Moda" id="ogranicz-kategoria-9" <?php if(zlecenieCheckKategoria($id,"Moda") == "1"){echo "checked";} ?>>
                                            <label for="ogranicz-kategoria-9">Moda</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Nowe technologie" id="ogranicz-kategoria-10" <?php if(zlecenieCheckKategoria($id,"Nowe technologie") == "1"){echo "checked";} ?>>
                                            <label for="ogranicz-kategoria-10">Nowe technologie</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Sport" id="ogranicz-kategoria-11" <?php if(zlecenieCheckKategoria($id,"Sport") == "1"){echo "checked";} ?>>
                                            <label for="ogranicz-kategoria-11">Sport</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Styl życia" id="ogranicz-kategoria-12" <?php if(zlecenieCheckKategoria($id,"Styl życia") == "1"){echo "checked";} ?>>
                                            <label for="ogranicz-kategoria-12">Styl życia</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Turystyka i gastronomia" id="ogranicz-kategoria-13" <?php if(zlecenieCheckKategoria($id,"Turystyka i gastronomia") == "1"){echo "checked";} ?>>
                                            <label for="ogranicz-kategoria-13">Turystyka i gastronomia</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Zdrowie i medycyna" id="ogranicz-kategoria-14" <?php if(zlecenieCheckKategoria($id,"Zdrowie i medycyna") == "1"){echo "checked";} ?>>
                                            <label for="ogranicz-kategoria-14">Zdrowie i medycyna</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Inne" id="ogranicz-kategoria-15" <?php if(zlecenieCheckKategoria($id,"Inne") == "1"){echo "checked";} ?>>
                                            <label for="ogranicz-kategoria-15">Inne</label>
                                        </div>
                                    </div><span class="nice-select"><i class="fa fa-angle-down"></i></span><span class="nice-unselect"><i class="fa fa-times"></i></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-20">
                    	<?php if(!$Locked) : ?>
												<div class="col-6 text-left">
													<a href="javascript:;" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Anuluj zlecenie</a>
												</div>
                        <div class="col-6 text-right">
                            <button type="submit" class="btn btn-primary">Zapisz</button>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
												<!--===============================-->
																	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																		<div class="modal-dialog" role="document">
																			<div class="modal-content">
																				<form action="cancelOrder" method="post">
																				<div class="modal-header">
																					<h5 class="modal-title" id="exampleModalLabel">Anulowanie zlecenia</h5>
																					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																						<span aria-hidden="true">&times;</span>
																					</button>
																				</div>
																				<div class="modal-body">
																					<CENTER><h4 class="modal-title" id="exampleModalLabel" style="font-weight: bold;">Czy na pewno chcesz<BR>anulować to zlecenie?</h4></CENTER>
																					<div style="height: 10px;"></div>
																					<?php
																					$qCheckRealizacje = mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `zlecenie_id` = $id AND `canceled` != '1'");
																					$nCheckRealizacje = mysqli_num_rows($qCheckRealizacje);
																					if($nCheckRealizacje > 0 AND $typ == 'nowy'){
																						echo '<CENTER>Jeden z wykonawców podjął się już wykonania tego zlecenia. Aby wynagrodzić jego dotychczasową pracę, otrzyma on wynagrodzenie za minimalną liczbę znaków.</CENTER>';
																					}
																					?>
																				</div>
																				<div class="modal-footer">
																					<input type="hidden" name="id" value="<?=$id;?>">
																					<button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
																					<button type="submit" class="btn btn-primary">Anuluj zlecenie</button>
																				</div>
																				</form>
																			</div>
																		</div>
																	</div>
												<!--===============================-->
				<?php } ?>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>