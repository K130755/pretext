<?php include("inc/head.php"); ?>

<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/top.php"); ?>
    <div class="container page">
        <div class="row">
            <div class="col-12">
                <!--HTML BLOCK START-->
                <h1 class="special-head">Wersja robocza - zapis</h1>
                <?php
								if(empty($_SESSION['user_id'])){header("Location: login");exit;}
								$id = trim(addslashes(strip_tags($_GET['id'])));
								$tresc = trim(addslashes($_POST['tresc']));
								mysqli_query($connect,"DELETE FROM `wersje_robocze` WHERE `zlecenie_id` = $id AND `wykonawca_id` = ".$_SESSION['user_id']);
								mysqli_query($connect,"INSERT INTO `wersje_robocze` (`zlecenie_id`,`wykonawca_id`,`tresc`) VALUES ('$id','".$_SESSION['user_id']."','$tresc')");
								header("Location: joinOffer-$id&correct=Zapisano wersję roboczą");
								?>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>