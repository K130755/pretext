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
                                <div class="special-head">Stosowanie filtrów</div>
                            </div>
                        </div>
												<?php
												if(empty($_SESSION['user_id'])){header("Location: login");exit;}
												
												$nazwa = trim(addslashes(strip_tags($_GET['nazwa'])));
												if(!empty($nazwa)){
													if($nazwa == "Ecommerce"){
														$nazwa = "E-commerce";
													}
												$nazwa = ",".$nazwa;
												//----------------------------------------------
												mysqli_query($connect,"DELETE FROM `filtry` WHERE `user_id` = ".$_SESSION['user_id']);
												mysqli_query($connect,"INSERT INTO `filtry` (`user_id`,`tresc`,`cena_od`,`cena_do`,`dlugosc_tekstu`,`limit`,`sortowanie`) VALUES ('".$_SESSION['user_id']."','$nazwa','','','','','')");
												//----------------------------------------------
												}
												header("Location: zleceniaTekst");
												?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>