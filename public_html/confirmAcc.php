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
                                <div class="special-head">Aktywacja konta</div>
                            </div>
                        </div>
                        <?php
												$hash = trim(addslashes(strip_tags($_GET['hash'])));
												$q = mysqli_query($connect,"SELECT * FROM `users` WHERE `hash` = '$hash'");
												$n = mysqli_num_rows($q);
												if($n > 0){
													mysqli_query($connect,"UPDATE `users` SET `active` = '1' WHERE `hash` = '$hash'");
													header("Location: login?correct=Twoje konto zostało aktywowane!");
												} else {header("Location: login?error=Nieprawidłowy link aktywacyjny!");}
												?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>