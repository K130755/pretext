<?php include("inc/head.php"); ?>

<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/top.php"); ?>
    <div class="container page">
        <div class="row">
            <div class="col-12">
                <!--HTML BLOCK START-->
                <h1 class="special-head">Usuwanie konta</h1>
                <?php
								if(empty($_SESSION['user_id'])){header("Location: login");exit;}
								//======================================================
								$pass = trim(addslashes(strip_tags($_POST['pass'])));
								$pass = sha1(md5($pass));
								$nZlecenia = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `closed` != '1' AND `user_id` = ".$_SESSION['user_id']));
								$nRealizacje = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `wykonawca_id` = ".$_SESSION['user_id']." AND `closed` != '1'"));
								if($nZlecenia == 0){
									if($nRealizacje == 0){
										if($moj_wallet == 0){
											$nPass = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `users` WHERE `password` = '$pass' AND `id` = ".$_SESSION['user_id']));
											if($nPass > 0){
												//==================================================
												mysqli_query($connect,"DELETE FROM `zlecenia` WHERE `user_id` = ".$_SESSION['user_id']);
												mysqli_query($connect,"DELETE FROM `realizacje` WHERE `wykonawca_id` = ".$_SESSION['user_id']);
												mysqli_query($connect,"DELETE FROM `favourites` WHERE `user_id` = ".$_SESSION['user_id']);
												mysqli_query($connect,"DELETE FROM `favourites` WHERE `lubiany` = ".$_SESSION['user_id']);
												mysqli_query($connect,"DELETE FROM `users` WHERE `id` = ".$_SESSION['user_id']);
												header("Location: logout");
												//==================================================
											} else {header("Location: dashboard?error=Hasło jest nieprawidłowe!");}
										} else {header("Location: dashboard?error=Musisz wypłacić wszystkie środki przed usunięciem konta!");}
									} else {header("Location: dashboard?error=Masz niezamknięte realizacje!");}
								} else {header("Location: dashboard?error=Masz niezamknięte zlecenia!");}
								?>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>