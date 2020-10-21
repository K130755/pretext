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
                                <div class="special-head">Edytuj swoją pracę w Portfolio</div>
                            </div>
                        </div>
                        <?php
												if(empty($_SESSION['user_id'])){header("Location: login");}
												$id = trim(addslashes(strip_tags($_GET['id'])));
												//---------------
												$tryPost = trim(addslashes(strip_tags($_POST['try'])));
												$tytulPost = trim(addslashes(strip_tags($_POST['tytul'])));
												$trescPost = trim(addslashes(strip_tags($_POST['tresc'])));
												
												if(!empty($tryPost) AND $tryPost == "1"){
													mysqli_query($connect,"UPDATE `portfolio` SET `tytul` = '$tytulPost' WHERE `id` = $id AND `user_id` = ".$_SESSION['user_id']);
													mysqli_query($connect,"UPDATE `portfolio` SET `tresc` = '$trescPost' WHERE `id` = $id AND `user_id` = ".$_SESSION['user_id']);
													header("Location: dashboard?correct=Zmiany zostały zapisane!");
												} else {
												//---------------
													$q = mysqli_query($connect,"SELECT * FROM `portfolio` WHERE `id` = $id AND `user_id` = ".$_SESSION['user_id']);
													$n = mysqli_num_rows($q);
													if($n > 0){
														$s = mysqli_fetch_array($q);
														$tytul = $s['tytul'];
														$tresc = $s['tresc'];
														echo "
														<form action='' method='post'>
															<input type='text' name='tytul' class='form form-control' value='$tytul' style='padding: 10px;' placeholder='Tytuł Twojej pracy' required>
															<div style='height: 10px;'></div>
															<textarea class='form form-control' style='width: 100%; height: 185px; padding: 10px;' placeholder='Treść pracy' name='tresc' required>$tresc</textarea>
															<div style='height: 10px;'></div>
															<input type='hidden' name='try' value='1'>
															<div style='text-align: right;'><input type='submit' class='btn btn-success' value='Zapisz zmiany'></div>
														</form>
														";
													} else {header("Location: dashboard?error=Nieprawidłowy adres URL!");}
												}
												?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>