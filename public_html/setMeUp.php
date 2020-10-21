<?php include("inc/head.php"); ?>

<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/top.php"); ?>
    <div class="container page">
        <div class="row">
            <div class="col-12">
                <!--HTML BLOCK START-->
                <h1 class="special-head">Dołącz do kolejki</h1>
                <?php
								$id = trim(addslashes(strip_tags($_GET['id'])));
								
								$qCheckKolejka = mysqli_query($connect,"SELECT * FROM `kolejka` WHERE `zlecenie_id` = $id ORDER BY `id` ASC");
								$nCheckKolejka = mysqli_num_rows($qCheckKolejka);
								if($nCheckKolejka == 0){
									header("Location: joinOffer-$id");exit;
								} else {
									if($nCheckKolejka < 5){
										$nCheckKolejka2 = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `kolejka` WHERE `zlecenie_id` = $id AND `user_id` = ".$_SESSION['user_id']));
										if($nCheckKolejka2 == 0){
											mysqli_query($connect,"INSERT INTO `kolejka` (`zlecenie_id`,`user_id`,`data`,`data_stop`) VALUES ('$id','".$_SESSION['user_id']."','','')");
											header("Location: zleceniaTekst?correct=Dołączyłeś do kolejki");exit;
										} else {
											header("Location: zleceniaTekst?error=Jesteś już w kolejce do tego zlecenia");exit;
										}
									} else {
										header("Location: zleceniaTekst?error=Niestety nie mamy już wolnych miejsc dla tego zlecenia");exit;
									}
								}
								?>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>