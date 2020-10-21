<footer>
        <div class="container footer">
            <div class="row align-items-start">
                <div class="col-12 col-md-3"><span style="font-size: 45px; line-height: normal;" class="as-logo">PRE<span style="text-shadow: -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff, 1px 1px 0 #fff;font-size: 40px;vertical-align: top;display: inline-block;padding-top: 3px;letter-spacing: 2px;">TEXT</span></span>
                    <div class="footer-seo-text m-t-30"> Pretext.eu to nowa jakość w dziedzinie copywritingu. Wyróżnia nas szeroki zakres usług od tekstów SEO, poprzez profesjonalne artykuły, aż do korekty i redakcji tekstu. Sprawdź nasze możliwości, zamów unikalny tekst już dziś i ciesz się z PRETEXTU! </div>
                    <div class="m-t-20"><a href="register" class="btn btn-sm btn-primary">Dołącz do nas</a></div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="row justify-content-start align-items-start">
                        <div class="col-12 col-md-4 col-lg">
                            <div class="footer-head">Pretext</div>
                            <ul class="footer-links g-1">
                                <li><a href="about" link-type="type_default" title="O nas">O nas</a></li>
                                <li><a href="kontakt" link-type="type_default" title="Kontakt">Kontakt</a></li>
                                <li><a href="partners" link-type="type_default" title="Partnerzy">Partnerzy</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-4 col-lg">
                            <div class="footer-head">Informacje </div>
                            <ul class="footer-links g-2">
                                <li><a href="terms" link-type="type_default" title="Regulamin">Regulamin</a></li>
                                <li><a href="privacy" link-type="type_default" title="Polityka prywatności">Polityka prywatności</a></li>
                                <li><a href="privacy" link-type="type_default" title="Polityka plików cookie">Polityka plików cookie</a></li>
                                <li><a href="faq" link-type="type_default" title="Pytania i odpowiedzi">Pytania i odpowiedzi</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-4 col-lg">
                            <div class="footer-head">Copywriting</div>
                            <ul class="footer-links g-3">
                                <li><a href="dashboard" title="Twoje konto" target="_self">Twoje konto</a></li>
                                <li><a href="postTekst" title="Zleć tekst" target="_self">Zleć tekst</a></li>
                                <li><a href="mojeZlecenia" title="Lista zleceń" target="_self">Lista zleceń</a></li>
                                <li><a href="kalkulator" title="Wycena" target="_self">Wycena</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-4 col-lg">
                            <div class="footer-head">Korekta</div>
                            <ul class="footer-links g-4">
                                <li><a href="dashboard" title="Twoje konto" target="_self">Twoje konto</a></li>
                                <li><a href="postKorekta" title="Zleć korektę" target="_self">Zleć korektę</a></li>
                                <li><a href="mojeZlecenia" title="Lista zleceń" target="_self">Lista zleceń</a></li>
                                <li><a href="kalkulator" title="Wycena" target="_self">Wycena</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-4 col-lg-auto align-self-end">
                            <div class="footer-head"></div>
                            <ul class="footer-links g-5">
                                <li>
                                    <a href="javascript:;" title="Płatności on-line" target="_self" rel="nofollow"><img src="images/payu.png" /></a>
                                </li>
                                <li>
                                    <a href="javascript:;" title="Certyfikat SSL" target="_self" rel="nofollow"><img src="images/ssl.png" /></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="footer-social"></div>
                        </div>
                        <div class="col-12 col-md">
													<?php if(!empty($instagramContact)){ ?><a href="<?=$instagramContact;?>" class="social-liink"><i class="fab fa-instagram"></i></a><?php } ?>
													<?php if(!empty($facebookContact)){ ?><a href="<?=$facebookContact;?>" class="social-liink"><i class="fab fa-facebook-f"></i></a><?php } ?>
													<?php if(!empty($googleContact)){ ?><a href="<?=$googleContact;?>" class="social-liink"><i class="fab fa-google"></i></a><?php } ?>
												</div>
                        <div class="col-12 col-md-8 col-lg-auto text-right">
                            <form method="post" accept-charset="utf-8" id="newsletter-form" action="newsletter">
                                <div class="newsletter-info-text">Bądź na bieżąco:</div>
																<button type="submit" class="newsletter-button btn-color-1" style="float: right;">Zapisz</button>
                                <input required="required" name="email" type="email" placeholder="Wpisz swój adres mailowy..." class="newsletter-input" style="float: right;">
                            </form>
                        </div>
                    </div>
                    <div class="row justify-content-end"></div>
                </div>
            </div>
        </div>
    </footer><span class="back-to-top" style="opacity: 0.1;"><i class="fa fa-arrow-up"></i></span>
    <script defer src="js/jquery-ui.min.js"></script>
    <script defer src="js/popper.min.js"></script>
    <script defer src="js/bootstrap.min.js"></script>
    <script defer src="js/moment.min.js"></script>
    <?php if($_SERVER['PHP_SELF'] != "/index.php"){ ?>
		<script defer src="js/pl.js"></script>
    <script defer src="js/tagsinput.js"></script>
    <script defer src="js/favico-0.3.10.min.js"></script>
    <script defer src="js/ion.rangeSlider.min.js"></script>
    <script defer src="js/multiple-select.min.js"></script>
		<?php } ?>
    <script defer src="js/jquery.datetimepicker.full.min.js"></script>
    <?php if($_SERVER['PHP_SELF'] != "/index.php"){ ?>
		<script defer src="js/pnotify.js"></script>
    <script defer src="js/pnotify.buttons.js"></script>
    <script defer src="js/pnotify.nonblock.js"></script>
    <script defer src="js/fullcalendar.js"></script>
    <script defer src="js/pl2.js"></script>
    <script defer src="js/sweetalert2.all.min.js"></script>
    <script defer src="js/lightbox.min.js"></script>
    <script defer src="js/summernote-lite.min.js"></script>
    <script defer src="js/jquery.validate.min.js"></script>
    <script defer src="js/additional-methods.js?5e6173b25d027"></script>
    <script defer src="js/messages_pl.js"></script>
		<?php } ?>
    <script defer src="js/select2.min.js"></script>
		<?php if($_SERVER['PHP_SELF'] != "/index.php"){ ?>
    <script defer src="js/currency.js?u=5e6173b25d02b"></script>
    <script defer src="js/jquery.nicescroll.min.js"></script>
    <script defer src="js/daterangepicker.js"></script>
    <script defer src="js/bootstrap-datepicker.min.js"></script>
		<script defer src="js/plotly-latest.min.js"></script>
    <script defer src="js/plotly-locale-pl.js"></script>
    <script defer src="js/phone.js"></script>
		<?php
		}
		?>
		
		<script type="text/javascript">
		window.onload = function () {
			$('#menuModal').on('hidden.bs.modal', function (e) {
				hamFunction(document.getElementById('hamSwitch'));
			})
			
			$('#menuModal').on('shown.bs.modal', function (e) {
			$(".modal-backdrop.show").css({ opacity: 0.9 });
			})
		}
		</script>
		
		<?php if($typ == "korekta"){
			echo '<script defer src="js/globalKorekta.js?5e6173b25d0af"></script>';
		} else {
			echo '<script defer src="js/global.js?5e6173b25d0af"></script>';
		}
    ?>
		<script type="text/javascript">
		window.onload = function () {
		function refreshNotifs(){
				$.ajax({
						url: "inc/myNotifs.php",
						success: 
						function(result){
								$('#myNotifs').html(result);
								$('#myNotifs2').html(result);//insert text of test.php into your div
								setTimeout(function(){
										refreshNotifs(); //this will send request again and again;
								}, 10000);
						}
				});
		}
		
		<?php if($autosave == 1){ ?>
		var myTime = setInterval(autokopia_zapasowa,420000);
		function autokopia_zapasowa(){
			if(document.getElementById('tresc').value != ''){
				document.getElementById('kopia_robocza').value=document.getElementById('tresc').value;
				
				var url = "robocze-<?=$id;?>"; // the script where you handle the form input.
				$.ajax({
							 type: "POST",
							 url: url,
							 data: $("#kopia_zapasowa_form").serialize(), // serializes the form's elements.
							 success: function(data)
							 {
									document.getElementById('backupInfo').innerHTML = '<div id="hideMe" style="color: #5e8b3d; border: 1px solid #d7f6c1; border-radius: 4px; background: #e6fdd5; padding: 10px 20px 10px 20px; position: fixed; z-index: 999999; top: 36px; right: 30px;"><i class="fa fa-check" style="position: relative; margin-top: 4px; margin-right: 10px;"></i> Automatycznie zapisano kopię roboczą</div>';
							 }
						 });

				return false;
			}
		}
		<?php } else { ?>
		function autokopia_zapasowa(){}
		<?php } ?>
		
		$( document ).ready(function() {refreshNotifs();autokopia_zapasowa();});
		}
		</script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v3.2&appId=251127598903778"></script>
    <div class="modal fade " id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" accept-charset="utf-8" class="login-form" id="login-popup-form" action="login">
                    <div class="modal-header">
                        <h5 class="modal-title" id="login-modalLabel">Zaloguj się do serwisu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group email">
                                    <label for="login-popup-email">Adres email:</label>
                                    <input type="email" class="form-control " name="email" id="login-popup-email" />
                                </div>
                                <div class="form-group password required">
                                    <label for="login-popup-password">Hasło:</label>
                                    <input type="password" class="form-control " name="pass" id="login-popup-password" data-submit="true" required="required" />
                                </div><a class="forget-link" id="login-popup-forget-link" href="passForgot">Nie pamiętasz hasła?</a></div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-6" style="margin-top: 7px;"><a class="btn btn-outline-info btn-block" href="register">Rejestracja</a></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-primary" name="login">Zaloguj</button>
                    </div>
                </form>
            </div>
        </div>
    </div>