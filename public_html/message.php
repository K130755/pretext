<?php include("inc/head.php"); ?>

<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/top.php"); ?>
		<?php
		if(empty($_SESSION['user_id'])){header("Location: login");}
		$id = trim(addslashes(strip_tags($_GET['id'])));
		$q = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $id");
		$n = mysqli_num_rows($q);
		if($n > 0){
			$s = mysqli_fetch_array($q);
			$imie = $s['imie']." ".$s['nazwisko'];
		} else {header("Location: inbox");}
		?>
    <div class="container login-container">
        <div class="row">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9 col-lg-8 pd-t-35">
                        <div class="row row-special-head">
                            <div class="col-12">
                                <div class="special-head">Wyślij wiadomość do użytkownika <?=$imie;?></div>
                            </div>
                        </div>
												<?php
												$try = trim(addslashes(strip_tags($_POST['try'])));
												$tytul = trim(addslashes(strip_tags($_POST['tytul'])));
												$tresc = trim(addslashes(strip_tags($_POST['tresc'])));
												if(!empty($try) AND $try == "1"){
													mysqli_query($connect,"INSERT INTO `inbox` (`nadawca`,`odbiorca`,`tytul`,`tresc`,`read`,`data`) VALUES ('".$_SESSION['user_id']."','$id','$tytul','$tresc','0','".date("Y-m-d H:i")."')");
													postNotif($id,"Masz nową wiadomość!","Przejdź do <a href='https://pretext.eu/inbox'>Skrzynki Odbiorczej</a> i sprawdź nowe wiadomości.");
													header("Location: messageSent");
												} else {
												?>
												<form action='' method='post'>
												<B>Tytuł wiadomości:</B>
												<input type="text" name="tytul" class="form form-control" required>
												<div style="height: 10px;"></div>
												<B>Treść wiadomości:</B>
												<textarea name='tresc' class='form form-control' style='height: 170px; padding: 10px;' required></textarea>
												<div style="height: 10px;"></div>
												<div style="text-align: right;">
													<input type="hidden" name="try" value="1">
													<input type="submit" class="btn btn-primary" value="Wyślij wiadomość">
												</div>
												</form>
												<?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>