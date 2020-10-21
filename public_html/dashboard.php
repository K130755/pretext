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
        <div class="row">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-9">
												<?php
												showRespond($_GET['error'],$_GET['correct']);
												
												$imiePost = trim(addslashes(strip_tags($_POST['imie'])));
												$nazwiskoPost = trim(addslashes(strip_tags($_POST['nazwisko'])));
												$nickPost = trim(addslashes(strip_tags($_POST['nick'])));
												$telefonPost = trim(addslashes(strip_tags($_POST['telefon'])));
												$bank_accPost = trim(addslashes(strip_tags($_POST['bank_acc'])));
												$zipPost = trim(addslashes(strip_tags($_POST['zip'])));
												$miastoPost = trim(addslashes(strip_tags($_POST['miasto'])));
												$ulicaPost = trim(addslashes(strip_tags($_POST['ulica'])));
												$nr_domuPost = trim(addslashes(strip_tags($_POST['nr_domu'])));
												$nazwa_firmyPost = trim(addslashes(strip_tags($_POST['nazwa_firmy'])));
												$nipPost = trim(addslashes(strip_tags($_POST['nip'])));
												$regonPost = trim(addslashes(strip_tags($_POST['regon'])));
												$show_namePost = trim(addslashes(strip_tags($_POST['show_name'])));
													if(empty($show_namePost)){$show_namePost = "0";}
												$notifs_onPost = trim(addslashes(strip_tags($_POST['notifs_on'])));
													if(empty($notifs_onPost)){$notifs_onPost = "0";}
												$tryPost = trim(addslashes(strip_tags($_POST['try'])));
												$passPost = trim(addslashes(strip_tags($_POST['pass'])));
												$pass2Post = trim(addslashes(strip_tags($_POST['pass2'])));
												//-----------------------
												$typ_tekstu_opisPost = trim(addslashes(strip_tags($_POST['typ_tekstu_opis'])));
												$typ_tekstu_tekst_preclowyPost = trim(addslashes(strip_tags($_POST['typ_tekstu_tekst_preclowy'])));
												$typ_tekstu_tekst_synonimicznyPost = trim(addslashes(strip_tags($_POST['typ_tekstu_tekst_synonimiczny'])));
												$typ_tekstu_tekst_zapleczowyPost = trim(addslashes(strip_tags($_POST['typ_tekstu_tekst_zapleczowy'])));
												$typ_tekstu_recenzjaPost = trim(addslashes(strip_tags($_POST['typ_tekstu_recenzja'])));
												$typ_tekstu_tekst_marketingowyPost = trim(addslashes(strip_tags($_POST['typ_tekstu_tekst_marketingowy'])));
												$typ_tekstu_artykuly_spec_i_naukPost = trim(addslashes(strip_tags($_POST['typ_tekstu_artykuly_spec_i_nauk'])));
												$typ_tekstu_prace_naukowePost = trim(addslashes(strip_tags($_POST['typ_tekstu_prace_naukowe'])));
												$typ_tekstu_korektaPost = trim(addslashes(strip_tags($_POST['typ_tekstu_korekta'])));
												$typ_tekstu_innePost = trim(addslashes(strip_tags($_POST['typ_tekstu_inne'])));
												//-----------------------
												$kategoria_bizes_i_prawoPost = trim(addslashes(strip_tags($_POST['kategoria_bizes_i_prawo'])));
												$kategoria_budownictwo_nieruchomosciPost = trim(addslashes(strip_tags($_POST['kategoria_budownictwo_nieruchomosci'])));
												$kategoria_ecommercePost = trim(addslashes(strip_tags($_POST['kategoria_ecommerce'])));
												$kategoria_edukacjaPost = trim(addslashes(strip_tags($_POST['kategoria_edukacja'])));
												$kategoria_erotykaPost = trim(addslashes(strip_tags($_POST['kategoria_erotyka'])));
												$kategoria_informacje_publicystykaPost = trim(addslashes(strip_tags($_POST['kategoria_informacje_publicystyka'])));
												$kategoria_kultura_rozrywkaPost = trim(addslashes(strip_tags($_POST['kategoria_kultura_rozrywka'])));
												$kategoria_motoryzacjaPost = trim(addslashes(strip_tags($_POST['kategoria_motoryzacja'])));
												$kategoria_modaPost = trim(addslashes(strip_tags($_POST['kategoria_moda'])));
												$kategoria_technologiePost = trim(addslashes(strip_tags($_POST['kategoria_technologie'])));
												$kategoria_sportPost = trim(addslashes(strip_tags($_POST['kategoria_sport'])));
												$kategoria_styl_zyciaPost = trim(addslashes(strip_tags($_POST['kategoria_styl_zycia'])));
												$kategoria_turystyka_gastroPost = trim(addslashes(strip_tags($_POST['kategoria_turystyka_gastro'])));
												$kategoria_zdrowie_medycynaPost = trim(addslashes(strip_tags($_POST['kategoria_zdrowie_medycyna'])));
												$kategoria_innePost = trim(addslashes(strip_tags($_POST['kategoria_inne'])));
												//-----------------------
												$mocne_strony = "";
												if(!empty($typ_tekstu_opisPost)){$mocne_strony .= ",".$typ_tekstu_opisPost;}
												if(!empty($typ_tekstu_tekst_preclowyPost)){$mocne_strony .= ",".$typ_tekstu_tekst_preclowyPost;}
												if(!empty($typ_tekstu_tekst_synonimicznyPost)){$mocne_strony .= ",".$typ_tekstu_tekst_synonimicznyPost;}
												if(!empty($typ_tekstu_tekst_zapleczowyPost)){$mocne_strony .= ",".$typ_tekstu_tekst_zapleczowyPost;}
												if(!empty($typ_tekstu_recenzjaPost)){$mocne_strony .= ",".$typ_tekstu_recenzjaPost;}
												if(!empty($typ_tekstu_tekst_marketingowyPost)){$mocne_strony .= ",".$typ_tekstu_tekst_marketingowyPost;}
												if(!empty($typ_tekstu_artykuly_spec_i_naukPost)){$mocne_strony .= ",".$typ_tekstu_artykuly_spec_i_naukPost;}
												if(!empty($typ_tekstu_prace_naukowePost)){$mocne_strony .= ",".$typ_tekstu_prace_naukowePost;}
												if(!empty($typ_tekstu_korektaPost)){$mocne_strony .= ",".$typ_tekstu_korektaPost;}
												if(!empty($typ_tekstu_innePost)){$mocne_strony .= ",".$typ_tekstu_innePost;}
												//---
												if(!empty($kategoria_bizes_i_prawoPost)){$mocne_strony .= ",".$kategoria_bizes_i_prawoPost;}
												if(!empty($kategoria_budownictwo_nieruchomosciPost)){$mocne_strony .= ",".$kategoria_budownictwo_nieruchomosciPost;}
												if(!empty($kategoria_ecommercePost)){$mocne_strony .= ",".$kategoria_ecommercePost;}
												if(!empty($kategoria_edukacjaPost)){$mocne_strony .= ",".$kategoria_edukacjaPost;}
												if(!empty($kategoria_erotykaPost)){$mocne_strony .= ",".$kategoria_erotykaPost;}
												if(!empty($kategoria_informacje_publicystykaPost)){$mocne_strony .= ",".$kategoria_informacje_publicystykaPost;}
												if(!empty($kategoria_kultura_rozrywkaPost)){$mocne_strony .= ",".$kategoria_kultura_rozrywkaPost;}
												if(!empty($kategoria_motoryzacjaPost)){$mocne_strony .= ",".$kategoria_motoryzacjaPost;}
												if(!empty($kategoria_modaPost)){$mocne_strony .= ",".$kategoria_modaPost;}
												if(!empty($kategoria_technologiePost)){$mocne_strony .= ",".$kategoria_technologiePost;}
												if(!empty($kategoria_sportPost)){$mocne_strony .= ",".$kategoria_sportPost;}
												if(!empty($kategoria_styl_zyciaPost)){$mocne_strony .= ",".$kategoria_styl_zyciaPost;}
												if(!empty($kategoria_turystyka_gastroPost)){$mocne_strony .= ",".$kategoria_turystyka_gastroPost;}
												if(!empty($kategoria_zdrowie_medycynaPost)){$mocne_strony .= ",".$kategoria_zdrowie_medycynaPost;}
												if(!empty($kategoria_innePost)){$mocne_strony .= ",".$kategoria_innePost;}
												//-----------------------
												if(!empty($tryPost) AND $tryPost == "1"){
													if(!empty($imiePost)){
														mysqli_query($connect,"UPDATE `users` SET `imie` = '$imiePost' WHERE `id` = ".$_SESSION['user_id']);
														mysqli_query($connect,"UPDATE `users` SET `nazwisko` = '$nazwiskoPost' WHERE `id` = ".$_SESSION['user_id']);
														mysqli_query($connect,"UPDATE `users` SET `nick` = '$nickPost' WHERE `id` = ".$_SESSION['user_id']);
														mysqli_query($connect,"UPDATE `users` SET `telefon` = '$telefonPost' WHERE `id` = ".$_SESSION['user_id']);
														mysqli_query($connect,"UPDATE `users` SET `bank_acc` = '$bank_accPost' WHERE `id` = ".$_SESSION['user_id']);
														mysqli_query($connect,"UPDATE `users` SET `zip` = '$zipPost' WHERE `id` = ".$_SESSION['user_id']);
														mysqli_query($connect,"UPDATE `users` SET `miasto` = '$miastoPost' WHERE `id` = ".$_SESSION['user_id']);
														mysqli_query($connect,"UPDATE `users` SET `ulica` = '$ulicaPost' WHERE `id` = ".$_SESSION['user_id']);
														mysqli_query($connect,"UPDATE `users` SET `nr_domu` = '$nr_domuPost' WHERE `id` = ".$_SESSION['user_id']);
														mysqli_query($connect,"UPDATE `users` SET `nazwa_firmy` = '$nazwa_firmyPost' WHERE `id` = ".$_SESSION['user_id']);
														mysqli_query($connect,"UPDATE `users` SET `nip` = '$nipPost' WHERE `id` = ".$_SESSION['user_id']);
														mysqli_query($connect,"UPDATE `users` SET `regon` = '$regonPost' WHERE `id` = ".$_SESSION['user_id']);
														mysqli_query($connect,"UPDATE `users` SET `mocne_strony` = '$mocne_strony' WHERE `id` = ".$_SESSION['user_id']);
														mysqli_query($connect,"UPDATE `users` SET `show_name` = '$show_namePost' WHERE `id` = ".$_SESSION['user_id']);
														mysqli_query($connect,"UPDATE `users` SET `notifs_on` = '$notifs_onPost' WHERE `id` = ".$_SESSION['user_id']);
														correctFIXED("Zmiany zostały zapisane!");
													}
												}
												if(!empty($passPost) AND !empty($pass2Post)){
													if($passPost == $pass2Post){
														$passPost = sha1(md5($passPost));
														mysqli_query($connect,"UPDATE `users` SET `password` = '$passPost' WHERE `id` = ".$_SESSION['user_id']);
													} else {error("Hasło nie zostało zmienione - wpisane hasła muszą być takie same!");}
												}
												//==============================================
												$q = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = ".$_SESSION['user_id']);
												$s = mysqli_fetch_array($q);
													$typ = $s['typ'];
													$imie = $s['imie'];
													$nazwisko = $s['nazwisko'];
													$email = $s['email'];
													$telefon = $s['telefon'];
													$nick = $s['nick'];
													$nazwa_firmy = $s['nazwa_firmy'];
													$nip = $s['nip'];
													$regon = $s['regon'];
													$miasto = $s['miasto'];
													$ulica = $s['ulica'];
													$nr_domu = $s['nr_domu'];
													$zip = $s['zip'];
													$bank_acc = $s['bank_acc'];
													$show_name = $s['show_name'];
													$notifs_on = $s['notifs_on'];
												?>
                        <form method="post" accept-charset="utf-8" action="">
                            <div class="row m-t-100 m-b-20">
                                <div class="col-12"><span class="fs-16 fw-700">Podstawowe dane:</span></div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <div class="form-group text required">
                                        <label for="imie">Imię:</label>
                                        <input type="text" class="form-control " name="imie" required="required" maxlength="50" id="imie" value="<?=$imie;?>" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group text required">
                                        <label for="nazwisko">Nazwisko:</label>
                                        <input type="text" class="form-control " name="nazwisko" required="required" maxlength="50" id="nazwisko" value="<?=$nazwisko;?>" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group text">
                                        <label for="alias">Nick:</label>
                                        <input type="text" class="form-control " value="<?=$nick;?>" name="nick" maxlength="20" id="alias" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group text">
                                        <label for="telefon">Telefon:</label>
                                        <input type="text" class="form-control " name="telefon" maxlength="15" id="telefon" value="<?=$telefon;?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <hr/>
                                </div>
                            </div>
														<div class="row m-t-20 m-b-20">
                                <div class="col-12"><span class="fs-16 fw-700">Ustawienia:</span></div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <div class="form-group text required">
                                        <label for="show_name">Pokazuj moje pełne imię i nazwisko:</label>
                                        <input type="checkbox" name="show_name" id="show_name" value="1" <?php if($show_name == "1"){echo "checked";} ?> />
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group text required">
                                        <label for="notifs_on">Chcę otrzymywać powiadomienia e-mail:</label>
                                        <input type="checkbox" name="notifs_on" id="notifs_on" value="1" <?php if($notifs_on == "1"){echo "checked";} ?> />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <hr/>
                                </div>
                            </div>
                            <div class="row m-t-50 m-b-10">
                                <div class="col-6 col-md-6">
																	<span class="fs-16 fw-700">Zmień hasło:</span>
																	<div style="height: 10px;"></div>
																	<div class="row">
																		<div class="col-md-6" style="margin-bottom: 5px;">
																			<B>Nowe hasło:</B>
																			<input type="password" class="form form-control" name="pass">
																		</div>
																		<div class="col-md-6" style="margin-bottom: 5px;">
																			<B>Powtórz nowe hasło:</B>
																			<input type="password" class="form form-control" name="pass2">
																		</div>
																	</div>
																</div>
																<div class="col-6 col-md-6">
																		<span class="fs-16 fw-700">Konto bankowe:</span>
																		<div style="height: 10px;"></div>
                                    <div class="form-group text">
                                        <label for="nr-konta">Wprowadź numer konta</label>
                                        <input type="text" class="form-control " name="bank_acc" value="<?=$bank_acc;?>" maxlength="64" id="nr-konta" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <hr/>
                                </div>
                            </div>
                            <?php if($typ == "zleceniodawca"){ ?>
														<div class="row m-t-30 m-b-20 align-items-center">
                                <div class="col-12"><span class="fs-16 fw-700">Dane do faktury lub umowy:</span></div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <div class="form-group text">
                                        <label for="kod-pocztowy">Kod pocztowy:</label>
                                        <input type="text" class="form-control " name="zip" maxlength="15" id="kod-pocztowy" value="<?=$zip;?>" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group text">
                                        <label for="miasto">Miasto:</label>
                                        <input type="text" class="form-control " name="miasto" maxlength="150" id="miasto" value="<?=$miasto;?>" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group text">
                                        <label for="ulica">Ulica:</label>
                                        <input type="text" class="form-control " name="ulica" maxlength="80" id="ulica" value="<?=$ulica;?>" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group text">
                                        <label for="nr-domu">Numer domu / mieszkania:</label>
                                        <input type="text" class="form-control " name="nr_domu" maxlength="30" id="nr-domu" value="<?=$nr_domu;?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <div class="form-group text">
                                        <label for="nazwa-firmy">Nazwa firmy:</label>
                                        <input type="text" class="form-control " name="nazwa_firmy" maxlength="150" id="nazwa-firmy" value="<?=$nazwa_firmy;?>" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group text">
                                        <label for="nip">NIP:</label>
                                        <input type="text" class="form-control " name="nip" maxlength="22" id="nip" value="<?=$nip;?>" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group text">
                                        <label for="regon">REGON:</label>
                                        <input type="text" class="form-control " name="regon" maxlength="15" id="regon" value="<?=$regon;?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <hr/>
                                </div>
                            </div>
														<?php } ?>
														<?php if($typ == "wykonawca"){ ?>
														<div class="row m-t-30 m-b-20">
                                <div class="col-12"><span class="fs-16 fw-700">Twoje mocne strony</span>
                                    <p></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-4 multi-sel">
                                    <div class="form-group select">
                                        <label for="typ-ids">Typy tekstu</label>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="typ_tekstu_opis" value="Opis" id="typ-ids-1" <?php if(mocneStrony($_SESSION['user_id'],"Opis") == 1){echo "checked";} ?>>
                                                <label for="typ-ids-1">Opis</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="typ_tekstu_tekst_preclowy" value="Tekst preclowy" id="typ-ids-2" <?php if(mocneStrony($_SESSION['user_id'],"Tekst preclowy") == 1){echo "checked";} ?>>
                                                <label for="typ-ids-2">Tekst preclowy</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="typ_tekstu_tekst_synonimiczny" value="Tekst synonimiczny" id="typ-ids-3" <?php if(mocneStrony($_SESSION['user_id'],"Tekst synonimiczny") == 1){echo "checked";} ?>>
                                                <label for="typ-ids-3">Tekst synonimiczny</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="typ_tekstu_tekst_zapleczowy" value="Tekst zapleczowy" id="typ-ids-4" <?php if(mocneStrony($_SESSION['user_id'],"Tekst zapleczowy") == 1){echo "checked";} ?>>
                                                <label for="typ-ids-4">Tekst zapleczowy</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="typ_tekstu_recenzja" value="Recenzja" id="typ-ids-5" <?php if(mocneStrony($_SESSION['user_id'],"Recenzja") == 1){echo "checked";} ?>>
                                                <label for="typ-ids-5">Recenzja </label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="typ_tekstu_tekst_marketingowy" value="Tekst marketingowy" id="typ-ids-6" <?php if(mocneStrony($_SESSION['user_id'],"Tekst marketingowy") == 1){echo "checked";} ?>>
                                                <label for="typ-ids-6">Tekst marketingowy</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="typ_tekstu_artykuly_spec_i_nauk" value="Artykuły specjalistyczne i naukowe" id="typ-ids-7" <?php if(mocneStrony($_SESSION['user_id'],"Artykuły specjalistyczne i naukowe") == 1){echo "checked";} ?>>
                                                <label for="typ-ids-7">Artykuły specjalistyczne i naukowe</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="typ_tekstu_prace_naukowe" value="Prace naukowe" id="typ-ids-8" <?php if(mocneStrony($_SESSION['user_id'],"Prace naukowe") == 1){echo "checked";} ?>>
                                                <label for="typ-ids-8">Prace naukowe</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="typ_tekstu_korekta" value="Korekta" id="typ-ids-9" <?php if(mocneStrony($_SESSION['user_id'],"Korekta") == 1){echo "checked";} ?>>
                                                <label for="typ-ids-9">Korekta</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="typ_tekstu_inne" value="Inne" id="typ-ids-10" <?php if(mocneStrony($_SESSION['user_id'],"Inne") == 1){echo "checked";} ?>>
                                                <label for="typ-ids-10">Inne</label>
                                            </div>
                                        </div><span class="nice-select"><i class="fa fa-angle-down"></i></span><span class="nice-unselect"><i class="fa fa-times"></i></span></div>
                                </div>
                                <div class="col-12 col-md-8 col-lg-7 col-xxl-6 wrap-options multi-sel">
                                    <div class="form-group select">
                                        <label for="kategoria-ids">Tematyka</label>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_bizes_i_prawo" value="Biznes i prawo" id="kategoria-ids-1" <?php if(mocneStrony($_SESSION['user_id'],"Biznes i prawo") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-1">Biznes i prawo</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_budownictwo_nieruchomosci" value="Budownictwo i nieruchomości" id="kategoria-ids-2" <?php if(mocneStrony($_SESSION['user_id'],"Budownictwo i nieruchomości") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-2">Budownictwo i nieruchomości</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_ecommerce" value="E-commerce" id="kategoria-ids-3" <?php if(mocneStrony($_SESSION['user_id'],"E-commerce") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-3">E-commerce</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_edukacja" value="Edukacja" id="kategoria-ids-4" <?php if(mocneStrony($_SESSION['user_id'],"Edukacja") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-4">Edukacja</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_erotyka" value="Erotyka" id="kategoria-ids-5" <?php if(mocneStrony($_SESSION['user_id'],"Erotyka") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-5">Erotyka</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_informacje_publicystyka" value="Informacje i publicystyka" id="kategoria-ids-6" <?php if(mocneStrony($_SESSION['user_id'],"Informacje i publicystyka") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-6">Informacje i publicystyka</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_kultura_rozrywka" value="Kultura i rozrywka" id="kategoria-ids-7" <?php if(mocneStrony($_SESSION['user_id'],"Kultura i rozrywka") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-7">Kultura i rozrywka</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_motoryzacja" value="Motoryzacja" id="kategoria-ids-8" <?php if(mocneStrony($_SESSION['user_id'],"Motoryzacja") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-8">Motoryzacja</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_moda" value="Moda" id="kategoria-ids-9" <?php if(mocneStrony($_SESSION['user_id'],"Moda") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-9">Moda</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_technologie" value="Nowe technologie" id="kategoria-ids-10" <?php if(mocneStrony($_SESSION['user_id'],"Nowe technologie") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-10">Nowe technologie</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_sport" value="Sport" id="kategoria-ids-11" <?php if(mocneStrony($_SESSION['user_id'],"Sport") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-11">Sport</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_styl_zycia" value="Styl życia" id="kategoria-ids-12" <?php if(mocneStrony($_SESSION['user_id'],"Styl życia") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-12">Styl życia</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_turystyka_gastro" value="Turystyka i gastronomia" id="kategoria-ids-13" <?php if(mocneStrony($_SESSION['user_id'],"Turystyka i gastronomia") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-13">Turystyka i gastronomia</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_zdrowie_medycyna" value="Zdrowie i medycyna" id="kategoria-ids-14" <?php if(mocneStrony($_SESSION['user_id'],"Zdrowie i medycyna") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-14">Zdrowie i medycyna</label>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="kategoria_inne" value="Inne" id="kategoria-ids-15" <?php if(mocneStrony($_SESSION['user_id'],"Inne") == 1){echo "checked";} ?>>
                                                <label for="kategoria-ids-15">Inne</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
														<div class="row">
                                <div class="col-12">
                                    <hr/>
                                </div>
                            </div>
														<?php } ?>
														<input type="hidden" name="try" value="1">
                            <div class="row">
																<div class="col-6 text-left">
																	<a href="javascript:;" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Usuń konto</a>
																</div>
                                <div class="col-6 text-right">
                                    <button type="submit" class="btn btn-primary">Zapisz dane</button>
                                </div>
                            </div>
                        </form>
												<!--===============================-->
																	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																		<div class="modal-dialog" role="document">
																			<div class="modal-content">
																				<form action="removeAccount" method="post">
																				<div class="modal-header">
																					<h5 class="modal-title" id="exampleModalLabel">Usuwanie konta</h5>
																					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																						<span aria-hidden="true">&times;</span>
																					</button>
																				</div>
																				<div class="modal-body">
																					<CENTER><h4 class="modal-title" id="exampleModalLabel" style="font-weight: bold;">Aby usunąć konto podaj hasło<BR>którym się logujesz.</h4></CENTER>
																					<div style="height: 10px;"></div>
																					<input type="password" name="pass" class="form form-control" required>
																					<div style="height: 10px;"></div>
																					<CENTER>Aby usunąć konto, nie możesz mieć otwartych zleceń i realizacji. Jeżeli posiadasz środki w portfelu - zostaną one wypłacone zgodnie z regulaminem.</CENTER>
																				</div>
																				<div class="modal-footer">
																					<button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
																					<button type="submit" class="btn btn-primary">Usuń konto</button>
																				</div>
																				</form>
																			</div>
																		</div>
																	</div>
												<!--===============================-->
												<?php if($typ == "wykonawca"){ ?>
												<div class="row m-t-30 m-b-20">
                          <div class="col-12"><span class="fs-16 fw-700">Moje portfolio</span>
                            <p></p>
													</div>
                        </div>
												<button type="button" class="btn btn-info" onClick="document.getElementById('portfolioForm').style.display='block';">Dodaj pracę do portfolio</button>
												<div id='portfolioForm' style='display: none; margin-top: 25px;'>
													<form action='addPortfolio' method='post'>
														<input type='text' name='tytul' class='form form-control' style='padding: 10px;' placeholder='Tytuł Twojej pracy' required>
														<div style='height: 10px;'></div>
														<textarea class='form form-control' style='width: 100%; height: 185px; padding: 10px;' placeholder='Treść pracy' name='tresc' required></textarea>
														<div style='height: 10px;'></div>
														<div style='text-align: right;'><input type='submit' class='btn btn-success' value='Dodaj pracę'></div>
													</form>
												</div>
												<div style="height: 20px;"></div>
												<?php
												$qPortfolio = mysqli_query($connect,"SELECT * FROM `portfolio` WHERE `user_id` = ".$_SESSION['user_id']." ORDER BY `id` DESC");
												$nPortfolio = mysqli_num_rows($qPortfolio);
												if($nPortfolio > 0){
													echo "<table class='table table-striped'>";
														echo "
														<tr>
															<td style='font-weight: bold;'>Tytuł pracy</td>
															<td style='width: 1%; text-align: right;' nowrap='nowrap'>Akcje</td>
														</tr>
														";
														while($sPortfolio = mysqli_fetch_array($qPortfolio)){
															$tytulPortfolio = $sPortfolio['tytul'];
															$idPortfolio = $sPortfolio['id'];
															echo "
															<tr>
																<td>$tytulPortfolio</td>
																<td nowrap='nowrap'><a href='editPortfolio-$idPortfolio'>Edytuj</a>&nbsp;&nbsp;<a href='removePortfolio-$idPortfolio' style='color: #d20000;'>Usuń</a></td>
															</tr>
															";
														}
													echo "</table>";
												}
												?>
												<?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>