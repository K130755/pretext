<?php include("inc/head.php"); ?>

<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/top.php"); ?>
		<div class="container">
        <form method="post" accept-charset="utf-8" id="kalkulator-form" action="parseCalc">
            <div class="row">
                <div class="col-12">
                    <div class="special-head"> Wycena Twojego zlecenia </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-12 col-md-2 text-center"><img src="images/calc_ico.png" /></div>
                <div class="col-12 col-md">
                    <div class="fs-24 fw-700">Zaplanuj budżet zlecenia w szybki i przyjazny sposób!</div>
                    <div class="fs-16 fw-400">Kalkulator to narzędzie, które pokaże Ci wszelkie możliwe opcje i pozwoli zaplanować budżet Twoich zleceń. Po uzupełnieniu danych dotyczących specyfiki oraz długości tekstu, otrzymasz trzy wyceny - według najniższej stawki, średniej stawki na portalu oraz stawki wpisanej przez Ciebie. Po wybraniu satysfakcjonującej Cię opcji możesz przejść bezpośrednio do formularza zleceń, a informacje, które podałeś, uzupełnią się automatycznie. Pamiętaj, że Twoja stawka nie może wynosić mniej niż minimum ustalone w regulaminie. Niniejszy kalkulator spełnia jedynie rolę informacyjną. </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-5 col-lg-4 col-xxl-3 calc-special-radio">
                    <div class="form-group radio required">
                        <label>Wybierz co chcesz wycenić</label>
                        <input type="hidden" class="form-control " name="rodzaj" value="" />
                        <div>
                            <input type="radio" name="rodzaj" value="nowy" id="rodzaj-tekst" required="required" next-item="#typ-id" style="float: left; margin-top: 18px;">
                            <label for="rodzaj-tekst">Potrzebuję nowy tekst <i class="flat flaticon-edit"></i></label>
                        </div>
                        <div>
                            <input type="radio" name="rodzaj" value="korekta" id="rodzaj-korekta" required="required" next-item="#typ-id" style="float: left; margin-top: 18px;">
                            <label for="rodzaj-korekta">Potrzebuję korektę tekstu <i class="flat flaticon-scissors"></i></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-items-center m-t-30 m-b-30">
                <div class="d-none d-md-inline-flex col-md">
                    <div class="line"></div>
                </div>
                <div class="col-12 col-md-1 text-center"><i class="flat flaticon-sketch calc-arrow-ico"></i></div>
                <div class="d-none d-md-inline-flex col-md">
                    <div class="line"></div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-3">
                    <div class="form-group select required">
                        <label for="typ-id">Typ tekstu:</label>
                        <select class="form-control " name="typ_tekstu" next-item="#kategoria-id" required="required" id="typ-id">
                            <option value="">Wybierz</option>
                            <option value="Opis">Opis</option>
                            <option value="Tekst preclowy">Tekst preclowy</option>
                            <option value="Tekst synonimiczny">Tekst synonimiczny</option>
                            <option value="Tekst zapleczowy">Tekst zapleczowy</option>
                            <option value="Recenzja">Recenzja </option>
                            <option value="Tekst marketingowy">Tekst marketingowy</option>
                            <option value="Artykuły specjalistyczne i naukowe">Artykuły specjalistyczne i naukowe</option>
                            <option value="Prace naukowe">Prace naukowe</option>
                            <option value="Korekta">Korekta</option>
                            <option value="Inne">Inne</option>
                        </select><span class="nice-select"><i class="fa fa-angle-down"></i></span><span class="nice-unselect"><i class="fa fa-times"></i></span></div>
                </div>
                <div class="col-12 col-md-1"></div>
                <div class="col-12 col-md-3">
                    <div class="form-group select required">
                        <label for="kategoria-id">Kategoria:</label>
                        <select class="form-control " name="kategoria" next-item="#calc-ilosc-znakow" required="required" id="kategoria-id">
                            <option value="">Wybierz</option>
                            <option value="Biznes i prawo">Biznes i prawo</option>
                            <option value="Budownictwo i nieruchomości">Budownictwo i nieruchomości</option>
                            <option value="E-commerce">E-commerce</option>
                            <option value="Edukacja">Edukacja</option>
                            <option value="Erotyka">Erotyka</option>
                            <option value="Informacje i publicystyka">Informacje i publicystyka</option>
                            <option value="Kultura i rozrywka">Kultura i rozrywka</option>
                            <option value="Motoryzacja">Motoryzacja</option>
                            <option value="Moda">Moda</option>
                            <option value="Nowe technologie">Nowe technologie</option>
                            <option value="Sport">Sport</option>
                            <option value="Styl życia">Styl życia</option>
                            <option value="Turystyka i gastronomia">Turystyka i gastronomia</option>
                            <option value="Zdrowie i medycyna">Zdrowie i medycyna</option>
                            <option value="Inne">Inne</option>
                        </select><span class="nice-select"><i class="fa fa-angle-down"></i></span><span class="nice-unselect"><i class="fa fa-times"></i></span></div>
                </div>
            </div>
            <div class="row justify-content-center align-items-center m-t-30 m-b-30">
                <div class="d-none d-md-inline-flex col-md">
                    <div class="line-bold"></div>
                </div>
                <div class="col-12 col-md-1 text-center"><i class="flat flaticon-sketch calc-arrow-ico"></i></div>
                <div class="d-none d-md-inline-flex col-md">
                    <div class="line-bold"></div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-3">
                    <div class="form-group number required">
                        <label for="calc-ilosc-znakow">Przybliżona ilość znaków:</label>
                        <input type="number" class="form-control " name="ilosc_znakow" next-item="#cena-typ-max" required="required" id="calc-ilosc-znakow" />
                    </div>
                </div>
            </div>
            <div class="row justify-content-center m-t-30 m-b-30">
                <div class="col-12 col-md-12">
                    <div class="gold-head d-block text-center">Wycena</div>
                </div>
            </div>
            <div class="row justify-content-center align-items-end">
                <div class="col-12 col-md-3 col-xxl-2">
                    <label class="kalk-label">
                        <div>Minimalna cena zlecenia</div>
                        <div class="fs-16 fw-700">Stawka: 4 &#122;&#322; / 1000 znaków</div>
                        <div class="div-purpure">Wycena końcowa: <span id="kalk-total-min" price="4">0 &#122;&#322;</span></div>
                        <div class="text-center">Wybierz i utwórz zlecenie</div>
                        <div class="text-center">
                            <input name="cena_typ" next-item="#submit-calc-button" required="required" value="min" type="radio" />
                        </div>
                    </label>
                </div>
                <div class="col-12 col-md-3 col-xxl-2">
                    <label class="kalk-label">
                        <div>Średnia cena zlecenia</div>
                        <div class="fs-16 fw-700">Stawka: 25 &#122;&#322; / 1000 znaków</div>
                        <div class="div-purpure">Wycena końcowa: <span id="kalk-total-max" price="25">0 &#122;&#322;</span></div>
                        <div class="text-center">Wybierz i utwórz zlecenie</div>
                        <div class="text-center">
                            <input name="cena_typ" next-item="#submit-calc-button" id="cena-typ-max" required="required" value="max" type="radio" />
                        </div>
                    </label>
                </div>
                <div class="col-12 col-md-3 col-xxl-2">
                    <label for="custom-cena-typ" class="kalk-label">
                        <div class="fs-16 fw-700">Wprowadź własną stawkę:</div>
                        <div>
                            <input class="input-mini form-control" type="text" data-type="float" name="cena" id="kalk-custom-price" /><span> zł / 1000 znaków</span></div>
                        <div class="div-purpure">Wycena końcowa: <span id="kalk-total-custom">0 &#122;&#322;</span></div>
                        <div class="text-center">Wybierz i utwórz zlecenie</div>
                        <div class="text-center">
                            <input name="cena_typ" next-item="#submit-calc-button" required="required" id="custom-cena-typ" value="custom" type="radio" />
                        </div>
                    </label>
                </div>
            </div>
            <div class="row justify-content-center m-t-30 m-b-30">
                <div class="col-12 col-md-3 text-center">
                    <button type="submit" id="submit-calc-button" class="btn btn-primary">Dodaj zlecenie <i class="fa fa-angle-right"></i></button>
                </div>
            </div>
        </form>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>