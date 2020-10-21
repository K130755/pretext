<div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content menuMobileBG">
      <div class="modal-header" style="border-bottom: 0px solid;">
        <div style="position: absolute; right: 30px;"><a href="javascript:;" data-dismiss="modal" style="color: #fff; font-size: 30px; position: absolute; z-index: 9999;">&times;</a></div>
				<div style="clear: both;"></div>
      </div>
      <div class="modal-body" style="text-align: center; line-height: 37px;">
        <a class="menuMobileLink" href="index">Strona Główna</a><BR>
				<a class="menuMobileLink" href="zleceniaTekst">Copywriting</a><BR>
				<a class="menuMobileLink" href="zleceniaKorekta">Korekta</a><BR>
				<a class="menuMobileLink" href="kontakt">Kontakt</a><BR>
				<a class="menuMobileLink" href="kalkulator">Kalkulator</a>
				<div style="height: 20px;"></div>
				<?php
				if(isset($_SESSION['user_id']) AND !empty($_SESSION['user_id'])){
					echo '<a class="menuMobileLink" href="dashboard">Profil</a><BR>';
					echo '<a class="menuMobileLink" href="logout">Wyloguj</a><BR>';
					
					echo '
								<div class="messages-info" style="float: left;" onClick="document.getElementById(\'myNotifs2\').style.display=\'block\';" id="notifBell2"><i class="fas fa-bell"></i>
								<span style="font-size: 11px; '; if($nBell > 0){echo "color: #e60000;";} else {echo "color: #fff; display: none;";} echo '">'.$nBell.'</span>
                </div>
								
								<div id="myNotifs2" style="display: none; color: #e4e4e4;">
										<a href="javascript:;" onClick="document.getElementById(\'myNotifs2\').style.display=\'none\';"><i class="fa fa-times" style="font-size: 17px; color: #6f6f6f; float: right;"></i></a>
										<div style="clear: both;"></div>
										';
										if($nBell > 0){
										echo '<div style="clear: both; height: 10px;"></div>';
											$qNotifs2 = mysqli_query($connect,"SELECT * FROM `notifs` WHERE `user_id` = ".$_SESSION['user_id']." AND `viewed` = '0'");
											$lpNotifs2 = 0;
											while($sNotifs2 = mysqli_fetch_array($qNotifs2)){
											$lpNotifs2++;
												$tytulNotifs2 = $sNotifs2['tytul'];
												$idNotifs2 = $sNotifs2['id'];
												echo "<a href='notif-$idNotifs2' style='text-decoration: none; color: #e4e4e4;'><i class='fas fa-bell' style='color: #c4c4c4;'></i> $tytulNotifs2</a><HR style='margin-top: 4px; margin-bottom: 7px;'>";
											}
										} else {
											echo "<CENTER><B>Brak powiadomień</B></CENTER>";
										}
										echo '
					</div>';
				
				} else {echo '<a class="menuMobileLink" href="login">Zaloguj się</a>';}
				?>
      </div>
    </div>
  </div>
</div>