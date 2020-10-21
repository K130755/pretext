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
								$data = trim(addslashes(strip_tags($_GET['data'])));
								$data = date("Y-m-d H:i",$data);
								
								$q = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $id AND `user_id` = ".$_SESSION['user_id']);
								$n = mysqli_num_rows($q);
								if($n > 0){
									$s = mysqli_fetch_array($q);
									$user_id = $s['wykonawca_id'];
									$tytul = $s['tytul'];
									//----------------------------
									mysqli_query($connect,"UPDATE `kolejka` SET `data_stop` = '$data' WHERE `zlecenie_id` = $id AND `user_id` = $user_id");
									//----------------------------
									postNotif($user_id,"Zatwierdzono prośbę o więcej czasu","Zleceniodawca <B>$moj_nick</B> zaakceptował Twoją prośbę o zmianę czasu potrzebnego na realizację zlecenia <a href='https://pretext.eu/joinOffer-$id'><B>$tytul</B></a>.");
									header("Location: mojeZlecenia?correct=Dodatkowy czas został zatwierdzony!");
								} else {header("Location: mojeZlecenia");exit;}
								?>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>