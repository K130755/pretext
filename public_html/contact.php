<?php include("inc/head.php"); ?>

<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/top.php"); ?>
		<?php
		$q = mysqli_query($connect,"SELECT * FROM `contact` ORDER BY `id` DESC LIMIT 1");
		$s = mysqli_fetch_array($q);
			$email = $s['email'];
			$telefon = $s['telefon'];
			$dane_firmy = $s['dane_firmy'];
		?>
												<div class="container page">
														<div class="row">
																<div class="col-12">
																		<!--HTML BLOCK START-->
																		<div class="row">
																				<div class="col-12 col-md-4">
																						<div class="special-head">Dane firmy</div>
																						<div><?=nl2br($dane_firmy);?></div>
																				</div>
																				<div class="col-12 col-md-4">
																						<div class="special-head">Dane kontaktowe</div>
																						<div><i class="fa fa-envelope"></i> <?=$email;?></div>
																						<div></div>
																				</div>
																				<div class="col-12 col-md-4">
																						<div class="special-head">Dane kontaktowe</div>
																						<div><i class="fa fa-mobile"></i> <?=$telefon;?></div>
																				</div>
																		</div>
																		<!--HTML BLOCK END-->
																		<div class="row m-t-20">
																				<div class="col-12">
																						<div class="special-head">Formularz kontaktowy</div>
																				</div>
																		</div>
																		<?php
																		$tryPost = trim(addslashes(strip_tags($_POST['try'])));
																		$imiePost = trim(addslashes(strip_tags($_POST['imie'])));
																		$nazwiskoPost = trim(addslashes(strip_tags($_POST['nazwisko'])));
																		$emailPost = trim(addslashes(strip_tags($_POST['email'])));
																		$telefonPost = trim(addslashes(strip_tags($_POST['telefon'])));
																		$trescPost = trim(addslashes(strip_tags($_POST['tresc'])));
																		if(!empty($tryPost) AND $tryPost == "1"){
																			//--------------------------------------
																			$mail->Subject = "Pretext - Formularz kontaktowy";//temat maila
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
																			$text_body .= "<B>Witaj</B>";
																			$text_body .= "<BR><BR>Poniżej przesyłamy wiadomość przesłaną z formularza kontaktowego Pretext<BR>---------------------<BR>
																											<B>Imię:</B> $imiePost<BR>
																											<B>Nazwisko:</B> $nazwiskoPost<BR>
																											<B>Telefon:</B> $telefonPost<BR>
																											<B>Adres e-mail:</B> $emailPost<BR><BR>$trescPost";
																			$text_body .= "</div><div style='clear: both; height: 4px;'></div><div style='float: right; color: #fff; font-family: Arial; padding-top: 5px;'>Pretext</div><div style='clear: both; height: 4px;'></div></div></body></html>";

																			$mail->Body = $text_body;
																			// adresatów dodajemy poprzez metode 'AddAddress'
																			$mail->AddAddress($email,"Pretext");

																			if(!$mail->Send()) echo $mail->ErrorInfo;
																			// Clear all addresses and attachments
																			$mail->ClearAddresses();
																			$mail->ClearAttachments();
																			//--------------------------------------
																			correctFIXED("Wiadomość została wysłana!");
																		}
																		?>
																		<form method="post" accept-charset="utf-8" class="kontakt-form" action="">
																				<div class="row justify-content-end align-items-end">
																						<div class="col-12 col-lg-9">
																								<div class="row">
																										<div class="col-12 col-md-6 col-lg-3">
																												<div class="form-group">
																														<label>Imię:</label>
																														<input value="" class="form-control" required="required" type="text" name="imie" />
																												</div>
																										</div>
																										<div class="col-12 col-md-6 col-lg-3">
																												<div class="form-group">
																														<label>Nazwisko:</label>
																														<input value="" class="form-control" type="text" name="nazwisko" />
																												</div>
																										</div>
																										<div class="col-12 col-md-6 col-lg-3">
																												<div class="form-group">
																														<label>Telefon:</label>
																														<input value="" class="form-control" type="text" name="telefon" />
																												</div>
																										</div>
																										<div class="col-12 col-md-6 col-lg-3">
																												<div class="form-group">
																														<label>Adres e-mail:</label>
																														<input value="" class="form-control" required="required" type="email" name="email" />
																												</div>
																										</div>
																								</div>
																								<div class="row m-t-15">
																										<div class="col-12 form-mb-0">
																												<div class="form-group">
																														<label>Wiadomość:</label>
																														<textarea rows="10" class="form-control" required="required" name="tresc"></textarea>
																												</div>
																										</div>
																								</div>
																								<div class="row align-content-center align-items-center">
																										<div class="col-12 col-md-12 text-right captcha-container"></div>
																								</div>
																						</div>
																						<div class="col-12 col-lg-3">
																								<button type="submit" class="btn btn-primary">Wyślij<i class="fa fa-angle-right" style="margin-left: 15px;"></i></button>
																						</div>
																				</div>
																				<input type="hidden" name="try" value="1">
																		</form>
																</div>
														</div>
												</div>
                    
    <?php include("inc/footer.php"); ?>
</body>
</html>