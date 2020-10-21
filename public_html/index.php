<?php include("inc/head.php"); ?>

<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/top.php"); ?>
    <div class="container-fluid page-home">
        <div class="row">
            <div class="col-12">
                <!--HTML BLOCK START-->
                <div class="hideMeOnTel">
                    <div class="parent-banner home-banner">
                        <div id="banner-1" class="carousel slide banner-container" data-ride="carousel" style="">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active" def-width="1692" def-height="387" style="height: 0; background-image: url('images/5da4eaaabd13c2.65743707.png'); cursor: pointer;" onClick="document.location.href='postTekst';">
                                    <div class="slideElementContainer"><a href="postTekst" class="banner-caption" id="slide-element-1-1" position="absolute" style="left:14.603409933283%;top:19.571865443425%; width:392px; height:33px;font-size:20px;color: #ffffff;text-align: center;text-shadow: 0 0 2px #000;line-height: normal;" target="_self" title=""><span style="display:block;background: #cca74c;padding:5px 10px;"><i class="fas fa-pencil-alt"></i><span style="display:inline-block; margin:0 5px;text-shadow: 0 0 2px #000">Zleć napisanie nowego tekstu</span><i class="far fa-arrow-alt-circle-right"></i></span></a><a href="postKorekta" class="banner-caption" id="slide-element-1-2" position="absolute" style="left:14.381022979985%;top:44.648318042813%; width:394px; height:34px;font-size:20px;color: #ffffff;text-align: center;text-shadow: 0 0 2px #000;line-height: normal;" target="_self" title=""><span style="display:block;background: #cca74c;padding:5px 10px;"><i style="transform: scaleX(-1.5);" class="fas fa-cut"></i><span style="display:inline-block; margin:0 5px 0 15px;text-shadow: 0 0 2px #000">Zleć korektę swojego tekstu</span><i class="far fa-arrow-alt-circle-right"></i></span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--HTML BLOCK END-->
                <!--HTML BLOCK START-->
								<?php
								showRespond($_GET['error'],$_GET['correct']);
								
								$q29 = mysqli_query($connect,"SELECT * FROM `home_stats` ORDER BY `id` DESC LIMIT 1");
								$s29 = mysqli_fetch_array($q29);
									$blok1_line1 = $s29['blok1_line1'];
									$blok1_numbers = $s29['blok1_numbers'];
									$blok1_line2 = $s29['blok1_line2'];
									$blok2_line1 = $s29['blok2_line1'];
									$blok2_numbers = $s29['blok2_numbers'];
									$blok2_line2 = $s29['blok2_line2'];
									$blok3_line1 = $s29['blok3_line1'];
									$blok3_numbers = $s29['blok3_numbers'];
									$blok3_line2 = $s29['blok3_line2'];
									$blok4_line1 = $s29['blok4_line1'];
									$blok4_numbers = $s29['blok4_numbers'];
									$blok4_line2 = $s29['blok4_line2'];
									$blok5_line1 = $s29['blok5_line1'];
									$blok5_numbers = $s29['blok5_numbers'];
									$blok5_line2 = $s29['blok5_line2'];
								?>
                <div class="container">
                    <div class="row m-t-50 m-b-50 justify-content-between">
                        <div class="col-12 col-md-auto">
                            <div class="info-box"><span><?=$blok1_line1;?></span>
                                <div><?=$blok1_numbers;?></div><span><?=$blok1_line2;?></span></div>
                        </div>
                        <div class="col-12 col-md-auto">
                            <div class="info-box"><span><?=$blok2_line1;?></span>
                                <div><?=$blok2_numbers;?></div><span><?=$blok2_line2;?></span></div>
                        </div>
                        <div class="col-12 col-md-auto">
                            <div class="info-box"><span><?=$blok3_line1;?></span>
                                <div><?=$blok3_numbers;?></div><span><?=$blok3_line2;?></span></div>
                        </div>
                        <div class="col-12 col-md-auto">
                            <div class="info-box"><span><?=$blok4_line1;?></span>
                                <div><?=$blok4_numbers;?></div><span><?=$blok4_line2;?></span></div>
                        </div>
                        <div class="col-12 col-md-auto">
                            <div class="info-box"><span><?=$blok5_line1;?></span>
                                <div><?=$blok5_numbers;?></div><span><?=$blok5_line2;?></span></div>
                        </div>
                    </div>
                </div>
                <!--HTML BLOCK END-->
                <!--HTML BLOCK START-->
                <div class="dark-gold-banner">
                    <div class="container">
                        <div class="step-banner">
                            <div class="step-banner-left">
                                <div step="1"><i class="flat flaticon-users"></i>
                                    <div class="banner-item-text right-center">Załóż darmowe konto i doładuj wirtualny portfel.</div>
                                </div>
                                <div step="2"><i class="flat flaticon-contract-4"></i>
                                    <div class="banner-item-text bottom-right">Utwórz zlecenie i podaj swoją cenę.</div>
                                </div>
                                <div step="3"><i class="flat flaticon-pencil"></i>
                                    <div class="banner-item-text top-left">Skorzystaj z opcji korekty próbnej, wybierz ulubionego korektora lub wystaw zlecenie dla wszystkich.</div>
                                </div>
                                <div step="4"><i class="flat flaticon-contract-4"></i>
                                    <div class="banner-item-text bottom-right">W przypadku poprawek skontaktuj się z wykonawca przez nasz portal.</div>
                                </div>
                                <div step="5"><i class="flat flaticon-check"></i>
                                    <div class="banner-item-text top-left">Odbierz swój profesjonalnie poprawiony tekst.</div>
                                </div>
                                <div step="6"><i class="flat flaticon-hand-shake"></i>
                                    <div class="banner-item-text left-top">Pod koniec miesiąca otrzymasz od nas fakturę zbiorczą.</div>
                                </div><span class="step-banner-link"><div class="title"><span class="title-type">Korekta</span><span>Jak to działa?</span></div>
                            <div><a href="howItWorks" class="btn btn-primary btn-sm">Chcesz wiedzieć więcej? <i class="far fa-arrow-alt-circle-right"></i></a></div>
                            </span>
                        </div>
                        <div class="step-banner-right">
                            <div step="1"><i class="flat flaticon-users"></i>
                                <div class="banner-item-text right-center">Załóż darmowe konto i doładuj wirtualny portfel.</div>
                            </div>
                            <div step="2"><i class="flat flaticon-contract-4"></i>
                                <div class="banner-item-text bottom-right">Utwórz zlecenie: określ tematykę, rodzaj tekstu, liczbę znaków, wymagania oraz cenę.</div>
                            </div>
                            <div step="3"><i class="flat flaticon-pencil"></i>
                                <div class="banner-item-text top-left">Zainteresowany copywriter zarezerwuje tekst na 5 godzin w celu realizacji.</div>
                            </div>
                            <div step="4"><i class="flat flaticon-contract-4"></i>
                                <div class="banner-item-text bottom-right">Masz możliwość ciągłego kontaktu z wykonawcą przez nasz portal.</div>
                            </div>
                            <div step="5"><i class="flat flaticon-check"></i>
                                <div class="banner-item-text top-left">Gotowy tekst możesz zaakceptować, odrzucić lub odesłać do bezpłatnej poprawki.</div>
                            </div>
                            <div step="6"><i class="flat flaticon-hand-shake"></i>
                                <div class="banner-item-text left-top">Pod koniec miesiąca otrzymasz od nas fakturę zbiorczą.</div>
                            </div><span class="step-banner-link"><div class="title"><span class="title-type">Copywriting</span><span>Jak to działa?</span></div>
                        <div><a href="howItWorks" class="btn btn-primary btn-sm">Chcesz wiedzieć więcej? <i class="far fa-arrow-alt-circle-right"></i></a></div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!--HTML BLOCK END-->
        <!--HTML BLOCK START-->
        <div class="m-t-50 m-b-30">
            <div class="parent-banner home-banner">
                <div id="banner-3" class="carousel slide banner-container" data-ride="carousel" style="">
                    <ol class="carousel-indicators">
                        <li data-target="#banner-3" data-slide-to="0" class="active"></li>
                        <li data-target="#banner-3" data-slide-to="1" class=""></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active" def-width="1692" def-height="600" style="height: 0; background-image: url('images/5da8690c397c7.jpeg'); "></div>
                        <div class="carousel-item " def-width="1692" def-height="600" style="height: 0; background-image: url('images/5da8693872322.jpeg'); "></div>
                    </div>
                    <!-- Controls --><a class="left carousel-control no-shadow" href="#banner-3" role="button" data-slide="prev"><span class="carusel-control-img carusel-control-img-prev" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control no-shadow" href="#banner-3" role="button" data-slide="next"><span class="carusel-control-img carusel-control-img-next" aria-hidden="true"></span><span class="sr-only">Next</span></a></div>
            </div>
        </div>
        <!--HTML BLOCK END-->
        <!--HTML BLOCK START-->
        <div class="container dlaczego-warto">
            <div class="row">
                <div class="col-12 fs-18"> Dlaczego <span class="special-text fs-30">PRE<span class="fc-gold">TEXT</span></span>? </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-12 col-md">
                    <div class="dlaczego-title"><span>Szybkość i efektywność</span></div>
                    <div class="dlaczego-content">Zlecenia realizowane są w ciągu max. X godzin, postęp prac możesz obserwować na pasku realizacji zlecenia i cały czas masz kontakt ze zleceniobiorcą.</div>
                </div>
                <div class="col-12 col-md">
                    <div class="dlaczego-title"><span>Profesjonalizm</span></div>
                    <div class="dlaczego-content">Każdy tekst jest unikalny, poprawny językowo i napisany specjalnie dla Ciebie przez naszych copywriterów. </div>
                </div>
                <div class="col-12 col-md">
                    <div class="dlaczego-title"><span>Wygodne płatności</span></div>
                    <div class="dlaczego-content">Sam decydujesz o tym, ile chcesz zapłacić, doładowujesz swój portfel, a w ciągu x godzin/dni dostajesz fakturę na maila.</div>
                </div>
                <div class="col-12 col-md">
                    <div class="dlaczego-title"><span>Bezpieczeństwo</span></div>
                    <div class="dlaczego-content">Płacisz za tekst, który spełnia Twoje oczekiwania. Masz prawo do bezpłatnych poprawek przed akceptacją tekstu oraz możliwość wystawienia bezpłatnej korekty próbnej.</div>
                </div>
                <div class="col-12 col-md">
                    <div class="dlaczego-title"><span>Szeroki wachlarz możliwości</span></div>
                    <div class="dlaczego-content">Możesz zlecić różne rodzaje tekstów oraz korektę Twoich tekstów, a także samodzielnie zadecydować komu powierzysz swoje zlecenie poprzez ograniczenie listy wykonawców.</div>
                </div>
            </div>
        </div>
        <!--HTML BLOCK END-->
    </div>
    </div>
    </div>
    <div class="container">
        <div class="home-cat-bg">
            <div class="row">
                <div class="col-12">
                    <div class="gold-head"> Nasze kategorie </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-12 col-md-4 maiinTextTypes">
                    <div class="head-dark">Typy tekstu</div>
                    <ul>
                        <li><a href="fastFilter-Opis">Opis</a></li>
                        <li><a href="fastFilter-Tekst%20preclowy">Tekst preclowy</a></li>
                        <li><a href="fastFilter-Tekst%20synonimiczny">Tekst synonimiczny</a></li>
                        <li><a href="fastFilter-Tekst%20zapleczowy">Tekst zapleczowy</a></li>
                        <li><a href="fastFilter-Recenzja">Recenzja </a></li>
                        <li><a href="fastFilter-Tekst%20marketingowy">Tekst marketingowy</a></li>
                        <li><a href="fastFilter-Artykuły%20specjalistyczne%20i%20naukowe">Artykuły specjalistyczne i naukowe</a></li>
                        <li><a href="fastFilter-Prace%20naukowe">Prace naukowe</a></li>
                        <li><a href="fastFilter-Korekta">Korekta</a></li>
                        <li><a href="fastFilter-Inne">Inne</a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-7 mainCategories">
                    <div class="head-1">Tematyka</div>
                    <ul>
                        <li><a href="fastFilter-Biznes%20i%20prawo" title="Biznes i prawo">Biznes i prawo</a></li>
                        <li><a href="fastFilter-Budownictwo%20i%20nieruchomości" title="Budownictwo i nieruchomości">Budownictwo i nieruchomości</a></li>
                        <li><a href="fastFilter-Ecommerce" title="E-commerce">E-commerce</a></li>
                        <li><a href="fastFilter-Edukacja" title="Edukacja">Edukacja</a></li>
                        <li><a href="fastFilter-Erotyka" title="Erotyka">Erotyka</a></li>
                        <li><a href="fastFilter-Informacje%20i%20publicystyka" title="Informacje i publicystyka">Informacje i publicystyka</a></li>
                        <li><a href="fastFilter-Kultura%20i%20rozrywka" title="Kultura i rozrywka">Kultura i rozrywka</a></li>
                        <li><a href="fastFilter-Motoryzacja" title="Motoryzacja">Motoryzacja</a></li>
                        <li><a href="fastFilter-Moda" title="Moda">Moda</a></li>
                        <li><a href="fastFilter-Nowe%20technologie" title="Nowe technologie">Nowe technologie</a></li>
                        <li><a href="fastFilter-Sport" title="Sport">Sport</a></li>
                        <li><a href="fastFilter-Styl%20życia" title="Styl życia">Styl życia</a></li>
                        <li><a href="fastFilter-Turystyka%20i%20gastronomia" title="Turystyka i gastronomia">Turystyka i gastronomia</a></li>
                        <li><a href="fastFilter-Zdrowie%20i%20medycyna" title="Zdrowie i medycyna">Zdrowie i medycyna</a></li>
                        <li><a href="fastFilter-Inne" title="Inne">Inne</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>