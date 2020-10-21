<?php include("inc/head.php"); ?>

<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/top.php"); ?>
    <div class="container page">
        <div class="row">
            <div class="col-12">
                <!--HTML BLOCK START-->
                <h1 class="special-head">Anulowanie zlecenia</h1>
                <?php
								$id = trim(addslashes(strip_tags($_POST['id'])));
								$q = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $id AND `user_id` = ".$_SESSION['user_id']);
								$n = mysqli_num_rows($q);
								if($n > 0){
									$s = mysqli_fetch_array($q);
									//-------------------------
									$dlugosc_od = $s['dlugosc_od'];
									$dlugosc_do = $s['dlugosc_do'];
									$cena = $s['cena'];
									
									if($dlugosc_od == $dlugosc_do OR empty($dlugosc_do) OR $dlugosc_do == "0"){
										$dlugoscProwizja = $dlugosc_od;
									} else {
										$dlugoscProwizja = $dlugosc_do;
									}
									$iloscProwizja = $dlugoscProwizja / 1000;
									$zwrot = $iloscProwizja * $cena;
									//-------------------------
									$q2 = mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `zlecenie_id` = $id AND `canceled` != '1'");
									$n2 = mysqli_num_rows($q2);
									if($n2 > 0 AND $s['typ'] == 'nowy'){
										$dlaWykonawcy = $cena * ($dlugosc_od / 1000);
										$s2 = mysqli_fetch_array($q2);
										$wykonawca2 = $s2['wykonawca_id'];
										$q3 = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $wykonawca2");
										$s3 = mysqli_fetch_array($q3);
										$wallet3 = $s3['wallet'];
										$newWallet3 = $wallet3 + $dlaWykonawcy;
										mysqli_query($connect,"UPDATE `users` SET `wallet` = '$newWallet3' WHERE `id` = $wykonawca2");
										$zwrot = $zwrot - $dlaWykonawcy;
									}
									$myNewWallet = $moj_wallet + $zwrot;
									mysqli_query($connect,"UPDATE `users` SET `wallet` = '$myNewWallet' WHERE `id` = ".$_SESSION['user_id']);
									mysqli_query($connect,"DELETE FROM `realizacje` WHERE `zlecenie_id` = $id");
									mysqli_query($connect,"DELETE FROM `zlecenia` WHERE `id` = $id");
									mysqli_query($connect,"DELETE FROM `kolejka` WHERE `zlecenie_id` = $id");
									header("Location: mojeZlecenia?correct=Zlecenie zostało anulowane!");
								} else {header("Location: mojeZlecenia");}
								?>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>