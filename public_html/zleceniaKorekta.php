<?php include("inc/head.php"); ?>
<?php if(empty($_SESSION['user_id'])){header("Location: login");} ?>
<?php if($jestem_korektor != "1"){header("Location: notForMe");} ?>
<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/top.php"); ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="special-head"> Lista zleceń </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3">
						<?php
						showRespond($_GET['error'],$_GET['correct']);
						
						$qMojeAmbicje = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = ".$_SESSION['user_id']);
						$sMojeAmbicje = mysqli_fetch_array($qMojeAmbicje);
							$moje_mocne_strony = $sMojeAmbicje['mocne_strony'];
							$moje_doswiadczenie = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `closed` = '1' AND `canceled` != '1' AND `wykonawca_id` = ".$_SESSION['user_id']));
							//----------------------------------------
							// LICZ SKUTECZNOŚĆ
							$nALLREALIZACJE = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `wykonawca_id` = ".$_SESSION['user_id']));
							$nCANCELEDREALIZACJE = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `canceled` = '1' AND `wykonawca_id` = ".$_SESSION['user_id']));
							$skutecznosc_ujemna = ($nCANCELEDREALIZACJE * 100) / $nALLREALIZACJE;
							$moja_skutecznosc = number_format((100 - $skutecznosc_ujemna),2);
							//----------------------------------------
						
						$qFiltry = mysqli_query($connect,"SELECT * FROM `filtry` WHERE `user_id` = ".$_SESSION['user_id']);
						$nFiltry = mysqli_num_rows($qFiltry);
						$filter = "";
						if($nFiltry > 0){
							$sFiltry = mysqli_fetch_array($qFiltry);
							$cena_odFiltry = $sFiltry['cena_od'];
							$cena_doFiltry = $sFiltry['cena_do'];
							$limitStrona = $sFiltry['limit'];
							$dlugosc_tekstuFiltry = $sFiltry['dlugosc_tekstu']; // 500 | 1000 | 5000 | 500+ | 1000+ | 5000+
							$sortowanieFiltry = $sFiltry['sortowanie'];
							$trescFiltry = $sFiltry['tresc'];
							
							if(!empty($cena_odFiltry) AND $cena_odFiltry > 0){
								$filter .= " AND `cena` >= '$cena_odFiltry'";
							}
							if(!empty($cena_doFiltry) AND $cena_doFiltry > 0){
								$filter .= " AND `cena` <= '$cena_doFiltry'";
							}
							if(!empty($dlugosc_tekstuFiltry)){
								if($dlugosc_tekstuFiltry == "500"){
									$filter .= " AND `dlugosc_do` <= '500'";
								}
								if($dlugosc_tekstuFiltry == "1000"){
									$filter .= " AND `dlugosc_do` <= '1000'";
								}
								if($dlugosc_tekstuFiltry == "5000"){
									$filter .= " AND `dlugosc_do` <= '5000'";
								}
								if($dlugosc_tekstuFiltry == "500+"){
									$filter .= " AND `dlugosc_od` >= '500'";
								}
								if($dlugosc_tekstuFiltry == "1000+"){
									$filter .= " AND `dlugosc_od` >= '1000'";
								}
								if($dlugosc_tekstuFiltry == "5000+"){
									$filter .= " AND `dlugosc_od` >= '5000'";
								}
							}
							if(!empty($sortowanieFiltry)){
								if($sortowanieFiltry == "najnowsze"){$sortowanieFiltry = "DESC";} else {$sortowanieFiltry = "ASC";}
							}
							//-------------------------------------
							if(!empty($trescFiltry)){
								$filter .= " AND (";
								$expFiltry = explode(",",$trescFiltry);
								$countFiltry = count($expFiltry);
								for($iFiltry = 0; $iFiltry < $countFiltry; $iFiltry++){
									if(!empty($expFiltry[$iFiltry])){
										$filterFiltry .= " `kategoria` = '".$expFiltry[$iFiltry]."' OR `typ_tekstu` = '".$expFiltry[$iFiltry]."' OR ";
									}
								}
								$filterFiltry = mb_substr($filterFiltry,0,-4);
								$filter .= $filterFiltry;
								$filter .= ")";
							}
							//-------------------------------------
						} else {$filter = ""; $limitStrona = 25; $sortowanieFiltry = "DESC";}
						?>
                <form method="post" accept-charset="utf-8" class="filter on-mobile-hidden" action="filtrujZlecenia">
									<input type="hidden" name="from" value="nowy">
                    <div class="left-filter-items">
                        <div class="form-group filter-cena">
                            <label class="filter-label">Cena</label>
                            <div><span>od</span>
                                <input type="text" data-type="float" name="cena_od" value="<?=number_format($cena_odFiltry);?>" /><span>do</span>
                                <input type="text" data-type="float" name="cena_do" value="<?=number_format($cena_doFiltry);?>" /><span>/</span>
                                <div class="form-group select">
                                    <select class="form-control " name="cena_za" id="dlugosc-tekstu">
                                        <option value="znaki">1000 znaków</option>
                                    </select><span class="nice-select"><i class="fa fa-angle-down"></i></span></div>
                            </div>
                        </div>
                        <div class="form-group select">
                            <label for="dlugosc-tekstu">Długość tekstu</label>
                            <select class="form-control " name="dlugosc_tekstu" id="dlugosc-tekstu">
																<?php if(!empty($dlugosc_tekstuFiltry)){echo "<option>$dlugosc_tekstuFiltry</option>";} ?>
                                <option value="">Dowolna</option>
                                <option value="500">do 500 znaków</option>
                                <option value="1000">do 1000 znaków</option>
                                <option value="5000">do 5000 znaków</option>
                                <option value="500+">od 500 znaków</option>
                                <option value="1000+">od 1000 znaków</option>
                                <option value="5000+">od 5000 znaków</option>
                            </select><span class="nice-select"><i class="fa fa-angle-down"></i></span><span class="nice-unselect"><i class="fa fa-times"></i></span></div>
                        <div class="form-group select">
                            <label class="filter-label" for="typ">Typy tekstu</label>
                            <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="typ_tekstu_opis" value="Opis" id="typ-ids-1" <?php if(filtrujZlecenia($_SESSION['user_id'],"Opis") == 1){echo "checked";} ?>>
                                                <label for="typ-ids-1">Opis</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="typ_tekstu_tekst_preclowy" value="Tekst preclowy" id="typ-ids-2" <?php if(filtrujZlecenia($_SESSION['user_id'],"Tekst preclowy") == 1){echo "checked";} ?>>
                                                <label for="typ-ids-2">Tekst preclowy</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="typ_tekstu_tekst_synonimiczny" value="Tekst synonimiczny" id="typ-ids-3" <?php if(filtrujZlecenia($_SESSION['user_id'],"Tekst synonimiczny") == 1){echo "checked";} ?>>
                                                <label for="typ-ids-3">Tekst synonimiczny</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="typ_tekstu_tekst_zapleczowy" value="Tekst zapleczowy" id="typ-ids-4" <?php if(filtrujZlecenia($_SESSION['user_id'],"Tekst zapleczowy") == 1){echo "checked";} ?>>
                                                <label for="typ-ids-4">Tekst zapleczowy</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="typ_tekstu_recenzja" value="Recenzja" id="typ-ids-5" <?php if(filtrujZlecenia($_SESSION['user_id'],"Recenzja") == 1){echo "checked";} ?>>
                                                <label for="typ-ids-5">Recenzja </label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="typ_tekstu_tekst_marketingowy" value="Tekst marketingowy" id="typ-ids-6" <?php if(filtrujZlecenia($_SESSION['user_id'],"Tekst marketingowy") == 1){echo "checked";} ?>>
                                                <label for="typ-ids-6">Tekst marketingowy</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="typ_tekstu_artykuly_spec_i_nauk" value="Artykuły specjalistyczne i naukowe" id="typ-ids-7" <?php if(filtrujZlecenia($_SESSION['user_id'],"Artykuły specjalistyczne i naukowe") == 1){echo "checked";} ?>>
                                                <label for="typ-ids-7">Artykuły specjalistyczne i naukowe</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="typ_tekstu_prace_naukowe" value="Prace naukowe" id="typ-ids-8" <?php if(filtrujZlecenia($_SESSION['user_id'],"Prace naukowe") == 1){echo "checked";} ?>>
                                                <label for="typ-ids-8">Prace naukowe</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="typ_tekstu_korekta" value="Korekta" id="typ-ids-9" <?php if(filtrujZlecenia($_SESSION['user_id'],"Korekta") == 1){echo "checked";} ?>>
                                                <label for="typ-ids-9">Korekta</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="typ_tekstu_inne" value="Inne" id="typ-ids-10" <?php if(filtrujZlecenia($_SESSION['user_id'],"Inne") == 1){echo "checked";} ?>>
                                                <label for="typ-ids-10">Inne</label>
                                            </div>
                                        </div><span class="nice-select"><i class="fa fa-angle-down"></i></span><span class="nice-unselect"><i class="fa fa-times"></i></span></div>
                        <div class="form-group select">
                            <label class="filter-label" for="kategoria">Tematyka</label>
                            <input type="hidden" class="form-control " name="kategoria" value="" />
                            <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_bizes_i_prawo" value="Biznes i prawo" id="kategoria-ids-1" <?php if(filtrujZlecenia($_SESSION['user_id'],"Biznes i prawo") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-1">Biznes i prawo</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_budownictwo_nieruchomosci" value="Budownictwo i nieruchomości" id="kategoria-ids-2" <?php if(filtrujZlecenia($_SESSION['user_id'],"Budownictwo i nieruchomości") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-2">Budownictwo i nieruchomości</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_ecommerce" value="E-commerce" id="kategoria-ids-3" <?php if(filtrujZlecenia($_SESSION['user_id'],"E-commerce") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-3">E-commerce</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_edukacja" value="Edukacja" id="kategoria-ids-4" <?php if(filtrujZlecenia($_SESSION['user_id'],"Edukacja") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-4">Edukacja</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_erotyka" value="Erotyka" id="kategoria-ids-5" <?php if(filtrujZlecenia($_SESSION['user_id'],"Erotyka") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-5">Erotyka</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_informacje_publicystyka" value="Informacje i publicystyka" id="kategoria-ids-6" <?php if(filtrujZlecenia($_SESSION['user_id'],"Informacje i publicystyka") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-6">Informacje i publicystyka</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_kultura_rozrywka" value="Kultura i rozrywka" id="kategoria-ids-7" <?php if(filtrujZlecenia($_SESSION['user_id'],"Kultura i rozrywka") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-7">Kultura i rozrywka</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_motoryzacja" value="Motoryzacja" id="kategoria-ids-8" <?php if(filtrujZlecenia($_SESSION['user_id'],"Motoryzacja") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-8">Motoryzacja</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_moda" value="Moda" id="kategoria-ids-9" <?php if(filtrujZlecenia($_SESSION['user_id'],"Moda") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-9">Moda</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_technologie" value="Nowe technologie" id="kategoria-ids-10" <?php if(filtrujZlecenia($_SESSION['user_id'],"Nowe technologie") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-10">Nowe technologie</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_sport" value="Sport" id="kategoria-ids-11" <?php if(filtrujZlecenia($_SESSION['user_id'],"Sport") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-11">Sport</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_styl_zycia" value="Styl życia" id="kategoria-ids-12" <?php if(filtrujZlecenia($_SESSION['user_id'],"Styl życia") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-12">Styl życia</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_turystyka_gastro" value="Turystyka i gastronomia" id="kategoria-ids-13" <?php if(filtrujZlecenia($_SESSION['user_id'],"Turystyka i gastronomia") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-13">Turystyka i gastronomia</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_zdrowie_medycyna" value="Zdrowie i medycyna" id="kategoria-ids-14" <?php if(filtrujZlecenia($_SESSION['user_id'],"Zdrowie i medycyna") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-14">Zdrowie i medycyna</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_inne" value="Inne" id="kategoria-ids-15" <?php if(filtrujZlecenia($_SESSION['user_id'],"Inne") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-15">Inne</label>
                                            </div>
                                        </div><span class="nice-select"><i class="fa fa-angle-down"></i></span><span class="nice-unselect"><i class="fa fa-times"></i></span></div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-block">Filtruj</button>
                        </div>
                    </div>
            </div>
            <div class="col-12 col-md-8 col-lg-9 right-list-content">
                    <div class="row align-items-end">
                        <div class="col col-md-auto">
                            <div class="form-group">
                                <label for="sort">Sortuj</label>
                                <div class="btn-group btn-block">
                                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="sortowanieBttn">
																		<?php
																		if(!empty($sortowanieFiltry)){
																			if($sortowanieFiltry == "ASC"){
																				echo "Od najstarszych";
																			}
																			if($sortowanieFiltry == "DESC"){
																				echo "Od najnowszych";
																			}
																		}
																		?>
																		</button>
                                    <div class="dropdown-menu">
																		<input type="hidden" id="sortowanie" name="sortowanie" value="najnowsze">
                                        <?php
																				if(!empty($sortowanieFiltry)){
																					if($sortowanieFiltry == "ASC"){
																						echo '<div class="dropdown-item" onClick="document.getElementById(\'sortowanieBttn\').innerHTML=\'Od najstarszych\';"><a href="javascript:;" onClick="document.getElementById(\'sortowanie\').value=\'najstarsze\';">Od najstarszych</a></div>';
																					}
																					if($sortowanieFiltry == "DESC"){
																						echo '
																						<div class="dropdown-item" onClick="document.getElementById(\'sortowanieBttn\').innerHTML=\'Od najnowszych\';"><a href="javascript:;" onClick="document.getElementById(\'sortowanie\').value=\'najnowsze\';">Od najnowszych</a></div>
																						';
																					}
																				}
																				?>
																				<?php if($sortowanieFiltry != "ASC"){ ?><div class="dropdown-item" onClick="document.getElementById('sortowanieBttn').innerHTML='Od najstarszych';"><a href="javascript:;" onClick="document.getElementById('sortowanie').value='najstarsze';">Od najstarszych</a></div><?php } ?>
                                        <?php if($sortowanieFiltry != "DESC"){ ?><div class="dropdown-item" onClick="document.getElementById('sortowanieBttn').innerHTML='Od najnowszych';"><a href="javascript:;" onClick="document.getElementById('sortowanie').value='najnowsze';">Od najnowszych</a></div><?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-auto">
                            <div class="form-group">
                                <label for="sort">Na stronie</label>
                                <div class="btn-group btn-block">
                                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="limitBttn"> <?=$limitStrona;?> </button>
                                    <input type="hidden" id="limit" name="limit" value="25">
																		<div class="dropdown-menu">
                                        <?php
																				if(!empty($limitStrona)){
																					echo '<div class="dropdown-item" onClick="document.getElementById(\'limitBttn\').innerHTML=\''.$limitStrona.'\';"><a href="javascript:;" onClick="document.getElementById(\'limit\').value=\''.$limitStrona.'\';">'.$limitStrona.'</a></div>';
																				}
																				?>
                                        <?php if($limitStrona != '25'){ ?><div class="dropdown-item" onClick="document.getElementById('limitBttn').innerHTML='25';"><a href="javascript:;" onClick="document.getElementById('limit').value='25';">25</a></div><?php } ?>
                                        <?php if($limitStrona != '50'){ ?><div class="dropdown-item" onClick="document.getElementById('limitBttn').innerHTML='50';"><a href="javascript:;" onClick="document.getElementById('limit').value='50';">50</a></div><?php } ?>
                                        <?php if($limitStrona != '75'){ ?><div class="dropdown-item" onClick="document.getElementById('limitBttn').innerHTML='75';"><a href="javascript:;" onClick="document.getElementById('limit').value='75';">75</a></div><?php } ?>
                                        <?php if($limitStrona != '100'){ ?><div class="dropdown-item" onClick="document.getElementById('limitBttn').innerHTML='100';"><a href="javascript:;" onClick="document.getElementById('limit').value='100';">100</a></div><?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col text-right pagin-top"></div>
                    </div>
                </form>
                <div class="row zlecenia-lista-content">
                    <div class="col-12">
                        <?php
												$perPage = $limitStrona;
												if (is_numeric($_REQUEST['page'])) {
												$page = (int) $_REQUEST['page'];
												if ($page < 1) {
												$page = 1;
												}
												} else {
												$page = 1;
												}
												$start = ($page - 1) * $perPage;
												$q = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `wykonawca_id` = '0' $filter AND `closed` != '1' AND `typ` = 'korekta' AND (`dla_ulubionych` = '' OR `dla_ulubionych` LIKE '%,".$_SESSION['user_id']."%') ORDER BY `id` $sortowanieFiltry LIMIT $start, $perPage");
												$n = mysqli_num_rows($q);
												if($n > 0){
												while($s = mysqli_fetch_array($q)){
													$tytul = $s['tytul'];
													$kategoria = $s['kategoria'];
													$typ_tekstu = $s['typ_tekstu'];
													$id = $s['id'];
													$opis = $s['opis'];
													$slowa_kluczowe = $s['slowa_kluczowe'];
													$dlugosc_od = $s['dlugosc_od'];
													$dlugosc_do = $s['dlugosc_do'];
													if($dlugosc_od == $dlugosc_do){
														$dlugosc_tekstu = $dlugosc_od." znaków";
													} else {
														$dlugosc_tekstu = "od $dlugosc_od do $dlugosc_do znaków";
													}
													$cena = $s['cena'];
													$cena_calosc = ($cena/1000)*$dlugosc_do;
													$cena_netto = $cena_calosc / 1.23;
													//--------------------------------------------
													$wykonawca_skutecznosc = $s['wykonawca_skutecznosc'];
													$wykonawca_specjalizacje = $s['wykonawca_specjalizacje'];
													$wykonawca_doswiadczenie = $s['wykonawca_doswiadczenie'];
													
													if(empty($wykonawca_skutecznosc) OR (!empty($wykonawca_skutecznosc) AND $moja_skutecznosc >= $wykonawca_skutecznosc)){
													if(empty($wykonawca_doswiadczenie) OR (!empty($wykonawca_doswiadczenie) AND $moje_doswiadczenie >= $wykonawca_doswiadczenie)){
													
													if(!empty($wykonawca_specjalizacje)){
														$porownanie_spec_pasuje = 0;
														$expMMS = explode(",",$moje_mocne_strony);
														$countMMS = count($expMMS);
														for($iMMS = 0; $iMMS < $countMMS; $iMMS++){
															//echo $expMMS[$iMMS].'<BR>';
															$nPorownajSpec = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $id AND `wykonawca_specjalizacje` LIKE '%".$expMMS[$iMMS]."%'"));
															if($nPorownajSpec > 0){
																$porownanie_spec_pasuje += 1;
															}
														}
													}
													//echo $porownanie_spec_pasuje;
													if(empty($wykonawca_specjalizacje) OR (!empty($wykonawca_specjalizacje) AND $porownanie_spec_pasuje > 0)){
												?>
												<div class="zlecenie-index-item ">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-9 zlecenie-index-right-content">
                                    <div class="title"><?=$tytul;?></div>
                                    <div class="description">
                                        <div class="fw-700 mobile-ov-hidden">Opis</div>
                                        <div id="item-opis-VVVG2OEAN2" class="mobile-opis-hidden"><?=$opis;?></div>
                                    </div>
                                    <div class="details">
                                        <div class="row align-items-end">
                                            <div class="col-12 col-md-auto align-self-start fc-gold fw-700 pd-r-10">Słowa kluczowe</div>
                                            <div class="col-12 col-md br-l-6">
                                                <div class="tagi"><?=$slowa_kluczowe;?></div>
                                                <div class="row">
                                                    <div class="col-12 col-md-auto lh-normal"><span class="fw-700">Kategoria</span>: <?=$kategoria;?></div>
                                                    <div class="col-12 col-md lh-normal"><span class="fw-700">Typ tekstu</span>: <?=$typ_tekstu;?></div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-auto">
                                                <div class="fs-16 fw-700 lh-normal">Długość:</div>
                                                <div class="fs-16 lh-normal"><?=$dlugosc_tekstu;?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-3 zlecenie-lista-actions">
                                    <div class="fs-16 fw-700">Budżet<span class="help-info" data-toggle="popover-info" data-placement="auto" data-container="body" data-content="&lt;p&gt;Przedstawione kwoty są kwotami brutto. Wyświetlona kwota przy rozliczeniu zostanie pomniejszona o podatek VAT.&lt;/p&gt;" data-html="true" data-trigger="hover | click"><i class="fa fa-info"></i></span></div>
                                    <div class="fs-18 lh-normal fw-700 fc-gold"><?=$cena;?> &#122;&#322; / 1000 znaków</div>
                                    <div class="fc-grey lh-normal"><?=number_format($cena_calosc,2);?> &#122;&#322; za całość</div>
                                    <div class="fc-cf lh-normal"><?=number_format($cena_netto,2);?> &#122;&#322; netto</div>
                                    
																		<div class="btn-action"><span class="jak-to-dziala-link" data-toggle="popover-info" data-trigger="hover" data-content="Kliknij w PRZYJMIJ ZLECENIE, aby przejść do realizacji. Od tej pory zlecenie będzie przypisane do Twojego konta. Po akceptacji przez ZLeceniodawcę, zostaniesz poinformowany o tym stosownym komunikatem.">Jak to działa?</span>
																		
																		<?php
																		$qCancelledControl = mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `zlecenie_id` = $id AND `canceled` = '1' AND `wykonawca_id` = ".$_SESSION['user_id']);
																		$nCancelledControl = mysqli_num_rows($qCancelledControl);
																		if($nCancelledControl > 0){
																		?>
																		<a href="javascript:;" class="btn text-center btn-block btn-info btn-rezerwuj-zlecenie"><i class="fs-10 fa fa-remove-format"></i> Realizacja odrzucona</a>
																		<?php
																		} else {
																		?>
																		<a href="<?php if($moj_typ == "wykonawca"){echo 'joinOffer-'.$id;} else {echo "javascript:;";} ?>" class="btn text-center btn-block btn-primary btn-rezerwuj-zlecenie"><i class="fs-20 fa fa-check-circle"></i> Przyjmij zlecenie</a>
																		<?php } ?>
																		</div>
                                </div>
                            </div>
                        </div>
                        <?php
												}
												}
												}
												}
												} else {error("Brak kolejnych wpisów!");}
												$prev = $page - 1;
												$next = $page + 1;
												$prevLink = 'zleceniaTekst-'.$prev;
												$nextLink = 'zleceniaTekst-'.$next;

												echo "<div style='padding-top: 15px;'>";
												if(!empty($_GET['page']) AND $_GET['page'] != "0" AND $_GET['page'] != "1"){
												echo "<input type='button' value='Wstecz' class='btn btn-primary' style='margin-right: 5px; width: 100px;' OnClick=\"document.location.href='$prevLink'\">";
												}

												if($n >= $perPage){
												echo "<input type='button' value='Dalej' class='btn btn-primary' style='float: right; width: 100px;' OnClick=\"document.location.href='$nextLink'\">";
												}
												echo "</div>";
												echo "<div style='clear: both;'></div>";
												?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-right"></div>
                </div>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>