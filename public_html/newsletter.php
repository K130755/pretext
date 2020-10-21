<?php include("inc/head.php"); ?>

<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/top.php"); ?>
    <div class="container page">
        <div class="row">
            <div class="col-12">
                <!--HTML BLOCK START-->
                <h1 class="special-head">Newsletter</h1>
                <?php
								$email = trim(addslashes(strip_tags($_POST['email'])));
								if(!empty($email)){
									$q = mysqli_query($connect,"SELECT * FROM `newsletter` WHERE `email` = '$email'");
									$n = mysqli_num_rows($q);
									if($n == 0){
										mysqli_query($connect,"INSERT INTO `newsletter` (`email`) VALUES ('$email')");
										header("Location: index?correct=Adres e-mail został dodany!");
									} else {header("Location: index?error=Ten adres e-mail jest już na liście newslettera!");}
								} else {header("Location: index?error=Nie podałeś adres e-mail!");}
								?>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>