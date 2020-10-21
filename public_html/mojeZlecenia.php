<?php include("inc/head.php"); ?>
<?php if(!isset($_SESSION['user_id']) AND empty($_SESSION['user_id'])){header("Location: login");} ?>
<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/dashboardTop.php"); ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="nav-uzytkownik">
                    <div class="row">
                        <?php include("inc/dashMenu.php"); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-9" style="padding-top: 30px; padding-bottom: 30px;">
												<div class='row'>
													<div class='col-md-6' style='margin-bottom: 7px;'>
														<h4>Moje zlecenia</h4>
													</div>
													<div class='col-md-6' style='margin-bottom: 7px; text-align: right;'>
														<B>Sortuj:</B><BR>
														<select name='sort' class='form form-control' style='width: 200px; float: right;' onChange="document.location.href='sortMojeZlecenia-'+this.value;">
															<?php
															if(!empty($_SESSION['sortMojeZlecenia'])){
																if($_SESSION['sortMojeZlecenia'] == "id"){
																	echo "<option value='id'>Od najnowszych</option>";
																}
																if($_SESSION['sortMojeZlecenia'] == "kategoria"){
																	echo "<option value='kategoria'>Wg kategorii</option>";
																}
																if($_SESSION['sortMojeZlecenia'] == "typ"){
																	echo "<option value='typ'>Wg typu</option>";
																}
																if($_SESSION['sortMojeZlecenia'] == "status"){
																	echo "<option value='status'>Wg statusu</option>";
																}
																if($_SESSION['sortMojeZlecenia'] == "cena"){
																	echo "<option value='cena'>Wg ceny</option>";
																}
																echo "<option disabled>-----------</option>";
															}
															?>
															<option value='id'>Od najnowszych</option>
															<option value='kategoria'>Wg kategorii</option>
															<option value='typ'>Wg typu</option>
															<option value='status'>Wg statusu</option>
															<option value='cena'>Wg ceny</option>
														</select>
													</div>
												</div>
												<?php
												showRespond($_GET['error'],$_GET['correct']);
												
												if(!empty($_SESSION['sortMojeZlecenia'])){
													if($_SESSION['sortMojeZlecenia'] == "id"){
														$sort = "ORDER BY `id` DESC";
													}
													if($_SESSION['sortMojeZlecenia'] == "kategoria"){
														$sort = "ORDER BY `kategoria` ASC, `id` DESC";
													}
													if($_SESSION['sortMojeZlecenia'] == "typ"){
														$sort = "ORDER BY `typ` DESC, `id` DESC";
													}
													if($_SESSION['sortMojeZlecenia'] == "status"){
														$sort = "ORDER BY `closed` ASC, `id` ASC";
													}
													if($_SESSION['sortMojeZlecenia'] == "cena"){
														$sort = "ORDER BY `cena` ASC, `id` ASC";
													}
												} else {
													$sort = "ORDER BY `id` DESC";
												}
												
												if($moj_typ == "wykonawca"){
												//=========================================================================
												$q = mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `wykonawca_id` = ".$_SESSION['user_id']." $sort");
												$n = mysqli_num_rows($q);
												if($n > 0){
													echo "<table class='table table-striped' style='margin-top: 20px;'>";
													echo "
													<tr>
														<td style='font-weight: bold;'>Rodzaj zlecenia</td>
														<td style='font-weight: bold;'>Tytuł</td>
														<td style='font-weight: bold;'>Typ tekstu</td>
														<td style='font-weight: bold;'>Kategoria</td>
														<td style='font-weight: bold; text-align: center;'>Korekta próbna</td>
														<td style='font-weight: bold; text-align: center;'>Zatwierdzono</td>
														<td style='font-weight: bold; width: 1%;' nowrap='nowrap'>Podgląd</td>
													</tr>
													";
													while($s = mysqli_fetch_array($q)){
														$zlecenie_id = $s['zlecenie_id'];
														$closed = $s['closed'];
														$korekta_probna_zatwierdzona = $s['korekta_probna_zatwierdzona'];
														$q2 = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `id` = $zlecenie_id");
														$s2 = mysqli_fetch_array($q2);
														$tytul2 = $s2['tytul'];
														$kategoria2 = $s2['kategoria'];
														$tekst_korekta_probna2 = $s2['tekst_korekta_probna'];
														$typ_tekstu2 = $s2['typ_tekstu'];
														$typ2 = $s2['typ'];
														$canceled2 = $s['canceled'];
														if($typ2 == "nowy"){$rodzaj_tekstu2 = "Nowy tekst";} else {$rodzaj_tekstu2 = "Korekta tekstu";}
														if($canceled2 == "1"){
														echo "
														<tr style='text-decoration: line-through; color: #a2a2a2;'>
															<td>$rodzaj_tekstu2</td>
															<td>$tytul2</td>
															<td>$typ_tekstu2</td>
															<td>$kategoria2</td>
															<td style=' text-align: center;'>"; if(empty($tekst_korekta_probna2)){echo "-";}else{if($korekta_probna_zatwierdzona == "1"){echo "<span style='color: #428400;'><i class='fa fa-check-circle'></i> Zatwierdzona</span>";} else {echo "<i class='fa fa-clock'></i> Oczekuje";}} echo "</td>
															<td style='text-align: center;'>"; if($closed == "1"){echo "<span style='color: #428400; font-weight: bold;'>Tak</span>";} else {echo "Nie";} echo "</td>
															<td nowrap='nowrap'><a href='javascript:;' class='btn btn-info'>Realizacja odrzucona</a></td>
														</tr>
														";
														} else {
														echo "
														<tr>
															<td>$rodzaj_tekstu2</td>
															<td>$tytul2</td>
															<td>$typ_tekstu2</td>
															<td>$kategoria2</td>
															<td style=' text-align: center;'>"; if(empty($tekst_korekta_probna2)){echo "-";}else{if($korekta_probna_zatwierdzona == "1"){echo "<span style='color: #428400;'><i class='fa fa-check-circle'></i> Zatwierdzona</span>";} else {echo "<i class='fa fa-clock'></i> Oczekuje";}} echo "</td>
															<td style='text-align: center;'>"; if($closed == "1"){echo "<span style='color: #428400; font-weight: bold;'>Tak</span>";} else {echo "Nie";} echo "</td>
															<td nowrap='nowrap'><a href='joinOffer-$zlecenie_id' class='btn btn-primary'>Podgląd zlecenia</a></td>
														</tr>
														";
														}
													}
													echo "</table>";
												} else {header("Location: dashboard?error=Nie bierzesz udziału w żadnych zleceniach!");}
												//=========================================================================
												} else {
												//=========================================================================
												$q = mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `user_id` = ".$_SESSION['user_id']." $sort");
												$n = mysqli_num_rows($q);
												if($n > 0){
													echo "<table class='table table-striped' style='margin-top: 20px;'>";
													echo "
													<tr>
														<td style='font-weight: bold;'>Rodzaj zlecenia</td>
														<td style='font-weight: bold;'>Tytuł</td>
														<td style='font-weight: bold;'>Typ tekstu</td>
														<td style='font-weight: bold;'>Kategoria</td>
														<td style='font-weight: bold; text-align: center;'>Wykonawca</td>
														<td style='font-weight: bold; text-align: center;'>Zatwierdzono</td>
														<td style='font-weight: bold; width: 1%;' nowrap='nowrap'>Podgląd</td>
													</tr>
													";
													while($s = mysqli_fetch_array($q)){
														$closed = $s['closed'];
														$tytul = $s['tytul'];
														$kategoria = $s['kategoria'];
														$tekst_korekta_probna = $s['tekst_korekta_probna'];
														$typ_tekstu = $s['typ_tekstu'];
														$typ = $s['typ'];
														$zlecenie_id = $s['id'];
														$wykonawca_id = $s['wykonawca_id'];
														if($typ == "nowy"){$rodzaj_tekstu = "Nowy tekst";} else {$rodzaj_tekstu = "Korekta tekstu";}
														/*$qCheckWykonawca = mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `zlecenie_id` = $zlecenie_id AND `canceled` != '1'");
														$nCheckWykonawca = mysqli_num_rows($qCheckWykonawca);
														if($nCheckWykonawca > 0){
															$sCheckWykonawca = mysqli_fetch_array($qCheckWykonawca);
															$wykonawca_idCheckWykonawca = $sCheckWykonawca['wykonawca_id'];
															$qCheckWykonawca2 = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $wykonawca_idCheckWykonawca");
															$sCheckWykonawca2 = mysqli_fetch_array($qCheckWykonawca2);
															$imieCheckWykonawca = $sCheckWykonawca2['imie']." ".$sCheckWykonawca2['nazwisko'];
														}*/
														
														if($wykonawca_id != "0" AND !empty($wykonawca_id)){
															$qCheckWykonawca2 = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $wykonawca_id");
															$nCheckWykonawca = mysqli_num_rows($qCheckWykonawca2);
															$sCheckWykonawca2 = mysqli_fetch_array($qCheckWykonawca2);
															$imieCheckWykonawca = $sCheckWykonawca2['imie']." ".$sCheckWykonawca2['nazwisko'];
														} else {
															$nCheckWykonawca = 0;
														}
														
														echo "
														<tr>
															<td>$rodzaj_tekstu</td>
															<td>$tytul</td>
															<td>$typ_tekstu</td>
															<td>$kategoria</td>
															<td style='text-align: center;'>"; if($nCheckWykonawca > 0){echo $imieCheckWykonawca;} else {echo "<i class='fa fa-clock'></i>";} echo "</td>
															<td style='text-align: center;'>"; if($closed == "1"){echo "<span style='color: #428400; font-weight: bold;'>Tak</span>";} else {echo "Nie";} echo "</td>
															<td nowrap='nowrap'>"; if($closed == "1"){echo "<a href='podglad-$zlecenie_id' class='btn btn-primary'>Podgląd zlecenia</a>";} else {echo "<a href='edytujZlecenie-$zlecenie_id' class='btn btn-primary'>Podgląd zlecenia</a>";} echo "</td>
														</tr>
														";
													}
													echo "</table>";
												} else {header("Location: dashboard?error=Nie zleciłeś żadnych projektów!");}
												//=========================================================================
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