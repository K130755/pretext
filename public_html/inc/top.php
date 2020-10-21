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
						<?php
						$qFW = mysqli_query($connect,"SELECT * FROM `filary_wiedzy` ORDER BY `id` DESC LIMIT 1");
						$sFW = mysqli_fetch_array($qFW);
							$pytanie1FW = $sFW['pytanie1'];
							$odpowiedz1FW = $sFW['odpowiedz1'];
							$pytanie2FW = $sFW['pytanie2'];
							$odpowiedz2FW = $sFW['odpowiedz2'];
							$pytanie3FW = $sFW['pytanie3'];
							$odpowiedz3FW = $sFW['odpowiedz3'];
							$pytanie4FW = $sFW['pytanie4'];
							$odpowiedz4FW = $sFW['odpowiedz4'];
						?>
            <div class="col">
                <div class="row row-nav-jak-to-dziala">
                    <div class="col-12 col-md-6 col-xxl-3 in-head-text-container">
                        <div class="in-head-text-name"><?=$pytanie1FW;?></div>
                        <div class="in-head-text-content"><?=$odpowiedz1FW;?></div>
                    </div>
                    <div class="col-12 col-md-6 col-xxl-3 in-head-text-container">
                        <div class="in-head-text-name"><?=$pytanie2FW;?></div>
                        <div class="in-head-text-content"><?=$odpowiedz2FW;?></div>
                    </div>
                    <div class="col-12 col-md-6 col-xxl-3 in-head-text-container">
                        <div class="in-head-text-name"><?=$pytanie3FW;?></div>
                        <div class="in-head-text-content"><?=$odpowiedz3FW;?></div>
                    </div>
                    <div class="col-12 col-md-6 col-xxl-3 in-head-text-container">
                        <div class="in-head-text-name"><?=$pytanie4FW;?></div>
                        <div class="in-head-text-content"><?=$odpowiedz4FW;?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
		<div style="height: 20px;"></div>