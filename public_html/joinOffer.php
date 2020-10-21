<?php include("inc/head.php"); ?>

<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/top.php"); ?>
		<?php
		showRespond($_GET['error'],$_GET['correct']);
		
		if(empty($_SESSION['user_id'])){header("Location: login");}
		if($moj_typ != "wykonawca"){header("Location: index");exit;}
		//---------------------
		$id = trim(addslashes(strip_tags($_GET['id'])));
		//---------------------
		
		$qPZK = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $id");
		$nPZK = mysqli_num_rows($qPZK);
		if($nPZK > 0){
			$sPZK = mysqli_fetch_array($qPZK);
			$typPZK = $sPZK['typ'];
			$tekst_korekta_probnaPZK = $sPZK['tekst_korekta_probna'];
			$wykonawca_idPZK = $sPZK['wykonawca_id'];
			$closedPZK = $sPZK['closed'];
			
		if($typPZK == "nowy"){
		
			$qCheckKolejka = mysqli_query($connect,"SELECT * FROM `kolejka` WHERE `zlecenie_id` = $id AND `data` != '' ORDER BY `data` ASC LIMIT 1");
			$nCheckKolejka = mysqli_num_rows($qCheckKolejka);
			if($nCheckKolejka == 0){
				mysqli_query($connect,"DELETE FROM `kolejka` WHERE `zlecenie_id` = $id AND `user_id` = ".$_SESSION['user_id']);
				$data_stopCheckKolejka = date("Y-m-d H:i", strtotime('+'.BASE_TIME.' hours'));
				mysqli_query($connect,"INSERT INTO `kolejka` (`zlecenie_id`,`user_id`,`data`,`data_stop`) VALUES ('$id','".$_SESSION['user_id']."','".date("Y-m-d H:i")."','$data_stopCheckKolejka')");
			} else {
				$sCheckKolejka = mysqli_fetch_array($qCheckKolejka);
				$user_idCheckKolejka = $sCheckKolejka['user_id'];
				$data_stopCheckKolejka = $sCheckKolejka['data_stop'];
				if($user_idCheckKolejka != $_SESSION['user_id']){
					header("Location: dashboard?error=Twoja kolej na realizację tego zlecenia jeszcze nie nadeszła!");exit;
				}
			}
			?>
			
			<?php if($closedPZK != "1"){ ?>
			<script>
			// Set the date we're counting down to
			var countDownDate = new Date("<?=$data_stopCheckKolejka;?>").getTime();

			// Update the count down every 1 second
			var x = setInterval(function() {

				// Get today's date and time
				var now = new Date().getTime();

				// Find the distance between now and the count down date
				var distance = countDownDate - now;

				// Time calculations for days, hours, minutes and seconds
				var days = Math.floor(distance / (1000 * 60 * 60 * 24));
				var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
				var seconds = Math.floor((distance % (1000 * 60)) / 1000);

				// Display the result in the element with id="demo"
				document.getElementById("timer").innerHTML = "<i class='fas fa-clock'></i> " + hours + "h "
				+ minutes + "m " + seconds + "s ";

				// If the count down is finished, write some text
				if (distance < 0) {
					clearInterval(x);
					document.getElementById("timer").innerHTML = "Czas minął!";
					<?php if($data_stopCheckKolejka > date("Y-m-d H:i:s")){ ?>
					document.getElementById('finishBttn').click();
					<?php } ?>
				}
			}, 1000);
			</script>
			<?php } ?>
			
		<?php
		} else {
			if(!empty($tekst_korekta_probnaPZK)){
				$qCheckKolejka = mysqli_query($connect,"SELECT * FROM `kolejka` WHERE `zlecenie_id` = $id AND `user_id` = ".$_SESSION['user_id']);
				$nCheckKolejka = mysqli_num_rows($qCheckKolejka);
				if($nCheckKolejka == 0){
					if(mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `kolejka` WHERE `zlecenie_id` = $id")) < 5){
						mysqli_query($connect,"INSERT INTO `kolejka` (`zlecenie_id`,`user_id`,`data`,`data_stop`) VALUES ('$id','".$_SESSION['user_id']."','','')");
					} else {header("Location: zleceniaKorekta?error=Brak wolnych miejsc w kolejce dla tego zlecenia!");exit;}
				}
			} else {
				if(empty($wykonawca_idPZK) OR $wykonawca_idPZK == "0" OR $wykonawca_idPZK == $_SESSION['user_id']){
					mysqli_query($connect,"UPDATE `zlecenia` SET `wykonawca_id` = ".$_SESSION['user_id']." WHERE `id` = $id");
				} else {
					header("Location: zleceniaKorekta?error=To zlecenie zostało już zarezerwowane");
					mysqli_query($connect,"INSERT INTO `kolejka` (`zlecenie_id`,`user_id`,`data`,`data_stop`) VALUES ('$id','".$_SESSION['user_id']."','','')");
					exit;
				}
			}
		}
		}
		//==================================================================
		$q = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $id AND (`wykonawca_id` = '".$_SESSION['user_id']."' OR `wykonawca_id` = '0')");
		$n = mysqli_num_rows($q);
		if($n > 0){
		//==========================================
		// CHECK CANCELED
		$qCheckCanceled = mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `zlecenie_id` = $id AND `canceled` = '1' AND `wykonawca_id` = ".$_SESSION['user_id']);
		$nCheckCanceled = mysqli_num_rows($qCheckCanceled);
		if($nCheckCanceled > 0){
			mysqli_query($connect,"DELETE FROM `kolejka` WHERE `zlecenie_id` = $id AND `user_id` = ".$_SESSION['user_id']);
			header("Location: mojeZlecenia");exit;
		}
		//==========================================
			$s = mysqli_fetch_array($q);
			$wykonawca_id = $s['wykonawca_id'];
			$tytul = $s['tytul'];
			$typ = $s['typ'];
			if($typ == "nowy"){
				if($wykonawca_id == "0"){
					mysqli_query($connect,"UPDATE `zlecenia` SET `wykonawca_id` = '".$_SESSION['user_id']."' WHERE `id` = $id");
				}
			}
			$kategoria = $s['kategoria'];
			$typ_tekstu = $s['typ_tekstu'];
			$dlugosc_od = $s['dlugosc_od'];
			$dlugosc_do = $s['dlugosc_do'];
			if($dlugosc_do == "0" OR $typ == "korekta"){
				$dlugosc_do = $dlugosc_od;
			}
			if($dlugosc_od == $dlugosc_do){
				$dlugosc_tekstu = $dlugosc_od." znaków";
			} else {
				$dlugosc_tekstu = "od $dlugosc_od do $dlugosc_do znaków";
			}
			$cena = $s['cena'];
			$cena_calosc = ($cena/1000)*$dlugosc_do;
			$cena_netto = $cena_calosc / 1.23;
			$slowa_kluczowe = $s['slowa_kluczowe'];
			$opis = $s['opis'];
			$tekst_korekta_probna = $s['tekst_korekta_probna'];
			$korekta_plik = $s['korekta_plik'];
			$user_id = $s['user_id'];
			$closed = $s['closed'];
		} else {header("Location: index");exit;}
		
		if($typ == "nowy"){
		$autosave = 1;
		echo "<div id='backupInfo'></div>";
		//===========================
		$qCheckRealizacja = mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `zlecenie_id` = $id AND `wykonawca_id` = ".$_SESSION['user_id']);
		$nCheckRealizacja = mysqli_num_rows($qCheckRealizacja);
		//---------------------------
		$try = trim(addslashes(strip_tags($_POST['try'])));
		$tresc = addslashes($_POST['tresc']);
		
		if(!empty($try) AND $try == "1"){
			if((strtotime($data_stopCheckKolejka) + 60) > strtotime(date("Y-m-d H:i"))){
				if($nCheckRealizacja > 0){
					mysqli_query($connect,"UPDATE `realizacje` SET `tresc` = '$tresc' WHERE `zlecenie_id` = $id AND `wykonawca_id` = ".$_SESSION['user_id']);
					postNotif($user_id,"Zaktualizowano realizację zlecenia","Użytkownik <B>$moj_nick</B> zaktualizował treść swojej realizacji do zlecenia <a href='https://pretext.eu/edytujZlecenie-$id'><B>$tytul</B></a>");
				} else {
					mysqli_query($connect,"INSERT INTO `realizacje` (`zlecenie_id`,`wykonawca_id`,`typ`,`korekta_probna`,`tresc`,`korekta_probna_zatwierdzona`,`closed`,`canceled`,`korekta_plik`) VALUES ('$id','".$_SESSION['user_id']."','$typ','','$tresc','0','0','0','')");
					postNotif($user_id,"Dodano realizację zlecenia","Użytkownik <B>$moj_nick</B> dodał swoją realizację do zlecenia <a href='https://pretext.eu/edytujZlecenie-$id'><B>$tytul</B></a>");
				}
				$saved = 1;
			} else {header("Location: mojeZlecenia?error=Upłynął czas realizacji dla tego zlecenia!");exit;}
		}
		//---------------------------
		$qCheckRealizacja2 = mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `zlecenie_id` = $id AND `wykonawca_id` = ".$_SESSION['user_id']);
		$nCheckRealizacja2 = mysqli_num_rows($qCheckRealizacja2);
		if($nCheckRealizacja2 > 0){
			$sCheckRealizacja2 = mysqli_fetch_array($qCheckRealizacja2);
			$trescCheckRealizacja = $sCheckRealizacja2['tresc'];
			$korekta_probnaCheckRealizacja = $sCheckRealizacja2['korekta_probna'];
		}
		//===========================
		?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="special-head"> Realizacja zlecenia </div>
            </div>
        </div>
				<?php
				if($saved == "1"){
					header("Location: mojeZlecenia?correct=Zmiany zostały zapisane, a realizacja przesłana do Zleceniodawcy!");
				}
				?>
        <div class="row m-b-20">
					<div class="col-6 text-left">
						<?php if($closedPZK != "1"){ ?>
						<div id="timer" style="font-size: 24px; font-weight: bold; color: #adadad;"></div>
						<div style="height: 5px;"></div><a href="moreTime-<?=$id;?>" style="color: #c43762;">Wyślij prośbę o wydłużenie czasu</a>
						<?php } ?>
					</div>
					<div class="col-6 text-right"><a href="<?php if($typ == "nowy"){echo "zleceniaTekst";} else {echo "zleceniaKorekta";} ?>" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left"></i> Wróć do listy zleceń</a></div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="fs-16 fw-700">Opis zlecenia</div>
                <div class=""> <?=$opis;?> </div>
            </div>
            <div class="col-12 col-md-6 realizacja-item-info">
                <div class="row">
                    <div class="col-12 col-md"><a href="message-<?=$user_id;?>"><i class="fa fa-envelope"></i> Wyślij wiadomość do zleceniodawcy</a></div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="m-t-10">Postęp realizacji</div>
                        <div class="progress" id="realizacja-progres">
                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div><span class="progres-caption" style="left:0%;"><i class="fa fa-angle-up"></i>0%</span></div>
                    </div>
                </div>
                <div class="row justify-content-end align-items-end m-t-30">
                    <div class="col-12 col-md-auto">
                        <div class="fs-16 fw-700 lh-normal">Długość:</div>
                        <div class="fs-16 lh-normal"><?=$dlugosc_tekstu;?></div>
                    </div>
                    <div class="col-12 col-md-auto">
                        <div class="fs-16 fw-700">Budżet<span class="help-info" data-toggle="popover-info" data-placement="auto" data-container="body" data-content="&lt;p&gt;Przedstawione kwoty są kwotami brutto. Wyświetlona kwota przy rozliczeniu zostanie pomniejszona o podatek VAT oraz prowizję zgodną z regulaminem.&lt;/p&gt;" data-html="true" data-trigger="hover | click"><i class="fa fa-info"></i></span></div>
                        <div class="fs-18 lh-normal fw-700 fc-gold"><?=number_format($cena,2);?> &#122;&#322; / 1000 znaków</div>
                        <div class="fc-grey lh-normal"><?=number_format($cena_calosc,2);?> &#122;&#322; za całość</div>
                        <div class="fc-cf lh-normal"><?=number_format($cena_netto,2);?> netto</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 m-t-20">
						<?php
						$qUwagi = mysqli_query($connect,"SELECT * FROM `uwagi_dla_wykonawcy` WHERE `zlecenie_id` = $id AND `wykonawca_id` = ".$_SESSION['user_id']." ORDER BY `id` ASC");
						$nUwagi = mysqli_num_rows($qUwagi);
						if($nUwagi > 0){
							echo "<div style='padding: 15px; background: #f5f5f5;'><h5 style='color: #b90b5e;'>Uwagi od zleceniodawcy</h5>";
							while($sUwagi = mysqli_fetch_array($qUwagi)){
								echo $sUwagi['tresc']."<HR>";
							}
							echo "</div><div style='height: 20px;'></div>";
						}
						//==========================================================
						$qCopy = mysqli_query($connect,"SELECT * FROM `wersje_robocze` WHERE `zlecenie_id` = $id AND `wykonawca_id` = ".$_SESSION['user_id']);
						$nCopy = mysqli_num_rows($qCopy);
							$sCopy = mysqli_fetch_array($qCopy);
							$trescCopy = $sCopy['tresc'];
						?>
                <form method="post" accept-charset="utf-8" id="realizacja-auto-save-form" action="">
                    <div style="display:none;">
                        <input type="hidden" class="form-control " name="try" value="1" />
                    </div>
                    <div class="form-group textarea">
                        <label class="fw-700" for="tresc">Treść realizacji</label>
                        <textarea class="form-control" name="tresc" import-warning="Czy na pewno chcesz importować treść? Twoja aktualna treść realizacji zostanie nadpisana!" paste-message="Nie możesz wkleić tekstu realizacji." summernote="true" min-length="<?=$dlugosc_od;?>" max-length="<?=$dlugosc_do;?>" max-target="#tresc-max" maxlength="100000" id="tresc" rows="5" required><?php if($_GET['copy'] == "1"){echo $trescCopy;} else {echo $trescCheckRealizacja;} ?></textarea>
                        <div class="text-right help"><span class="pre-label">Minimum <?=$dlugosc_od;?> znaków</span><span><span id="tresc-max">0</span> / <?=$dlugosc_do;?> znaków</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <?php
												if($closed != '1'){echo '<button type="submit" class="btn btn-primary" id="finishBttn">Zakończ i wyślij realizację do weryfikacji</button>';} else {echo '<button type="submit" class="btn btn-primary" disabled>Zlecenie zamknięte</button>';}
												?>
                    </div>
                </form>
								<script type="text/javascript">
									function kopia_zapasowa(){
										document.getElementById('kopia_robocza').value=document.getElementById('tresc').value;
										document.getElementById('submitKopia').click();
									}
								</script>
								<?php if($closedPZK != "1") { ?>
								<form action='robocze-<?=$id;?>' method='post' id='kopia_zapasowa_form'>
									<input type='hidden' name='tresc' id='kopia_robocza'>
									<input type='submit' id='submitKopia' value='' style='display: none;'>
									<a href="javascript:;" onClick="kopia_zapasowa();" class="btn btn-info"><i class="fa fa-save"></i> Zapisz kopię roboczą</a>
								</form>
								<?php
								}
								
								if($nCopy > 0 AND $closedPZK != "1"){
									echo "<div style='height: 7px;'></div>";
									echo '<a href="joinOffer-'.$id.'&copy=1" class="btn btn-success"><i class="fa fa-upload"></i> Wczytaj kopię roboczą</a>';
								}
								?>
            </div>
        </div>
        <?php if($closed != "1"){ ?>
				<div class="row">
            <div class="col-md-12 text-right">
                <hr/>
                <form method="post" accept-charset="utf-8" pre-message="Czy na pewno chcesz zrezygnować z realizacji?" confirm-btn="Tak" cancel-btn="Nie" action="cancelJoining">
                    <div style="display:none;">
                        <input type="hidden" class="form-control " name="id" value="<?=$id;?>" />
                    </div>
                    <button type="submit" class="btn btn-sm btn-danger m-t-10">Zrezygnuj z realizacji</button>
                </form>
            </div>
        </div>
				<?php } ?>
    </div>
		<!--=============================================================-->
		<!--=============================================================-->
		<!--=============================================================-->
		<?php } else { ?>
		<!--=============================================================-->
		<!--=============================================================-->
		<!--=============================================================-->
		<?php
		//===========================
		$qCheckRealizacja = mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `zlecenie_id` = $id AND `wykonawca_id` = ".$_SESSION['user_id']);
		$nCheckRealizacja = mysqli_num_rows($qCheckRealizacja);
		//---------------------------
		$try = trim(addslashes(strip_tags($_POST['try'])));
		$tresc_probna = addslashes($_POST['tresc_probna']);
		$tresc = addslashes($_POST['tresc']);
		
						$plik_tmp = $_FILES['plik']['tmp_name'];
						$plik_nazwa = $_FILES['plik']['name'];
						$ext = pathinfo($_FILES['plik']['name'], PATHINFO_EXTENSION);
						$plik_nazwa = sha1(md5(time().rand(9999999,999999999999).$moj_email)).".".$ext;

						if(is_uploaded_file($plik_tmp)) {
							if($ext != "php" AND $ext != "PHP" AND $ext != "js" AND $ext != "JS"){
								move_uploaded_file($plik_tmp, "download/$plik_nazwa");
							} else {$plik_nazwa = "";}
						} else {$plik_nazwa = "";}
		
		if(!empty($try) AND $try == "1" AND $closed != '1'){
				if($nCheckRealizacja > 0){
					if(!empty($tresc_probna)){
						mysqli_query($connect,"UPDATE `realizacje` SET `korekta_probna` = '$tresc_probna' WHERE `zlecenie_id` = $id AND `wykonawca_id` = ".$_SESSION['user_id']);
					} else {
						mysqli_query($connect,"UPDATE `realizacje` SET `tresc` = '$tresc' WHERE `zlecenie_id` = $id AND `wykonawca_id` = ".$_SESSION['user_id']);
						if(!empty($plik_nazwa)){
							mysqli_query($connect,"UPDATE `realizacje` SET `korekta_plik` = '$plik_nazwa' WHERE `zlecenie_id` = $id AND `wykonawca_id` = ".$_SESSION['user_id']);
						}
					}
					postNotif($user_id,"Zaktualizowano realizację zlecenia","Użytkownik <B>$moj_nick</B> zaktualizował treść swojej realizacji do zlecenia <a href='https://pretext.eu/edytujZlecenie-$id'><B>$tytul</B></a>");
				} else {
					if(!empty($tresc_probna)){
						mysqli_query($connect,"INSERT INTO `realizacje` (`zlecenie_id`,`wykonawca_id`,`typ`,`korekta_probna`,`tresc`,`korekta_probna_zatwierdzona`,`closed`,`canceled`,`korekta_plik`) VALUES ('$id','".$_SESSION['user_id']."','$typ','$tresc_probna','','0','0','0','')");
					} else {
						mysqli_query($connect,"INSERT INTO `realizacje` (`zlecenie_id`,`wykonawca_id`,`typ`,`korekta_probna`,`tresc`,`korekta_probna_zatwierdzona`,`closed`,`canceled`,`korekta_plik`) VALUES ('$id','".$_SESSION['user_id']."','$typ','','$tresc','0','0','0','$plik_nazwa')");
					}
					postNotif($user_id,"Dodano realizację zlecenia","Użytkownik <B>$moj_nick</B> dodał swoją realizację do zlecenia <a href='https://pretext.eu/edytujZlecenie-$id'><B>$tytul</B></a>");
				}
				$saved = 1;
		}
		//---------------------------
		$qCheckRealizacja2 = mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `zlecenie_id` = $id AND `wykonawca_id` = ".$_SESSION['user_id']);
		$nCheckRealizacja2 = mysqli_num_rows($qCheckRealizacja2);
		if($nCheckRealizacja2 > 0){
			$sCheckRealizacja2 = mysqli_fetch_array($qCheckRealizacja2);
			$trescCheckRealizacja = $sCheckRealizacja2['tresc'];
			$korekta_probnaCheckRealizacja = $sCheckRealizacja2['korekta_probna'];
			$korekta_probna_zatwierdzona = $sCheckRealizacja2['korekta_probna_zatwierdzona'];
		}
		//===========================
		?>
		<div class="container">
        <div class="row">
            <div class="col-12">
                <div class="special-head"> Realizacja zlecenia </div>
            </div>
        </div>
				<?php
				if($saved == "1"){
					header("Location: mojeZlecenia?correct=Zmiany zostały zapisane, a realizacja przesłana do Zleceniodawcy!");exit;
				}
				?>
        <div class="row m-b-20">
					<div class="col-12 text-right"><a href="<?php if($typ == "nowy"){echo "zleceniaTekst";} else {echo "zleceniaKorekta";} ?>" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left"></i> Wróć do listy zleceń</a></div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="fs-16 fw-700">Opis zlecenia</div>
                <div class=""> <?=$opis;?> </div>
            </div>
            <div class="col-12 col-md-6 realizacja-item-info">
                <div class="row">
                    <div class="col-12 col-md"><a href="message-<?=$user_id;?>"><i class="fa fa-envelope"></i> Wyślij wiadomość do zleceniodawcy</a></div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="m-t-10">Postęp realizacji</div>
                        <div class="progress" id="realizacja-progres">
                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div><span class="progres-caption" style="left:0%;"><i class="fa fa-angle-up"></i>0%</span></div>
                    </div>
                </div>
                <div class="row justify-content-end align-items-end m-t-30">
                    <div class="col-12 col-md-auto">
                        <div class="fs-16 fw-700 lh-normal">Długość:</div>
                        <div class="fs-16 lh-normal"><?=$dlugosc_tekstu;?></div>
                    </div>
                    <div class="col-12 col-md-auto">
                        <div class="fs-16 fw-700">Budżet<span class="help-info" data-toggle="popover-info" data-placement="auto" data-container="body" data-content="&lt;p&gt;Przedstawione kwoty są kwotami brutto. Wyświetlona kwota przy rozliczeniu zostanie pomniejszona o podatek VAT oraz prowizję zgodną z regulaminem.&lt;/p&gt;" data-html="true" data-trigger="hover | click"><i class="fa fa-info"></i></span></div>
                        <div class="fs-18 lh-normal fw-700 fc-gold"><?=number_format($cena,2);?> &#122;&#322; / 1000 znaków</div>
                        <div class="fc-grey lh-normal"><?=number_format($cena_calosc,2);?> &#122;&#322; za całość</div>
                        <div class="fc-cf lh-normal"><?=number_format($cena_netto,2);?> netto</div>
                    </div>
                </div>
            </div>
        </div>
				<?php if(!empty($tekst_korekta_probna)){ ?>
				<div style="margin-top: 20px; margin-bottom: 20px; background: #f8f8f8; border-left: 3px solid #da3070; padding: 15px;">
					<h5 style="font-weight: bold;">Tekst do korekty próbnej</h5>
					<?=$tekst_korekta_probna;?>
				</div>
				<?php } ?>
        <div class="row">
            <div class="col-12 col-md-12 m-t-20">
                <form method="post" enctype="multipart/form-data" accept-charset="utf-8" id="realizacja-auto-save-form" action="">
                    <div style="display:none;">
                        <input type="hidden" class="form-control " name="try" value="1" />
                    </div>
                    <?php if($korekta_probna_zatwierdzona == "1" OR empty($tekst_korekta_probna)){ ?>
										<?php if(!empty($tekst_korekta_probna)){ ?>
										<div class="form-group textarea">
                        <label class="fw-700" for="tresc">Twoja realizacja korekty próbnej</label>
                        <textarea class="form-control " rows="5" style="padding: 10px;" disabled><?=strip_tags($korekta_probnaCheckRealizacja);?></textarea>
                    </div>
										<?php } ?>
										<?php /*<div class="form-group textarea">
                        <label class="fw-700" for="tresc">Treść realizacji</label>
                        <textarea class="form-control " name="tresc" summernote="true" min-length="<?=$dlugosc_od;?>" max-length="<?=$dlugosc_do;?>" max-target="#tresc-max" maxlength="100000" id="tresc" rows="5"><?=$trescCheckRealizacja;?></textarea>
                        <div class="text-right help"><span class="pre-label">Minimum <?=$dlugosc_od;?> znaków</span><span><span id="tresc-max">0</span> / <?=$dlugosc_do;?> znaków</span></div>
                    </div> */ ?>
										<?php if(!empty($korekta_plik)){ ?>
										<div style="height: 5px;"></div>
											<div class="row">
												<div class="col-md-4" style="margin-bottom: 10px;">
													<a href="download/<?=$korekta_plik;?>" class="btn btn-info" style="background: #daad2f; border: 0px solid; height: 58px; padding-top: 15px; font-weight: bold; font-size: 20px; width: 100%;"><i class="fa fa-cloud-download-alt"></i>&nbsp;&nbsp;Pobierz plik do pełnej korekty</a>
												</div>
												<div class="col-md-8" style="margin-bottom: 10px;">
														<div class="korekta-plik-container">
                                <div class="row align-items-center">
                                    <div class="col-12 col-lg-9 col-xxl-10 text-center">
                                        <label for="plik" id="file-korekta-preview">Wgraj plik korekty właściwej<span class="help-info" data-toggle="popover-info" data-placement="auto" data-container="body" data-content="&lt;p&gt;Maksymalny rozmiar pliku to 15 MB&lt;/p&gt;" data-html="true" data-trigger="hover | click"><i class="fa fa-info"></i></span></label>
                                    </div>
                                    <div class="col-12 col-lg-3 col-xxl-2 form-mb-0">
                                        <div class="form-group file required">
                                            <div class="file-add">
                                                <input type="file" name="plik" required="required" file-type="other" accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-word.document.macroEnabled.12" preview-target="#file-korekta-preview" id="plik">
                                                <button type="button" class="btn btn-sm btn-info btn-block like-dark">Wybierz...</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
												</div>
											</div>
										<div style="height: 15px;"></div>
										<?php } ?>
										<?php } else { ?>
										<div class="form-group textarea">
                        <label class="fw-700" for="tresc">Twoja realizacja korekty próbnej</label>
                        <textarea class="form-control " name="tresc_probna" import-warning="Czy na pewno chcesz importować treść? Twoja aktualna treść realizacji zostanie nadpisana!" paste-message="Nie możesz wkleić tekstu realizacji." summernote="true" min-length="<?=$dlugosc_od;?>" max-length="<?=$dlugosc_do;?>" max-target="#tresc-max" maxlength="100000" id="tresc" rows="5" required><?=$korekta_probnaCheckRealizacja;?></textarea>
                        <div class="text-right help"><span class="pre-label">Minimum <?=$dlugosc_od;?> znaków</span><span><span id="tresc-max">0</span> / <?=$dlugosc_do;?> znaków</span>
                        </div>
                    </div>
										<?php } ?>
                    <div class="text-right">
												<?php
												if($closed != '1'){echo '<button type="submit" class="btn btn-primary" id="finishBttn">Zakończ i wyślij realizację do weryfikacji</button>';} else {echo '<button type="submit" class="btn btn-primary" disabled>Zlecenie zamknięte</button>';}
												?>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-right">
                <hr/>
                <?php if($closed != '1'){ ?>
								<form method="post" accept-charset="utf-8" pre-message="Czy na pewno chcesz zrezygnować z realizacji?" confirm-btn="Tak" cancel-btn="Nie" action="cancelJoining">
                    <div style="display:none;">
                        <input type="hidden" class="form-control " name="id" value="<?=$id;?>" />
                    </div>
                    <button type="submit" class="btn btn-sm btn-danger m-t-10">Zrezygnuj z realizacji</button>
                </form>
								<?php } ?>
            </div>
        </div>
    </div>
		<?php } ?>
    <?php include("inc/footer.php"); ?>
</body>
</html>