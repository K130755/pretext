<?php include("inc/head.php"); ?>
<?php if(!isset($_SESSION['user_id']) AND empty($_SESSION['user_id'])){header("Location: login");exit;} ?>
<?php
$qLegenda = mysqli_query($connect,"SELECT * FROM `tworzenie_legenda` ORDER BY `id` DESC LIMIT 1");
$sLegenda = mysqli_fetch_array($qLegenda);
	$legendaLegenda = $sLegenda['legenda'];
	$informacjeLegenda = $sLegenda['informacje'];
?>
<?php if($moj_typ != "zleceniodawca"){header("Location: notForMe");} ?>
<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>" onLoad="<?php if($_GET['korekta'] == "1"){echo "checkType();";} ?>parseCalc();">
<script type="text/javascript">
function checkType(){
	document.getElementById('rodzaj-korekta').click();
}
function parseCalc(){
	<?php
	$rodzajCalc = trim(addslashes(strip_tags($_GET['rodzaj'])));
	$typ_tekstuCalc = trim(addslashes(strip_tags($_GET['typ_tekstu'])));
	$kategoriaCalc = trim(addslashes(strip_tags($_GET['kategoria'])));
	$ilosc_znakowCalc = trim(addslashes(strip_tags($_GET['ilosc_znakow'])));
	$cenaCalc = trim(addslashes(strip_tags($_GET['cena'])));
	if(!empty($rodzajCalc)){
		?>
		var rodzajCalc = '<?=$rodzajCalc;?>';
		var typ_tekstuCalc = '<?=$typ_tekstuCalc;?>';
		var kategoriaCalc = '<?=$kategoriaCalc;?>';
		var ilosc_znakowCalc = '<?=$ilosc_znakowCalc;?>';
		var cenaCalc = '<?=$cenaCalc;?>';
		
		if(rodzajCalc == 'nowy'){
			document.getElementById('rodzaj-tekst').click();
		} else {
			document.getElementById('rodzaj-korekta').click();
		}
		/*=====================*/
		var x = document.getElementById("typ-id");
		var option = document.createElement("option");
		option.text = typ_tekstuCalc;
		x.add(option,x[0]);
		x.value=option.text;
		/*=====================*/
		var x2 = document.getElementById("kategoria-id");
		var option2 = document.createElement("option");
		option2.text = kategoriaCalc;
		x2.add(option2,x2[0]);
		x2.value=option2.text;
		/*=====================*/
		document.getElementById('dlugosc-od').value=ilosc_znakowCalc;
		document.getElementById('dlugosc-od2').value=ilosc_znakowCalc;
		document.getElementById('cena').value=cenaCalc;
		<?php
	}
	?>
}
</script>
    <?php include("inc/dashboardTop.php"); ?>
    <div class="container">
        <?php
				if(!empty($_SESSION['wykonawca']) AND $_SESSION['wykonawca'] != "0"){
					$qWykonawcaDedicated = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = ".$_SESSION['wykonawca']);
					$sWykonawcaDedicated = mysqli_fetch_array($qWykonawcaDedicated);
						$imgWykonawcaDedicated = $sWykonawcaDedicated['img'];
							if(empty($imgWykonawcaDedicated)){$imgWykonawcaDedicated = "no_photo.png";}
						$imieWykonawcaDedicated = $sWykonawcaDedicated['imie']." ".$sWykonawcaDedicated['nazwisko'];
						$idWykonawcaDedicated = $_SESSION['wykonawca'];
				?>
				<div style="text-align: right; padding: 10px;">
					<h4>Wykonawca</h4>
					<img src="images/users/<?=$imgWykonawcaDedicated;?>" style="float: right; max-width: 80px; max-height: 80px; margin-left: 10px;">
					<B><?=$imieWykonawcaDedicated;?></B><div style="height: 5px;"></div>
					<a class='btn btn-danger' href='orderTextCancel'>Odwołaj wykonawcę</a>
					<div style="clear: both;"></div>
				</div>
				<?php } else {$idWykonawcaDedicated = "0";} ?>
				<div class="row">
            <div class="col-12">
                <div class="special-head">Dodaj nowe zlecenie</div>
            </div>
        </div>
				<?php
				if($moj_wallet == 0){
					errorFIXED("Doładuj swój portfel, aby móc wystawić zlecenie!");
					echo "<div style='height: 10px;'></div>";
				}
				?>
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
						// WALLET STUFF ==================
						//================================
						if($moj_wallet > 0){
							
							if($dlugosc_od == $dlugosc_do OR empty($dlugosc_do) OR $dlugosc_do == "0"){
								$dlugoscProwizja = $dlugosc_od;
							} else {
								$dlugoscProwizja = $dlugosc_do;
							}
							$iloscProwizja = $dlugoscProwizja / 1000;
							
							
							$prowizja = number_format((($cena*$iloscProwizja)*PROWIZJA)/100,2);
							$totalProwizja = ($cena*$iloscProwizja)+$prowizja;
							if($moj_wallet >= $totalProwizja){
								//echo $totalProwizja;
								
								$newWallet = $moj_wallet - $totalProwizja;
								mysqli_query($connect,"UPDATE `users` SET `wallet` = '$newWallet' WHERE `id` = ".$_SESSION['user_id']);
								
								$wallet_error = 0;
							} else {$wallet_error = 1;}
						} else {$wallet_error = 1;}
						//================================
						if($wallet_error == 0){
						$plik_tmp = $_FILES['plik']['tmp_name'];
						$plik_nazwa = $_FILES['plik']['name'];
						$ext = pathinfo($_FILES['plik']['name'], PATHINFO_EXTENSION);
						$plik_nazwa = sha1(md5(time().rand(9999999,999999999999).$moj_email)).".".$ext;

						if(is_uploaded_file($plik_tmp)) {
							if($ext != "php" AND $ext != "PHP" AND $ext != "js" AND $ext != "JS"){
								move_uploaded_file($plik_tmp, "download/$plik_nazwa");
							} else {$plik_nazwa = "";}
						} else {$plik_nazwa = "";}
						//================================
						mysqli_query($connect,"INSERT INTO `zlecenia` (`user_id`, `wykonawca_id`, `typ`, `podtyp`, `tytul`, `kategoria`, `typ_tekstu`, `dlugosc_od`, `dlugosc_do`, `cena`, `slowa_kluczowe`, `opis`, `wykonawca_skutecznosc`, `wykonawca_doswiadczenie`, `wykonawca_specjalizacje`, `tekst_korekta_probna`, `korekta_plik`,`closed`,`dla_ulubionych`,`newsletter_sent`) VALUES ('".$_SESSION['user_id']."', '$idWykonawcaDedicated', '$typ', '$podtyp', '$tytul', '$kategoria', '$typ_tekstu', '$dlugosc_od', '$dlugosc_do', '$cena', '$slowa_kluczowe', '$opis', '$wykonawca_skutecznosc', '$wykonawca_doswiadczenie', '$wykonawca_specjalizacje', '$tekst_probny', '$plik_nazwa','0','$dla_ulubionych','0')");
						header("Location: mojeZlecenia?correct=Twoje zlecenie zostało dodane!");
						} else {errorFIXED("Brak wystarczających środków w portfelu!");}
					}
				}
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
                                            <input type="radio" name="rodzaj" value="nowy" active-form="tekst" id="rodzaj-tekst" checked="checked" required="required" style="float: left; margin-top: 4px;">
                                            <label for="rodzaj-tekst">Stworzenie nowego tekstu</label>
                                        </div>
                                        <div>
                                            <input type="radio" name="rodzaj" value="korekta" active-form="korekta" id="rodzaj-korekta" required="required" style="float: left; margin-top: 4px;">
                                            <label for="rodzaj-korekta">Korektę tekstu</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-end">
                                <div class="col-12 col-md">
                                    <div class="form-group text required">
                                        <label for="tytul">Tytuł:</label>
                                        <input type="text" class="form-control " name="tytul" required="required" maxlength="150" id="tytul" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto form-mb-10 " form-active-for="korekta">
                                    <div class="form-group radio">
                                        <input type="hidden" class="form-control " name="korekta_typ" value="" />
                                        <div>
                                            <input type="radio" name="podtyp" value="redakcja" id="korekta-typ-redakcja" style="float: left; margin-top: 4px;">
                                            <label for="korekta-typ-redakcja">Redakcja</label>
                                        </div>
                                        <div>
                                            <input type="radio" name="podtyp" value="korekta" id="korekta-typ-korekta" checked="checked" style="float: left; margin-top: 4px;">
                                            <label for="korekta-typ-korekta">Korekta</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg " form-active-for="korekta">
                            <div class="korekta-typ-info">
                                <?=$legendaLegenda;?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-8 col-xxl-7">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="form-group select required">
                                        <label for="kategoria-id">Wybierz kategorię:</label>
                                        <select class="form-control " name="kategoria" required="required" id="kategoria-id">
                                            <option value="">Wybierz</option>
                                            <option value="Biznes i prawo">Biznes i prawo</option>
                                            <option value="Budownictwo i nieruchomości">Budownictwo i nieruchomości</option>
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
                                        </select><span class="nice-select"><i class="fa fa-angle-down"></i></span><span class="nice-unselect"><i class="fa fa-times"></i></span></div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="form-group select required">
                                        <label for="typ-id">Typ tekstu:</label>
                                        <select class="form-control " name="typ_tekstu" required="required" id="typ-id">
                                            <option value="">Wybierz z listy</option>
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
                                        </select><span class="nice-select"><i class="fa fa-angle-down"></i></span><span class="nice-unselect"><i class="fa fa-times"></i></span></div>
                                </div>
                            </div>
                            <div class="row align-items-end form-zlecenie-prices m-t-50">
                                <div class="col-12 col-md-6 col-lg-4 " form-active-for="korekta">
                                    <div class="form-group number required">
                                        <label for="dlugosc-od">Długość tekstu korekty:</label>
                                        <input type="number" class="form-control count-znaki" name="dlugosc_od" max-price="#zlecenie-wartosc-max" disabled="disabled" required="required" id="dlugosc-od2" /><span class="after-text">/ Znaków</span></div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4 active" form-active-for="tekst">
                                    <div class="form-group number required">
                                        <label for="dlugosc-od">Długość tekstu:</label><span class="bef-text">od</span>
                                        <input type="number" class="form-control " name="dlugosc_od" required="required" id="dlugosc-od" /><span class="after-text">/ Znaków</span></div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4 active" form-active-for="tekst">
                                    <div class="form-group number required"><span class="bef-text">do</span>
                                        <input type="number" class="form-control count-znaki" name="dlugosc_do" max-price="#zlecenie-wartosc-max" required="required" id="dlugosc-do" /><span class="after-text">/ Znaków</span></div>
                                </div>
                                <div class="col-12 form-mb-minus-5 col-md-6 col-lg-4">
                                    <div class="form-group text required">
                                        <label for="cena">Cena (brutto) za 1000 znaków:</label>
                                        <input type="number" class="form-control " name="cena" autocomplete="off" data-type="float" max-price="#zlecenie-wartosc-max" required="required" min="4" value="4" id="cena" /><span class="after-text">/ &#122;&#322;</span>
                                        <div class="fc-v"><span id="zlecenie-wartosc-max">0,00 &#122;&#322;</span> za całość</div>
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
                                <?=$informacjeLegenda;?>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-30 active" form-active-for="tekst">
                        <div class="col-12">
                            <div class="form-group textarea">
                                <label for="tagi">Podaj słowa kluczowe dla tekstu:</label>
                                <textarea class="form-control " name="tagi" id="tagi" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-12">
                            <div class="form-group textarea required">
                                <label for="opis">Opis zlecenia:</label>
                                <textarea class="form-control " name="opis" required="required" id="opis" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-50 " form-active-for="korekta">
                        <div class="col-12">
                            <div class="form-group textarea required">
                                <label for="tekst-probny">Tutaj wklej tekst do korekty próbnej (1500 - 2200 znaków).</label>
                                <textarea class="form-control " name="tekst_probny" required="required" disabled="disabled" min="0" max="2200" maxlength="2200" counter="#tekst-probny-length-counter" count-spaces="true" maxlengthcounter="true" id="tekst-probny" rows="5"></textarea>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group checkbox">
                                            <input type="hidden" class="form-control " name="bez_proby" value="0" />
                                            <div>
                                                <input type="checkbox" name="bez_proby" value="1" id="bez-proby">
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
                                                <input type="file" name="plik" required="required" disabled="disabled" file-type="other" accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-word.document.macroEnabled.12" preview-target="#file-korekta-preview" id="plik">
                                                <button type="button" class="btn btn-sm btn-info btn-block like-dark">Wybierz...</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-12">
                            <div class="form-group radio">
                                <input type="hidden" class="form-control " name="target_typ" value="" />
                                <div>
                                    <input type="radio" name="target_typ" value="all" id="target-typ-all" checked="checked" onClick="document.getElementById('dla_ulubionych').style.display='none';" style="float: left; margin-top: 4px;">
                                    <label for="target-typ-all">Chcę umieścić ogłoszenie widoczne dla wszystkich wykonawców</label>
                                </div>
																<div>
                                    <input type="radio" name="target_typ" id="target-typ-fav" value="favourites" onClick="document.getElementById('dla_ulubionych').style.display='block';" style="float: left; margin-top: 4px;">
                                    <label for="target-typ-fav">Chcę umieścić ogłoszenie dostępne dla wybranych twórców z mojej listy ulubionych</label>
                                </div>
																<div id="dla_ulubionych" style="display: none; margin-top: 10px;">
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
																				$show_nameFavs2 = $sFavs2['show_name'];
																				if(empty($imgFavs2)){$imgFavs2 = "no_photo.png";}
																				if($show_nameFavs2 != "1"){
																				$nickFavs2 = $sFavs['nick'];
																				if(empty($nickFavs2)){$nickFavs2 = $sFavs2['imie']." ".mb_substr($sFavs2['nazwisko'],0,1).".";}
																				} else {$nickFavs2 = $sFavs2['imie']." ".$sFavs2['nazwisko'];}
																				echo "
																				<div class='col-md-3'>
																					<img src='images/users/$imgFavs2' style='max-width: 90px; margin-right: 3px;'>
																					<input type='checkbox' name='dla_ulubionych$lubianyFavs' value='1' style='position: relative; top: 3px;'> <B>$nickFavs2</B>
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
                                        <input type="checkbox" name="ogranicz" value="1" active-form-3="ograniczenia" id="ogranicz">
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
                                        <option value=""></option>
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
                                        <option value=""></option>
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
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Biznes i prawo" id="ogranicz-kategoria-1">
                                            <label for="ogranicz-kategoria-1">Biznes i prawo</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Budownictwo i nieruchomości" id="ogranicz-kategoria-2">
                                            <label for="ogranicz-kategoria-2">Budownictwo i nieruchomości</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="E-commerce" id="ogranicz-kategoria-3">
                                            <label for="ogranicz-kategoria-3">E-commerce</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Edukacja" id="ogranicz-kategoria-4">
                                            <label for="ogranicz-kategoria-4">Edukacja</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Erotyka" id="ogranicz-kategoria-5">
                                            <label for="ogranicz-kategoria-5">Erotyka</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Informacje i publicystyka" id="ogranicz-kategoria-6">
                                            <label for="ogranicz-kategoria-6">Informacje i publicystyka</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Kultura i rozrywka" id="ogranicz-kategoria-7">
                                            <label for="ogranicz-kategoria-7">Kultura i rozrywka</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Motoryzacja" id="ogranicz-kategoria-8">
                                            <label for="ogranicz-kategoria-8">Motoryzacja</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Moda" id="ogranicz-kategoria-9">
                                            <label for="ogranicz-kategoria-9">Moda</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Nowe technologie" id="ogranicz-kategoria-10">
                                            <label for="ogranicz-kategoria-10">Nowe technologie</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Sport" id="ogranicz-kategoria-11">
                                            <label for="ogranicz-kategoria-11">Sport</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Styl życia" id="ogranicz-kategoria-12">
                                            <label for="ogranicz-kategoria-12">Styl życia</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Turystyka i gastronomia" id="ogranicz-kategoria-13">
                                            <label for="ogranicz-kategoria-13">Turystyka i gastronomia</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Zdrowie i medycyna" id="ogranicz-kategoria-14">
                                            <label for="ogranicz-kategoria-14">Zdrowie i medycyna</label>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <div>
                                            <input type="checkbox" name="ogranicz_kategoria[]" value="Inne" id="ogranicz-kategoria-15">
                                            <label for="ogranicz-kategoria-15">Inne</label>
                                        </div>
                                    </div><span class="nice-select"><i class="fa fa-angle-down"></i></span><span class="nice-unselect"><i class="fa fa-times"></i></span></div>
                            </div>
                        </div>
                    </div>
										
                    <div class="row m-t-20">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-primary">Zapisz</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>