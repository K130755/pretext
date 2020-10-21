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
                                <div class="special-head">Resetowanie hasła</div>
                            </div>
                        </div>
												<?php
												$hash = trim(addslashes(strip_tags($_GET['hash'])));
												$pass = trim(addslashes(strip_tags($_GET['pass'])));
												$q = mysqli_query($connect,"SELECT * FROM `users` WHERE `hash` = '$hash'");
												$n = mysqli_num_rows($q);
												if($n > 0){
													mysqli_query($connect,"UPDATE `users` SET `password` = '$pass' WHERE `hash` = '$hash'");
													header("Location: login?correct=Twoje hasło zostało zmienione!");
												} else {header("Location: login?error=Nieprawidłowy link potwierdzający!");}
												?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>