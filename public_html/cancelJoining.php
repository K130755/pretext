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
                                <div class="special-head">Anuluj realizację</div>
                            </div>
                        </div>
												<?php
												if(empty($_SESSION['user_id'])){header("Location: login");exit;}
												$id = trim(addslashes(strip_tags($_POST['id'])));
												$q = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $id");
												$s = mysqli_fetch_array($q);
												$tytul = $s['tytul'];
												
												mysqli_query($connect,"UPDATE `zlecenia` SET `wykonawca_id` = '0' WHERE `wykonawca_id` = '".$_SESSION['user_id']."' AND `id` = $id");
												mysqli_query($connect,"DELETE FROM `realizacje` WHERE `zlecenie_id` = $id");
												mysqli_query($connect,"DELETE FROM `kolejka` WHERE `zlecenie_id` = $id AND `user_id` = ".$_SESSION['user_id']);
												//----------------------------------------------
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
												//----------------------------------------------
												header("Location: dashboard?correct=Twoje uczestnictwo w realizacji zostało anulowane!");
												?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>