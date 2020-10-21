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
                                <div class="special-head">Dodawanie pracy do Portfolio</div>
                            </div>
                        </div>
                        <?php
												if(empty($_SESSION['user_id'])){header("Location: login");}
												$tytul = trim(addslashes(strip_tags($_POST['tytul'])));
												$tresc = trim(addslashes(strip_tags($_POST['tresc'])));
												if(!empty($tytul)){mysqli_query($connect,"INSERT INTO `portfolio` (`user_id`,`tytul`,`tresc`) VALUES ('".$_SESSION['user_id']."','$tytul','$tresc')");}
												header("Location: dashboard?correct=Twoja praca została pomyślnie dodana!");
												?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>