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
                                <div class="special-head">Dodaj do ulubionych</div>
                            </div>
                        </div>
												<?php
												if(empty($_SESSION['user_id'])){header("Location: login");}
												$id = trim(addslashes(strip_tags($_GET['id'])));
												
												$q = mysqli_query($connect,"SELECT * FROM `favourites` WHERE `lubiany` = '$id' AND `user_id` = ".$_SESSION['user_id']);
												$n = mysqli_num_rows($q);
												if($n == 0){
													mysqli_query($connect,"INSERT INTO `favourites` (`user_id`,`lubiany`) VALUES ('".$_SESSION['user_id']."','$id')");
													header("Location: user-$id&correct=Użytkownik został dodany do Twojej listy ulubionych!");
												} else {header("Location: user-$id&error=Użytkownik jest już na liście ulubionych!");}
												?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>