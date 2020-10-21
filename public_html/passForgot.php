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
                                <div class="special-head">Resetowanie hasła</div>
                            </div>
                        </div>
												<?php
												$email = trim(addslashes(strip_tags($_POST['email'])));
												$pass = sha1(md5(trim(addslashes(strip_tags($_POST['pass'])))));
												$try = $_POST['try'];
												if(!empty($try) AND $try == "1"){
													$q = mysqli_query($connect,"SELECT * FROM `users` WHERE `email` = '$email'");
													$n = mysqli_num_rows($q);
													if($n > 0){
														$s = mysqli_fetch_array($q);
														$hash = $s['hash'];
														$imie = $s['imie'];
														//------------------------------------------
														$mail->Subject = "Pretext - Reset hasla";//temat maila
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
														$text_body .= "<B>Witaj, $imie</B>";
														$text_body .= "<BR><BR>Otrzymaliśmy Twoją prośbę o reset hasła. Poniżej znajdziesz link potwierdzający. Jeżeli to nie Ty rozpocząłeś proces resetowania hasła, zignoruj tę wiadomość!<BR>---------------------<BR>
														<a href='".MAIN_URL."passReset-$hash-$pass' style='text-decoration: none;'>".MAIN_URL."passReset-$hash-$pass</a>";
														$text_body .= "</div><div style='clear: both; height: 4px;'></div><div style='float: right; color: #fff; font-family: Arial; padding-top: 5px;'>Pretext</div><div style='clear: both; height: 4px;'></div></div></body></html>";

														$mail->Body = $text_body;
														// adresatów dodajemy poprzez metode 'AddAddress'
														$mail->AddAddress($email,"Pretext");

														if(!$mail->Send()) echo $mail->ErrorInfo;
														// Clear all addresses and attachments
														$mail->ClearAddresses();
														$mail->ClearAttachments();
														//------------------------------------------
														header("Location: login?correct=Na Twój adres e-mail wysłaliśmy link potwierdzający zmianę hasła!");
													} else {header("Location: login?error=Konto o podanym adresie nie istnieje!");}
												}
												?>
                        <form action="" method="post">
													<div class="row">
														<div class="col-md-6" style="margin-bottom: 7px;">
															<B>Adres e-mail:</B>
															<input type="email" name='email' class="form form-control" placeholder="Adres e-mail" required>
														</div>
														<div class="col-md-6" style="margin-bottom: 7px;">
															<B>Nowe hasło:</B>
															<input type="password" name='pass' class="form form-control" placeholder="Wprowadź nowe hasło" required>
														</div>
													</div>
													<input type="hidden" name="try" value="1">
													<div style="text-align: right;"><input type="submit" class="btn btn-primary" value="Wyślij link potwierdzający"></div>
												</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>