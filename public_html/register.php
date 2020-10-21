<?php include("inc/head.php"); ?>

<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/top.php"); ?>
		<?php
		$qQuestK = mysqli_query($connect,"SELECT * FROM `zadania_korektor` ORDER BY RAND() LIMIT 1");
		$sQuestK = mysqli_fetch_array($qQuestK);
		$trescQuestK = $sQuestK['zadanie'];
		//-----------------------------------
		$qQuestC = mysqli_query($connect,"SELECT * FROM `zadania_copywriter` ORDER BY RAND() LIMIT 1");
		$sQuestC = mysqli_fetch_array($qQuestC);
		$trescQuestC = $sQuestC['zadanie'];
		?>
    <div class="container login-container">
        <div class="row">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9 col-lg-8 pd-t-35">
                        <div class="row row-special-head">
                            <div class="col-12">
                                <div class="special-head">Rejestracja</div>
                            </div>
                        </div>
                        <?php
												$q_rejestracja_1 = mysqli_query($connect,"SELECT * FROM `mail_templates` WHERE `mail_id` = 'rejestracja_zleceniodawca' ORDER BY `id` DESC LIMIT 1");
												$s_rejestracja_1 = mysqli_fetch_array($q_rejestracja_1);
													$tresc_rejestracja_1 = $s_rejestracja_1['tresc'];
													
												$q_rejestracja_2 = mysqli_query($connect,"SELECT * FROM `mail_templates` WHERE `mail_id` = 'rejestracja_wykonawca' ORDER BY `id` DESC LIMIT 1");
												$s_rejestracja_2 = mysqli_fetch_array($q_rejestracja_2);
													$tresc_rejestracja_2 = $s_rejestracja_2['tresc'];
												//==============================================
												$imie = trim(addslashes(strip_tags($_POST['imie'])));
												$nazwisko = trim(addslashes(strip_tags($_POST['nazwisko'])));
												$email = trim(addslashes(strip_tags($_POST['email'])));
												$pass = trim(addslashes(strip_tags($_POST['pass'])));
												$pass2 = trim(addslashes(strip_tags($_POST['pass2'])));
												$nick = trim(addslashes(strip_tags($_POST['nick'])));
												$telefon = trim(addslashes(strip_tags($_POST['telefon'])));
												$nazwa_firmy = trim(addslashes(strip_tags($_POST['nazwa_firmy'])));
												$nip = trim(addslashes(strip_tags($_POST['nip'])));
												$regon = trim(addslashes(strip_tags($_POST['regon'])));
												$miasto = trim(addslashes(strip_tags($_POST['miasto'])));
												$ulica = trim(addslashes(strip_tags($_POST['ulica'])));
												$zip = trim(addslashes(strip_tags($_POST['zip'])));
												$nr_domu = trim(addslashes(strip_tags($_POST['nr_domu'])));
												$copywriter_rozwiazanie = trim(addslashes(strip_tags($_POST['copywriter_rozwiazanie'])));
												$korektor_rozwiazanie = trim(addslashes(strip_tags($_POST['korektor_rozwiazanie'])));
												$typ = trim(addslashes(strip_tags($_POST['typ'])));
												$korektor = trim(addslashes(strip_tags($_POST['korektor']))); // 0 | 1
													if(empty($korektor)){$korektor = "0";}
												$copywriter = trim(addslashes(strip_tags($_POST['copywriter']))); // 0 | 1
													if(empty($copywriter)){$copywriter = "0";}
												//==============================================
												if($pass == $pass2){
													$pass = sha1(md5($pass));
													$hash = sha1(md5(time().rand(999999,999999999999)));
													if(!empty($email)){
														$n = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `users` WHERE `email` = '$email'"));
														if($n == 0){
														mysqli_query($connect,"INSERT INTO `users` (`email`, `password`, `typ`, `copywriter`, `korektor`, `imie`, `nazwisko`, `img`, `nick`, `telefon`, `nazwa_firmy`, `nip`, `regon`, `miasto`, `ulica`, `nr_domu`, `zip`, `copywriter_rozwiazanie`, `korektor_rozwiazanie`, `active`,`hash`,`bank_acc`,`mocne_strony`,`data`,`wallet`,`count_nowy`,`count_korekta`,`show_name`,`notifs_on`) VALUES ('$email', '$pass', '$typ', '0', '0', '$imie', '$nazwisko', '', '$nick', '$telefon', '$nazwa_firmy', '$nip', '$regon', '$miasto', '$ulica', '$nr_domu', '$zip', '$copywriter_rozwiazanie', '$korektor_rozwiazanie', '0','$hash','','','".date("Y-m-d")."','0','0','0','0','1');");
														
														//--------------------------------------
														$activation_link = "<a href='".MAIN_URL."confirmAcc-$hash' style='text-decoration: none;'>".MAIN_URL."confirmAcc-$hash</a>";
														
														if($typ == "wykonawca"){
															$tresc_maila = $tresc_rejestracja_2;
														} else {
															$tresc_maila = $tresc_rejestracja_1;
														}
														
														$tresc_maila = str_replace("[NAME]",$imie,$tresc_maila);
														$tresc_maila = str_replace("[ACTIVATION_LINK]",$activation_link,$tresc_maila);
														//--------------------------------------
														$mail->Subject = "Pretext - aktywacja konta";//temat maila
														$mail->AddEmbeddedImage("images/logoMail.png", "baner1", "logoMail.png", "base64");
														$text_body = '<!DOCTYPE html PUBLIC 
														"-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
														<html xmlns="http://www.w3.org/1999/xhtml">
														<head>
														<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
														</head>
														<body style="padding: 0px; margin: 0px;">
														<div style="padding: 10px; background: #3f4e62; font-family: Arial;">
														<BR><CENTER><img src="cid:baner1" /></CENTER>
														<BR><BR>
														<div style="padding: 15px; background: #fff; font-family: Arial;">
														';
														
														$text_body .= $tresc_maila;
														
														$text_body .= "</div><div style='clear: both; height: 4px;'></div><div style='float: right; color: #fff; font-family: Arial; padding-top: 5px;'>Pretext</div><div style='clear: both; height: 4px;'></div></div></body></html>";

														$mail->Body = $text_body;
														// adresatów dodajemy poprzez metode 'AddAddress'
														$mail->AddAddress($email,"Pretext");

														if(!$mail->Send()) echo $mail->ErrorInfo;
														// Clear all addresses and attachments
														$mail->ClearAddresses();
														$mail->ClearAttachments();
														//--------------------------------------
														correct("Twoje konto zostało utworzone! Sprawdź swoją skrzynkę pocztową i kliknij w link aktywacyjny.");
														} else {errorFIXED("Podany adres e-mail jest już w użyciu!");}
													}
												} else {errorFIXED("Wpisane hasła muszą być takie same!");}
												//==============================================
												?>
												<ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item flex-fill"><a class="nav-link active" id="wykonawca-tab" data-toggle="tab" href="#wykonawca" role="tab" aria-controls="wykonawca" aria-selected="true">Wykonawca</a></li>
                            <li class="nav-item flex-fill"><a class="nav-link" id="zleceniodawca-tab" data-toggle="tab" href="#zleceniodawca" role="tab" aria-controls="zleceniodawca" aria-selected="false">Zleceniodawca</a></li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="wykonawca" role="tabpanel" aria-labelledby="wykonawca-tab">
                                <form method="post" accept-charset="utf-8" id="form-zleceniodawca-register" type-error="Wybierz rodzaj konta:" class="register-form" action="register">
                                    <div class="row">
                                        <div class="col-12 col-md-7 form-mb-0">
                                            <div class="row align-items-center m-b-10 m-t-20">
                                                <div class="col-12 col-md-4 text-right mobile-text-left padding-right-0">
                                                    <label class="mb-0" for="wykonawca-imie">Imię:</label>
                                                </div>
                                                <div class="col-12 col-md">
                                                    <div class="form-group text required">
                                                        <input type="text" class="form-control " name="imie" id="wykonawca-imie" required="required" maxlength="50" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center m-b-10">
                                                <div class="col-12 col-md-4 text-right mobile-text-left padding-right-0">
                                                    <label class="mb-0" for="wykonawca-nazwisko">Nazwisko:</label>
                                                </div>
                                                <div class="col-12 col-md">
                                                    <div class="form-group text required">
                                                        <input type="text" class="form-control " name="nazwisko" id="wykonawca-nazwisko" required="required" maxlength="50" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center m-b-10">
                                                <div class="col-12 col-md-4 text-right mobile-text-left padding-right-0">
                                                    <label class="mb-0" for="wykonawca-alias">Nick:</label>
                                                </div>
                                                <div class="col-12 col-md">
                                                    <div class="form-group text">
                                                        <input type="text" class="form-control " name="nick" id="wykonawca-alias" maxlength="20" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center m-b-10">
                                                <div class="col-12 col-md-4 text-right mobile-text-left padding-right-0">
                                                    <label class="mb-0" for="wykonawca-email">Adres email:</label>
                                                </div>
                                                <div class="col-12 col-md">
                                                    <div class="form-group text required">
                                                        <input type="text" class="form-control " name="email" id="wykonawca-email" required="required" maxlength="150" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center m-b-10">
                                                <div class="col-12 col-md-4 text-right mobile-text-left padding-right-0">
                                                    <label class="mb-0" for="wykonawca-password">Hasło:</label>
                                                </div>
                                                <div class="col-12 col-md">
                                                    <div class="form-group password required">
                                                        <input type="password" class="form-control " name="pass" id="wykonawca-password" required="required" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center m-b-10">
                                                <div class="col-12 col-md-4 text-right mobile-text-left padding-right-0">
                                                    <label class="mb-0" for="wykonawca-repeat-password">Powtórz hasło:</label>
                                                </div>
                                                <div class="col-12 col-md">
                                                    <div class="form-group password required">
                                                        <input type="password" class="form-control " name="pass2" id="wykonawca-repeat-password" required="required" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md nice-checkbox">
                                            <div class="special-head min m-t-20">Rejestruję się jako</div>
                                            <div class="form-group checkbox">
                                                <input type="hidden" class="form-control " name="copywriterHidden" value="0" />
                                                <div>
                                                    <input type="checkbox" name="copywriter" value="1" id="register-as-copywriter">
                                                    <label for="register-as-copywriter">Copywriter</label>
                                                </div>
                                            </div>
                                            <div class="form-group checkbox">
                                                <input type="hidden" class="form-control " name="korektorHidden" value="0" />
                                                <div>
                                                    <input type="checkbox" name="korektor" value="1" id="register-as-korektor">
                                                    <label for="register-as-korektor">Korektor</label>
                                                </div>
                                            </div>
                                            <div class="m-t-10">
                                                <div class="alert alert-warning">
                                                    <p class="text-justify"><i class="fas fa-exclamation"></i> Pamiętaj aby potwierdzić rejestracje po założeniu konta, tylko wtedy Twoje zadanie zostanie zweryfikowane.
                                                        <br>Po zapisaniu formularza sprawdź swoją skrzynkę e-mail i kliknij w link potwierdzający rejestracje.</p>
                                                    <p style="text-align: center; "><b>Jeżeli nie widzisz naszej wiadomości sprawdź SPAM</b></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="copywriter-quest" class="row justify-content-center ">
                                        <div class="col-12">
                                            <div class="zadanie-info">
                                                <p><i class="fa fa-info-circle" style="font-size: 16px;"></i><span style="font-size: 16px;"> Zadanie weryfikacyjne! </span></p>
                                                <p><span style="font-size: 16px;">Aby zostać naszym copywriterem, musisz&nbsp;przejść weryfikację. Wystarczy, że rozwiążesz poniższe zadanie.</span>&nbsp;
                                                    <br>
                                                </p>
                                            </div>
                                            <div class="zadanie-tresc">
                                                <p><B><?=$trescQuestC;?></B></p>
                                            </div>
                                            <div class="form-group textarea required">
                                                <label for="rozwiazanie">Wprowadź treść rozwiązania:</label>
                                                <textarea class="form-control " name="copywriter_rozwiazanie" required="required" disabled="disabled" maxlengthcounter="true" minlength="100" min="100" max="600" counter="#zadanie-length-counter" id="rozwiazanie" rows="5"></textarea>
                                                <div class="textarea-counter-container"><span id="zadanie-length-counter">0/600</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="korektor-quest" class="row justify-content-center ">
                                        <div class="col-12">
                                            <div class="zadanie-info">
                                                <p><i class="fa fa-info-circle" style="font-size: 16px;"></i><span style="font-size: 16px;"> Zadanie weryfikacyjne! </span></p>
                                                <p><span style="font-size: 16px;">Aby zostać naszym korektorem, musisz&nbsp;przejść weryfikację. Wystarczy, że rozwiążesz poniższe zadanie.</span></p>
                                            </div>
                                            <div class="zadanie-tresc">
                                                <p><b>Wykonaj korektę poniższego tekstu:</b></p>
                                                <p><span style="font-size: 18px;"><?=$trescQuestK;?></span></p>
                                            </div>
                                            <div class="form-group textarea required">
                                                <label for="rozwiazanie-korekta">Wprowadź treść rozwiązania:</label>
                                                <textarea class="form-control " name="korektor_rozwiazanie" required="required" disabled="disabled" counter="#zadanie-length-counter" id="rozwiazanie-korekta" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-mb-0">
                                        <div class="col-12 col-md-7 nowarp-checkbox">
                                            <div class="form-group checkbox required">
                                                <input type="hidden" class="form-control " name="zgoda" value="0" />
                                                <div>
                                                    <input type="checkbox" name="zgoda" value="1" id="wykonawca-employer_zgoda" required="required">
                                                    <label for="wykonawca-employer_zgoda">Wyrażam zgodę na przetwarzanie danych osobowych.</label>
                                                </div>
                                            </div>
                                            <div class="form-group checkbox required">
                                                <input type="hidden" class="form-control " name="regulamin" value="0" />
                                                <div>
                                                    <input type="checkbox" name="regulamin" value="1" id="wykonawca-employer_regulamin" required="required">
                                                    <label for="wykonawca-employer_regulamin">Akceptuję regulamin.</label>
                                                </div>
                                            </div>
                                        </div>
																				<input type="hidden" name="typ" value="wykonawca">
                                        <div class="col-12 col-md-5 align-self-end">
                                            <button type="submit" class="btn btn-primary btn-block" name="register">Zarejestruj się</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="zleceniodawca" role="tabpanel" aria-labelledby="zleceniodawca-tab">
                                <form method="post" accept-charset="utf-8" class="register-form" action="register">
                                    <input type="hidden" class="form-control " name="typ" value="zleceniodawca" />
                                    <div class="row">
                                        <div class="col-12 col-md-7 form-mb-0">
                                            <div class="row align-items-center m-b-10 m-t-20">
                                                <div class="col-12 col-md-4 text-right mobile-text-left padding-right-0">
                                                    <label class="mb-0" for="zleceniodawca-imie">Imię:</label>
                                                </div>
                                                <div class="col-12 col-md">
                                                    <div class="form-group text required">
                                                        <input type="text" class="form-control " name="imie" id="zleceniodawca-imie" required="required" maxlength="50" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center m-b-10">
                                                <div class="col-12 col-md-4 text-right mobile-text-left padding-right-0">
                                                    <label class="mb-0" for="zleceniodawca-nazwisko">Nazwisko:</label>
                                                </div>
                                                <div class="col-12 col-md">
                                                    <div class="form-group text required">
                                                        <input type="text" class="form-control " name="nazwisko" id="zleceniodawca-nazwisko" required="required" maxlength="50" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center m-b-10">
                                                <div class="col-12 col-md-4 text-right mobile-text-left padding-right-0">
                                                    <label class="mb-0" for="zleceniodawca-telefon">Telefon:</label>
                                                </div>
                                                <div class="col-12 col-md">
                                                    <div class="form-group text">
                                                        <input type="text" class="form-control " name="telefon" id="zleceniodawca-telefon" maxlength="15" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center m-b-10">
                                                <div class="col-12 col-md-4 text-right mobile-text-left padding-right-0">
                                                    <label class="mb-0" for="zleceniodawca-email">Adres email:</label>
                                                </div>
                                                <div class="col-12 col-md">
                                                    <div class="form-group text required">
                                                        <input type="text" class="form-control " name="email" id="zleceniodawca-email" required="required" maxlength="150" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center m-b-10">
                                                <div class="col-12 col-md-4 text-right mobile-text-left padding-right-0">
                                                    <label class="mb-0" for="zleceniodawca-password">Hasło:</label>
                                                </div>
                                                <div class="col-12 col-md">
                                                    <div class="form-group password required">
                                                        <input type="password" class="form-control " name="pass" id="zleceniodawca-password" required="required" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center m-b-10">
                                                <div class="col-12 col-md-4 text-right mobile-text-left padding-right-0">
                                                    <label class="mb-0" for="zleceniodawca-repeat-password">Powtórz hasło:</label>
                                                </div>
                                                <div class="col-12 col-md">
                                                    <div class="form-group password required">
                                                        <input type="password" class="form-control " name="pass2" id="zleceniodawca-repeat-password" required="required" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md form-mb-0">
                                            <div class="special-head min m-t-20" style="margin-bottom: 11px;">Dane firmy</div>
                                            <div class="row align-items-center m-b-10">
                                                <div class="col-12">
                                                    <div class="form-group text">
                                                        <input type="text" class="form-control " name="nazwa_firmy" id="zleceniodawca-nazwa-firmy" placeholder="Nazwa firmy" maxlength="150" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center m-b-10">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group text">
                                                        <input type="text" class="form-control " name="nip" id="zleceniodawca-nip" placeholder="NIP" maxlength="22" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group text">
                                                        <input type="text" class="form-control " name="regon" id="zleceniodawca-regon" placeholder="REGON" maxlength="15" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center m-b-10">
                                                <div class="col-12">
                                                    <div class="form-group text">
                                                        <input type="text" class="form-control " name="miasto" id="zleceniodawca-miasto" placeholder="Miasto" maxlength="150" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center m-b-10">
                                                <div class="col-12">
                                                    <div class="form-group text">
                                                        <input type="text" class="form-control " name="ulica" id="zleceniodawca-ulica" placeholder="Ulica" maxlength="80" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center m-b-10">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group text">
                                                        <input type="text" class="form-control " name="zip" id="zleceniodawca-kod-pocztowy" placeholder="Kod pocztowy" maxlength="15" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group text">
                                                        <input type="text" class="form-control " name="nr_domu" id="zleceniodawca-nr-domu" placeholder="Nr dom / lok." maxlength="30" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-mb-0">
                                        <div class="col-12 col-md-7 nowarp-checkbox">
                                            <div class="form-group checkbox required">
                                                <input type="hidden" class="form-control " name="zgoda" value="0" />
                                                <div>
                                                    <input type="checkbox" name="zgoda" value="1" id="zleceniodawca-employer_zgoda" required="required">
                                                    <label for="zleceniodawca-employer_zgoda">Wyrażam zgodę na przetwarzanie danych osobowych.</label>
                                                </div>
                                            </div>
                                            <div class="form-group checkbox required">
                                                <input type="hidden" class="form-control " name="regulamin" value="0" />
                                                <div>
                                                    <input type="checkbox" name="regulamin" value="1" id="zleceniodawca-employer_regulamin" required="required">
                                                    <label for="zleceniodawca-employer_regulamin">Akceptuję regulamin.</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-5 align-self-end">
                                            <button type="submit" class="btn btn-primary btn-block" name="register">Zarejestruj się</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>