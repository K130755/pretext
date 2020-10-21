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
                                <div class="special-head">Akceptacja korekty próbnej</div>
                            </div>
                        </div>
												<?php
												$id = trim(addslashes(strip_tags($_GET['id'])));
												$wykonawca = trim(addslashes(strip_tags($_GET['wykonawca'])));
												$q = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $id AND `user_id` = ".$_SESSION['user_id']);
												$n = mysqli_num_rows($q);
												if($n > 0){
													$s = mysqli_fetch_array($q);
													$tytul = $s['tytul'];
													
													if(!empty($wykonawca)){
														mysqli_query($connect,"UPDATE `realizacje` SET `korekta_probna_zatwierdzona` = '1' WHERE `zlecenie_id` = $id AND `wykonawca_id` = $wykonawca");
														mysqli_query($connect,"UPDATE `realizacje` SET `canceled` = '1' WHERE `zlecenie_id` = $id AND `wykonawca_id` != $wykonawca");
														mysqli_query($connect,"UPDATE `zlecenia` SET `wykonawca_id` = $wykonawca WHERE `id` = $id");
														postNotif($wykonawca,"Zaakceptowano korektę próbną!","Zaakceptowano Twoją korektę próbną do zlecenia <a href='https://pretext.eu/joinOffer-$id'><B>$tytul</B></a>.<BR>Przejdź do zlecenia i rozpocznij korektę właściwą!");
													}
													header("Location: edytujZlecenie-$id");
												} else {header("Location: mojeZlecenia");}
												?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>