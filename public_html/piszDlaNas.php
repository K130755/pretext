<?php include("inc/head.php"); ?>

<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/top.php"); ?>
    <div class="container page">
        <div class="row">
            <div class="col-12">
                <!--HTML BLOCK START-->
                <h1 class="special-head">Pisz dla nas!</h1>
                <?php
								$q = mysqli_query($connect,"SELECT * FROM `pisz_dla_nas` ORDER BY `id` DESC LIMIT 1");
								$s = mysqli_fetch_array($q);
								echo $s['tresc'];
								?>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>