<?php include("inc/head.php"); ?>

<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/top.php"); ?>
    <div class="container page">
        <div class="row">
            <div class="col-12">
                <!--HTML BLOCK START-->
                <h1 class="special-head">Poproś o czas</h1>
                <?php
								$id = trim(addslashes(strip_tags($_GET['id'])));
								
								$q = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $id AND `wykonawca_id` = ".$_SESSION['user_id']);
								$n = mysqli_num_rows($q);
								if($n > 0){
									$s = mysqli_fetch_array($q);
									$user_id = $s['user_id'];
									$tytul = $s['tytul'];
									//====================================================
									$tryPost = trim(addslashes(strip_tags($_POST['try'])));
									$dataPost = trim(addslashes(strip_tags($_POST['data'])));
									//----------------------------------------------------
									if(!empty($tryPost) AND $tryPost == "1"){
										postNotif($user_id,"Prośba o więcej czasu","Użytkownik <B>$moj_nick</B> prosi o więcej czasu na realizację zlecenia <a href='https://pretext.eu/edytujZlecenie-$id'><B>$tytul</B></a>.<BR>Aby przedłużyć czas na realizację do <B>$dataPost</B>, kliknij w poniższy link.<BR><BR><a href='https://pretext.eu/giveTime-$id-".strtotime($dataPost)."'>https://pretext.eu/giveTime-$id-".strtotime($dataPost)."</a>");
										header("Location: joinOffer-$id&correct=Prośba o dodatkowy czas została wysłana!");exit;
									}
									//====================================================
								} else {header("Location: mojeZlecenia");exit;}
								?>
								<CENTER>
								<form action="" method="post">
									<h5>Do kiedy chcesz wydłużyć czas realizacji?</h5>
									<input type='text' name='data' style='width: 200px; font-weight: bold; text-align: center;' class='form form-control' placeholder='RRRR-MM-DD GG:MM' pattern='^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}$' required>
									<div style="height: 10px;"></div>
									<input type="hidden" name="try" value="1">
									<input type="submit" class="btn btn-primary" value="Wyślij zapytanie">
								</form>
								</CENTER>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>