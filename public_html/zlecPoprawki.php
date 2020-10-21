<?php include("inc/head.php"); ?>

<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/top.php"); ?>
    <div class="container page">
        <div class="row">
            <div class="col-12">
                <!--HTML BLOCK START-->
                <h1 class="special-head">Oddaj zlecenie do poprawek</h1>
                <?php
								$id = trim(addslashes(strip_tags($_GET['id'])));
								$wykonawca_id = trim(addslashes(strip_tags($_GET['wykonawca'])));
								//======================================================
								$q = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $id AND `user_id` = ".$_SESSION['user_id']);
								$n = mysqli_num_rows($q);
								if($n > 0){
									$s = mysqli_fetch_array($q);
									$tytul = $s['tytul'];
									//---
									$q2 = mysqli_query($connect,"SELECT * FROM `kolejka` WHERE `zlecenie_id` = $id AND `user_id` = $wykonawca_id");
									$s2 = mysqli_fetch_array($q2);
									$data_stop2 = $s2['data_stop'];
									//----------------------------------------------------
									$tryPost = trim(addslashes(strip_tags($_POST['try'])));
									$trescPost = trim(addslashes(strip_tags($_POST['tresc'])));
									$dataPost = trim(addslashes(strip_tags($_POST['data'])));
									if(!empty($tryPost) AND $tryPost == "1"){
										mysqli_query($connect,"INSERT INTO `uwagi_dla_wykonawcy` (`zlecenie_id`,`wykonawca_id`,`tresc`) VALUES ('$id','$wykonawca_id','$trescPost')");
										mysqli_query($connect,"UPDATE `kolejka` SET `data_stop` = '$dataPost' WHERE `zlecenie_id` = '$id' AND `user_id` = '$wykonawca_id'");
										postNotif($wykonawca_id,"Nowe uwagi do Twojego zlecenia","Użytkownik <B>$moj_nick</B> wysłał Ci kilka uwag do Twojej realizacji przy zleceniu <a href='https://pretext.eu/joinOffer-$id'><B>$tytul</B></a>.");
										header("Location: edytujZlecenie-$id&correct=Wysłano uwagi do wykonawcy");exit;
									}
									//----------------------------------------------------
									echo "
									<div class='container'>
									<form action='' method='post'>
										<B>Uwagi dla wykonawcy:</B>
										<textarea class='form form-control' style='height: 150px;' name='tresc'></textarea>
										<div style='height: 15px;'></div>
										<div class='row'>
											<div class='col-md-3' style='margin-bottom: 7px;'>
												<B>Zmień termin realizacji:</B><BR>
												<input type='text' name='data' class='form form-control' placeholder='RRRR-MM-DD GG:MM' value='$data_stop2' pattern='^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}$' required>
											</div>
										</div>
										<div style='height: 15px;'></div>
										<div style='text-align: right;'>
											<input type='hidden' name='try' value='1'>
											<input type='submit' class='btn btn-primary' value='Wyślij uwagi'>
										</div>
									</form>
									</div>
									";
								} else {header("Location: mojeZlecenia");}
								?>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>