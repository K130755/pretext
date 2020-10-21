<style type="text/css">
@media (min-width: 767px){
	#myNotifs {
		background: #fff; position: absolute; z-index: 5; padding: 10px; top: 40px; width: 300px; text-align: left; margin-left: -270px; border: 1px solid #ebebeb;
	}
}

@media (max-width: 767px){
	#myNotifs {
		background: #fff; position: absolute; z-index: 5; padding: 10px; top: 40px; width: 300px; text-align: left; margin-left: 90px; border: 1px solid #ebebeb;
	}
}
</style>
<script type="text/javascript">
    var alertMessages = new Object();
    var basePath = '/';
</script>
<div class="black-bar"></div>
<div class="container m-b-20">
    <div class="row menuComputer">
        <div class="col-12 col-md-3 col-lg-auto">
            <a class="navbar-brand" href="index"><img src="images/logo.png" alt="Nazwa firmy" /></a>
        </div>
        <div class="col">
            <div class="row nav-menu-row">
                <?php include("inc/menuTop.php"); ?>
            </div>
            <div class="row">
                <div class="col-12"></div>
            </div>
        </div>
        <div class="col-12 col-md-auto text-right">
				<?php
							$nBell = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `notifs` WHERE `user_id` = '".$_SESSION['user_id']."' AND `viewed` = 0"));
						?>
              <?php
							if(isset($_SESSION['user_id']) AND !empty($_SESSION['user_id'])){
								echo '
								<div class="messages-info" onClick="document.getElementById(\'myNotifs\').style.display=\'block\';" id="notifBell"><i class="fas fa-bell"></i>
								<span style="font-size: 11px; '; if($nBell > 0){echo "color: #e60000;";} else {echo "color: #fff; display: none;";} echo '">'.$nBell.'</span>
                </div>
								
								<div id="myNotifs" style="display: none;">
										<a href="javascript:;" onClick="document.getElementById(\'myNotifs\').style.display=\'none\';"><i class="fa fa-times" style="font-size: 17px; color: #6f6f6f; float: right;"></i></a>
										<div style="clear: both;"></div>
										';
										if($nBell > 0){
										echo '<div style="clear: both; height: 10px;"></div>';
											$qNotifs = mysqli_query($connect,"SELECT * FROM `notifs` WHERE `user_id` = ".$_SESSION['user_id']." AND `viewed` = '0'");
											$lpNotifs = 0;
											while($sNotifs = mysqli_fetch_array($qNotifs)){
											$lpNotifs++;
												$tytulNotifs = $sNotifs['tytul'];
												$idNotifs = $sNotifs['id'];
												echo "<a href='notif-$idNotifs' style='text-decoration: none; color: #333333;'><i class='fas fa-bell' style='color: #c4c4c4;'></i> $tytulNotifs</a><HR style='margin-top: 4px; margin-bottom: 7px;'>";
											}
										} else {
											echo "<CENTER><B>Brak powiadomień</B></CENTER>";
										}
										echo '
								</div>
								<div class="btn-group color-link" style="display: inline-block;">
                    <a href="#" class="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img data-toggle="tooltip" title="Zmień kolor tła strony" src="images/color.png" /></a>
                    <div class="dropdown-menu">
                        <h6 class="dropdown-header">Zmień kolor tła strony</h6>
												<a class="dropdown-item set-body-color" href="javascript:;" onClick="changeBG(\'#fff\');" data-color="#ffffff"><span class="color-item" style="background:#ffffff;"></span></a>
												<a class="dropdown-item set-body-color" href="javascript:;" onClick="changeBG(\'#f9f9f9\');" data-color="#f9f9f9"><span class="color-item" style="background:#f9f9f9;"></span></a>
												<a class="dropdown-item set-body-color" href="javascript:;" onClick="changeBG(\'#e6e2d6\');" data-color="#e6e2d6"><span class="color-item" style="background:#e6e2d6;"></span></a>
										</div>
                </div>
								<div class="btn-group user-link">
									<a href="dashboard" class=""> Twoje konto </a>
								</div>
								<a href="logout" style="color: #fff; margin-left: 7px; position: relative; top: 4px;"><i class="fa fa-power-off"></i></a>';
							} else {
								echo '<a class="user-link" data-toggle="modal" data-target="#login-modal" href="#" id="topLoginLink">Zaloguj się</a>';
							}
							?>
        </div>
    </div>
		
		<div class='menuPhone'>
					<div class="menuPhoneLeft">
            <a class="navbar-brand" href="index"><img src="images/logo.png" alt="Nazwa firmy" style="margin-bottom: 30px;" /></a>
					</div>
					<div class="menuPhoneRight">
						<div class="hamburgerContainer" id="hamSwitch" onclick="hamFunction(this);" data-toggle="modal" data-target="#menuModal">
							<div class="bar1"></div>
							<div class="bar2"></div>
							<div class="bar3"></div>
						</div>
					</div>
					<div class="menuPhoneClear"></div>
				</div>
				<?php include("inc/menuMobile.php"); ?>
		
    <div class="row">
        <?php include("underLogoMenu.php"); ?>
            <div class="col">
                <div class="row align-items-end user-in-nav">
                    <div class="col-12 col-md-auto align-self-lg-end align-self-md-center mobile-text-center">
                        <a class="avatar" href="dashboard">
                            <button type="button" class="btn btn-default btn-sm live-edit-btn" onClick="document.getElementById('avatarInput').click();"><i class="fa fa-edit"></i></button><img src="images/users/<?=$moj_avatar;?>" alt="" /></a>
                    </div>
										<?php
										//======================================
										// POST DATA ===========================
										//======================================
										$plik_tmpIMG = $_FILES['avatar']['tmp_name'];
										$plik_nazwaIMG = $_FILES['avatar']['name'];
										$extIMG = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
										$plik_nazwaIMG = sha1(md5(time().rand(9999999,999999999999).$moj_email)).".".$extIMG;

										if(is_uploaded_file($plik_tmpIMG)) {
											if($extIMG == "png" OR $extIMG == "PNG" OR $extIMG == "jpg" OR $extIMG == "JPG" OR $extIMG == "jpeg" OR $extIMG == "JPEG" OR $extIMG == "bmp" OR $extIMG == "BMP"){
												if($moj_avatar != "no_photo.png"){
													unlink("images/users/$moj_avatar");
												}
												move_uploaded_file($plik_tmpIMG, "images/users/$plik_nazwaIMG");
												resize("images/users/$plik_nazwaIMG",400);
												mysqli_query($connect,"UPDATE `users` SET `img` = '$plik_nazwaIMG' WHERE `id` = ".$_SESSION['user_id']);
												header("Location: dashboard");
											}
										}
										//======================================
										?>
										<form id='changeAvatar' enctype='multipart/form-data' action='' method='post'>
											<input type='file' name='avatar' id='avatarInput' style='position: absolute; z-index: -1; width: 0.01px; height: 0.01px; opacity: 0;' onChange="document.getElementById('changeAvatar').submit();">
										</form>
                    <div class="col">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg mobile-text-center">
                                <a class="fs-16 fw-700" href="dashboard">
                                    <div><?=$moje_imie;?> <?=$moje_nazwisko;?></div></a>
                            </div>
                            
														<div class="col-6 col-md text-right align-self-end"><?php if($moj_typ == "zleceniodawca"){ ?><a href="postTekst" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Nowe zlecenie na tekst</a><?php } ?></div>
                            <div class="col-6 col-md-auto text-right align-self-end"><?php if($moj_typ == "zleceniodawca"){ ?><a href="postKorekta" class="btn btn-warning btn-sm"><i class="fas fa-file-signature"></i> Nowe zlecenie korekty</a><?php } ?></div>
														
                            <div class="col-12">
                                <hr class="hr-min" />
                            </div>
                        </div>
                        <div class="row m-t-13 user-in-nav-params">
                            <?php
														if($moj_typ == "zleceniodawca"){
														$allZleceniaTop = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `typ` = 'korekta' AND `user_id` = ".$_SESSION['user_id']));
															if(empty($allZleceniaTop)){$allZleceniaTop = "0";}
														$activeZleceniaTop = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `typ` = 'korekta' AND `closed` != '1' AND `user_id` = ".$_SESSION['user_id']));
															if(empty($activeZleceniaTop)){$activeZleceniaTop = "0";}
														$doneZleceniaTop = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `typ` = 'korekta' AND `closed` = '1' AND `user_id` = ".$_SESSION['user_id']));
															if(empty($doneZleceniaTop)){$doneZleceniaTop = "0";}
														$procentyZleceniaTop = number_format(($doneZleceniaTop*100)/$allZleceniaTop);
															if($procentyZleceniaTop == "nan"){$procentyZleceniaTop = "0";}
															
														$allZleceniaTop2 = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `typ` = 'nowy' AND `user_id` = ".$_SESSION['user_id']));
															if(empty($allZleceniaTop2)){$allZleceniaTop2 = "0";}
														$activeZleceniaTop2 = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `typ` = 'nowy' AND `closed` != '1' AND `user_id` = ".$_SESSION['user_id']));
															if(empty($activeZleceniaTop2)){$activeZleceniaTop2 = "0";}
														$doneZleceniaTop2 = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `zlecenia` WHERE `typ` = 'nowy' AND `closed` = '1' AND `user_id` = ".$_SESSION['user_id']));
															if(empty($doneZleceniaTop2)){$doneZleceniaTop2 = "0";}
														$procentyZleceniaTop2 = number_format(($doneZleceniaTop2*100)/$allZleceniaTop2);
															if($procentyZleceniaTop2 == "nan"){$procentyZleceniaTop2 = "0";}
														echo '
														<div class="col-12 col-md-auto">
                                <div class="fs-16 fw-700 fc-gold">Korekty</div>
                                <div>Zlecenia: '.$allZleceniaTop.'</div>
                                <div>Trwające: '.$activeZleceniaTop.' | '.$procentyZleceniaTop.'% zatwierdzonych</div>
                            </div>
                            <div class="col-1 d-none d-lg-inline-flex"></div>
                            <div class="col-12 col-md-auto">
                                <div class="fs-16 fw-700 fc-gold">Teksty</div>
                                <div>Zlecenia: '.$allZleceniaTop2.'</div>
                                <div>Trwające: '.$activeZleceniaTop2.' | '.$procentyZleceniaTop2.'% zatwierdzonych</div>
                            </div>
														';
														} else {
														$allZleceniaTop = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `typ` = 'korekta' AND `wykonawca_id` = ".$_SESSION['user_id']));
															if(empty($allZleceniaTop)){$allZleceniaTop = "0";}
														$activeZleceniaTop = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `typ` = 'korekta' AND `closed` != '1' AND `wykonawca_id` = ".$_SESSION['user_id']));
															if(empty($activeZleceniaTop)){$activeZleceniaTop = "0";}
														$doneZleceniaTop = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `typ` = 'korekta' AND `closed` = '1' AND `wykonawca_id` = ".$_SESSION['user_id']));
															if(empty($doneZleceniaTop)){$doneZleceniaTop = "0";}
														$procentyZleceniaTop = number_format(($doneZleceniaTop*100)/$allZleceniaTop);
															if($procentyZleceniaTop == "nan"){$procentyZleceniaTop = "0";}
															
														$allZleceniaTop2 = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `typ` = 'nowy' AND `wykonawca_id` = ".$_SESSION['user_id']));
															if(empty($allZleceniaTop2)){$allZleceniaTop2 = "0";}
														$activeZleceniaTop2 = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `typ` = 'nowy' AND `closed` != '1' AND `wykonawca_id` = ".$_SESSION['user_id']));
															if(empty($activeZleceniaTop2)){$activeZleceniaTop2 = "0";}
														$doneZleceniaTop2 = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `realizacje` WHERE `typ` = 'nowy' AND `closed` = '1' AND `wykonawca_id` = ".$_SESSION['user_id']));
															if(empty($doneZleceniaTop2)){$doneZleceniaTop2 = "0";}
														$procentyZleceniaTop2 = number_format(($doneZleceniaTop2*100)/$allZleceniaTop2);
															if($procentyZleceniaTop2 == "nan"){$procentyZleceniaTop2 = "0";}
															
														echo '
														<div class="col-12 col-md-auto">
                                <div class="fs-16 fw-700 fc-gold">Korekty</div>
                                <div>Zrealizowane: '.$allZleceniaTop.'</div>
                                <div>Trwające: '.$activeZleceniaTop.' | '.$procentyZleceniaTop.'% zatwierdzonych</div>
                            </div>
                            <div class="col-1 d-none d-lg-inline-flex"></div>
                            <div class="col-12 col-md-auto">
                                <div class="fs-16 fw-700 fc-gold">Teksty</div>
                                <div>Zrealizowane: '.$allZleceniaTop2.'</div>
                                <div>Trwające: '.$activeZleceniaTop2.' | '.$procentyZleceniaTop2.'% zatwierdzonych</div>
                            </div>
														';
														}
														?>
                            <div class="col-12 col-md align-self-end">
                                <?php if($moj_typ == "zleceniodawca"){ ?><div class="row justify-content-end">
                                    <div class="col-12 text-right align-self-end"><a href="users" class="">Szukaj wykonawców <i class="fa fa-users"></i></a></div>
                                    <div class="col-12 text-right align-self-end"><a href="favourites" class="">Twoi ulubieni wykonawcy <i class="fa fa-star"></i></a></div>
                                </div><?php } ?>
                            </div>
                            <div class="col-12">
                                <hr class="hr-min" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>