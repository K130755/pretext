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
												$cena_od = trim(addslashes(strip_tags($_POST['cena_od'])));
												$cena_do = trim(addslashes(strip_tags($_POST['cena_do'])));
												$dlugosc_tekstu = trim(addslashes(strip_tags($_POST['dlugosc_tekstu']))); // 500 | 1000 | 5000  | 500+ | 1000+ | 5000+
												$limit = trim(addslashes(strip_tags($_POST['limit'])));
												$sortowanie = trim(addslashes(strip_tags($_POST['sortowanie']))); //najstarsze | najnowsze
												$back = trim(addslashes(strip_tags($_POST['from'])));
												
												$typ_tekstu_opisPost = trim(addslashes(strip_tags($_POST['typ_tekstu_opis'])));
												$typ_tekstu_tekst_preclowyPost = trim(addslashes(strip_tags($_POST['typ_tekstu_tekst_preclowy'])));
												$typ_tekstu_tekst_synonimicznyPost = trim(addslashes(strip_tags($_POST['typ_tekstu_tekst_synonimiczny'])));
												$typ_tekstu_tekst_zapleczowyPost = trim(addslashes(strip_tags($_POST['typ_tekstu_tekst_zapleczowy'])));
												$typ_tekstu_recenzjaPost = trim(addslashes(strip_tags($_POST['typ_tekstu_recenzja'])));
												$typ_tekstu_tekst_marketingowyPost = trim(addslashes(strip_tags($_POST['typ_tekstu_tekst_marketingowy'])));
												$typ_tekstu_artykuly_spec_i_naukPost = trim(addslashes(strip_tags($_POST['typ_tekstu_artykuly_spec_i_nauk'])));
												$typ_tekstu_prace_naukowePost = trim(addslashes(strip_tags($_POST['typ_tekstu_prace_naukowe'])));
												$typ_tekstu_korektaPost = trim(addslashes(strip_tags($_POST['typ_tekstu_korekta'])));
												$typ_tekstu_innePost = trim(addslashes(strip_tags($_POST['typ_tekstu_inne'])));
												//-----------------------
												$kategoria_bizes_i_prawoPost = trim(addslashes(strip_tags($_POST['kategoria_bizes_i_prawo'])));
												$kategoria_budownictwo_nieruchomosciPost = trim(addslashes(strip_tags($_POST['kategoria_budownictwo_nieruchomosci'])));
												$kategoria_ecommercePost = trim(addslashes(strip_tags($_POST['kategoria_ecommerce'])));
												$kategoria_edukacjaPost = trim(addslashes(strip_tags($_POST['kategoria_edukacja'])));
												$kategoria_erotykaPost = trim(addslashes(strip_tags($_POST['kategoria_erotyka'])));
												$kategoria_informacje_publicystykaPost = trim(addslashes(strip_tags($_POST['kategoria_informacje_publicystyka'])));
												$kategoria_kultura_rozrywkaPost = trim(addslashes(strip_tags($_POST['kategoria_kultura_rozrywka'])));
												$kategoria_motoryzacjaPost = trim(addslashes(strip_tags($_POST['kategoria_motoryzacja'])));
												$kategoria_modaPost = trim(addslashes(strip_tags($_POST['kategoria_moda'])));
												$kategoria_technologiePost = trim(addslashes(strip_tags($_POST['kategoria_technologie'])));
												$kategoria_sportPost = trim(addslashes(strip_tags($_POST['kategoria_sport'])));
												$kategoria_styl_zyciaPost = trim(addslashes(strip_tags($_POST['kategoria_styl_zycia'])));
												$kategoria_turystyka_gastroPost = trim(addslashes(strip_tags($_POST['kategoria_turystyka_gastro'])));
												$kategoria_zdrowie_medycynaPost = trim(addslashes(strip_tags($_POST['kategoria_zdrowie_medycyna'])));
												$kategoria_innePost = trim(addslashes(strip_tags($_POST['kategoria_inne'])));
												//-----------------------
												$filtry = "";
												if(!empty($typ_tekstu_opisPost)){$filtry .= ",".$typ_tekstu_opisPost;}
												if(!empty($typ_tekstu_tekst_preclowyPost)){$filtry .= ",".$typ_tekstu_tekst_preclowyPost;}
												if(!empty($typ_tekstu_tekst_synonimicznyPost)){$filtry .= ",".$typ_tekstu_tekst_synonimicznyPost;}
												if(!empty($typ_tekstu_tekst_zapleczowyPost)){$filtry .= ",".$typ_tekstu_tekst_zapleczowyPost;}
												if(!empty($typ_tekstu_recenzjaPost)){$filtry .= ",".$typ_tekstu_recenzjaPost;}
												if(!empty($typ_tekstu_tekst_marketingowyPost)){$filtry .= ",".$typ_tekstu_tekst_marketingowyPost;}
												if(!empty($typ_tekstu_artykuly_spec_i_naukPost)){$filtry .= ",".$typ_tekstu_artykuly_spec_i_naukPost;}
												if(!empty($typ_tekstu_prace_naukowePost)){$filtry .= ",".$typ_tekstu_prace_naukowePost;}
												if(!empty($typ_tekstu_korektaPost)){$filtry .= ",".$typ_tekstu_korektaPost;}
												if(!empty($typ_tekstu_innePost)){$filtry .= ",".$typ_tekstu_innePost;}
												//---
												if(!empty($kategoria_bizes_i_prawoPost)){$filtry .= ",".$kategoria_bizes_i_prawoPost;}
												if(!empty($kategoria_budownictwo_nieruchomosciPost)){$filtry .= ",".$kategoria_budownictwo_nieruchomosciPost;}
												if(!empty($kategoria_ecommercePost)){$filtry .= ",".$kategoria_ecommercePost;}
												if(!empty($kategoria_edukacjaPost)){$filtry .= ",".$kategoria_edukacjaPost;}
												if(!empty($kategoria_erotykaPost)){$filtry .= ",".$kategoria_erotykaPost;}
												if(!empty($kategoria_informacje_publicystykaPost)){$filtry .= ",".$kategoria_informacje_publicystykaPost;}
												if(!empty($kategoria_kultura_rozrywkaPost)){$filtry .= ",".$kategoria_kultura_rozrywkaPost;}
												if(!empty($kategoria_motoryzacjaPost)){$filtry .= ",".$kategoria_motoryzacjaPost;}
												if(!empty($kategoria_modaPost)){$filtry .= ",".$kategoria_modaPost;}
												if(!empty($kategoria_technologiePost)){$filtry .= ",".$kategoria_technologiePost;}
												if(!empty($kategoria_sportPost)){$filtry .= ",".$kategoria_sportPost;}
												if(!empty($kategoria_styl_zyciaPost)){$filtry .= ",".$kategoria_styl_zyciaPost;}
												if(!empty($kategoria_turystyka_gastroPost)){$filtry .= ",".$kategoria_turystyka_gastroPost;}
												if(!empty($kategoria_zdrowie_medycynaPost)){$filtry .= ",".$kategoria_zdrowie_medycynaPost;}
												if(!empty($kategoria_innePost)){$filtry .= ",".$kategoria_innePost;}
												//----------------------------------------------
												mysqli_query($connect,"DELETE FROM `filtry` WHERE `user_id` = ".$_SESSION['user_id']);
												mysqli_query($connect,"INSERT INTO `filtry` (`user_id`,`tresc`,`cena_od`,`cena_do`,`dlugosc_tekstu`,`limit`,`sortowanie`) VALUES ('".$_SESSION['user_id']."','$filtry','$cena_od','$cena_do','$dlugosc_tekstu','$limit','$sortowanie')");
												//----------------------------------------------
												if($back == "nowy"){
													header("Location: zleceniaTekst");
												} else {
													header("Location: zleceniaKorekta");
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