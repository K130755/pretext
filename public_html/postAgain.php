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
                                <div class="special-head">Wystaw zlecenie ponownie</div>
                            </div>
                        </div>
												<?php
												$id = trim(addslashes(strip_tags($_GET['id'])));
												$q = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $id AND `user_id` = ".$_SESSION['user_id']);
												$n = mysqli_num_rows($q);
												if($n > 0){
												$s = mysqli_fetch_array($q);
												$tytul = $s['tytul'];
												$wykonawca_id0 = $s['wykonawca_id'];
												
													$q2 = mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `wykonawca_id` = $wykonawca_id0 AND `zlecenie_id` = $id AND `canceled` != '1'");
													$s2 = mysqli_fetch_array($q2);
														$wykonawca_id2 = $s2['wykonawca_id'];
														postNotif($wykonawca_id2,"Odrzucono Twoją realizację","Twoja realizacja tekstu została odrzucona przez użytkownika <B>$moj_nick</B>.<BR>Zlecenie powróciło do otwartej puli dla pozostałych wykonawców.");
													mysqli_query($connect,"UPDATE `realizacje` SET `canceled` = '1' WHERE `wykonawca_id` = $wykonawca_id0 AND `zlecenie_id` = $id");
													mysqli_query($connect,"UPDATE `zlecenia` SET `wykonawca_id` = '0' WHERE `id` = $id");
													mysqli_query($connect,"DELETE FROM `kolejka` WHERE `zlecenie_id` = $id AND `user_id` = $wykonawca_id2");
													//--------------------------------------------
													$qKolejka = mysqli_query($connect,"SELECT * FROM `kolejka` WHERE `zlecenie_id` = $id");
													$nKolejka = mysqli_num_rows($qKolejka);
													if($nKolejka > 0){
														while($sKolejka = mysqli_fetch_array($qKolejka)){
															$user_idKolejka = $sKolejka['user_id'];
															//------------------------------------------
															postNotif($user_idKolejka,"Zwolniła się kolejka!","Informujemy, że do zlecenia <a href='https://pretext.eu/joinOffer-$id'>$tytul</a> zwolniło się miejsce w kolejce.<BR>Przejdź do zlecenia jak najszybciej, aby wziąć udział w jego realizacji, zanim ktoś Cię wyprzedzi!");
															//------------------------------------------
														}
													}
													//--------------------------------------------
													header("Location: mojeZlecenia?correct=Zlecenie zostało ponownie wystawione do realizacji!");
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