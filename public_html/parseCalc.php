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
                                <div class="special-head">Przetwarzanie danych z kalkulatora</div>
                            </div>
                        </div>
												<?php
												if(empty($_SESSION['user_id'])){header("Location: login");exit;}
												//==============================================
												$rodzaj = trim(addslashes(strip_tags($_POST['rodzaj'])));
												$typ_tekstu = trim(addslashes(strip_tags($_POST['typ_tekstu'])));
												$kategoria = trim(addslashes(strip_tags($_POST['kategoria'])));
												$ilosc_znakow = trim(addslashes(strip_tags($_POST['ilosc_znakow'])));
												$cena = trim(addslashes(strip_tags($_POST['cena'])));
													$cena = str_replace(",","",$cena);
												$cena_typ = trim(addslashes(strip_tags($_POST['cena_typ'])));
													if($cena_typ == "min"){
														$cena = "4";
													}
													if($cena_typ == "max"){
														$cena = "25";
													}
												if($moj_typ == "zleceniodawca"){
													//--------------------------------------------
													header("Location: postTekst-$rodzaj-$typ_tekstu-$kategoria-$ilosc_znakow-$cena");
													//--------------------------------------------
												} else {
													header("Location: index?error=Nowe zlecenia mogą dodawać tylko zleceniodawcy!");
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