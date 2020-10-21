<?php include("inc/head.php"); ?>

<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/top.php"); ?>
		<div class="container">
        <div class="view-uzytkownik-head">
            <div class="row">
                <div class="col-12">Lista wykonawców</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="filter-nav-header">Kategorie</div>
                <div class="filter-item">
                    <ul>
                        <li class=""><a href="users-Biznes%20i%20prawo" title="Biznes i prawo"><span>Biznes i prawo</span></a></li>
                        <li class=""><a href="users-Budownictwo%20i%20nieruchomości" title="Budownictwo i nieruchomości"><span>Budownictwo i nieruchomości</span></a></li>
                        <li class=""><a href="users-Ecommerce" title="E-commerce"><span>E-commerce</span></a></li>
                        <li class=""><a href="users-Edukacja" title="Edukacja"><span>Edukacja</span></a></li>
                        <li class=""><a href="users-Erotyka" title="Erotyka"><span>Erotyka</span></a></li>
                        <li class=""><a href="users-Informacje%20i%20publicystyka" title="Informacje i publicystyka"><span>Informacje i publicystyka</span></a></li>
                        <li class=""><a href="users-Kultura%20i%20rozrywka" title="Kultura i rozrywka"><span>Kultura i rozrywka</span></a></li>
                        <li class=""><a href="users-Motoryzacja" title="Motoryzacja"><span>Motoryzacja</span></a></li>
                        <li class=""><a href="users-Moda" title="Moda"><span>Moda</span></a></li>
                        <li class=""><a href="users-Nowe%20technologie" title="Nowe technologie"><span>Nowe technologie</span></a></li>
                        <li class=""><a href="users-Sport" title="Sport"><span>Sport</span></a></li>
                        <li class=""><a href="users-Styl%20życia" title="Styl życia"><span>Styl życia</span></a></li>
                        <li class=""><a href="users-Turystyka%20i%20gastronomia" title="Turystyka i gastronomia"><span>Turystyka i gastronomia</span></a></li>
                        <li class=""><a href="users-Zdrowie%20i%20medycyna" title="Zdrowie i medycyna"><span>Zdrowie i medycyna</span></a></li>
                        <li class=""><a href="users-Inne" title="Inne"><span>Inne</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-9">
								<div style="height: 20px;"></div>
                <?php
								$kategoriaGet = trim(addslashes(strip_tags($_GET['kategoria'])));
								if(!empty($kategoriaGet)){
									if($kategoriaGet == "Ecommerce"){
										$kategoriaGet = "E-commerce";
									}
									$filter = " AND `mocne_strony` LIKE '%$kategoriaGet%'";
								}
								$q = mysqli_query($connect,"SELECT * FROM `users` WHERE `typ` = 'wykonawca' $filter AND (`copywriter` = '1' OR `korektor` = '1')");
								$n = mysqli_num_rows($q);
								if($n > 0){
									while($s = mysqli_fetch_array($q)){
										$id = $s['id'];
										$show_name = $s['show_name'];
										
										if($show_name != "1"){
										$imie = $s['imie']." ".substr($s['nazwisko'],0,1).".";
										$nick = $s['nick'];
											if(empty($nick)){$nick = $imie;}
										} else {$nick = $s['imie']." ".$s['nazwisko'];}
										$img = $s['img'];
											if(empty($img)){$img = "no_photo.png";}
										$copywriter = $s['copywriter'];
										$korektor = $s['korektor'];
										$mocne_strony = substr($s['mocne_strony'],1);
										$mocne_strony = str_replace(",",", ",$mocne_strony);
										echo '
										<div class="user-list-item">
												<div class="row ">
														<div class="col-12">
																<div class="title"><a href="user-'.$id.'">'.$nick.'</a></div>
														</div>
														<div class="col-12 col-md-3 col-lg-2">
																<a href="user-'.$id.'" class="center-image"><img src="images/users/'.$img.'" alt="" /></a>
														</div>
														<div class="col-12 col-md-5 col-lg">
																<div class="row align-items-end justify-content-end">
																		<div class="col-12 col-md align-self-start">
																				<div class="user-list-param text-left m-t-10 m-b-20" style="font-size: 15px;">Typ konta: <span class="value" style="font-size: 15px;">'; if($copywriter == "1" AND $korektor == "0"){echo "Copywriter";} if($copywriter == "0" AND $korektor == "1"){echo "Korektor";} if($copywriter == "1" AND $korektor == "1"){echo "Copywriter | Korektor";} echo '</span></div>
																				<div>Preferowane kategorie:</div>
																				<ul>
																						<li>'.$mocne_strony.'</li>
																				</ul>
																		</div>
																</div>
														</div>
														<div class="col-12 col-md-4 col-lg-5 align-self-end text-right"><a class="btn btn-primary btn-md" href="orderText-'.$id.'">Zleć pracę temu wykonawcy</a>
																<div class="user-list-param">Zrealizowane zlecenia: <span class="value">'; echo mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `wykonawca_id` = $id AND `closed` = 1")); echo '</span></div>
																<div class="user-list-param">W trakcie realizacji: <span class="value">'; echo mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `wykonawca_id` = $id AND `closed` = 0")); echo '</span></div>
														</div>
												</div>
												<div style="height: 15px;"></div>
										</div>
										';
									}
								} else {error("Brak użytkowników na tej liście!");}
								?>
                <div class="row">
                    <div class="col-12 col-md-11 text-right"></div>
                </div>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>