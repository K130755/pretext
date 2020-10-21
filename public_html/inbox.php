<?php include("inc/head.php"); ?>

<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/dashboardTop.php"); ?>
    <div class="container login-container">
        <div class="row">
            <div class="col-12">
							<div class="nav-uzytkownik">
                <div class="row">
                  <?php include("inc/dashMenu.php"); ?>
                </div>
							</div>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9 col-lg-8 pd-t-35">
												<?php
												if($_GET['sent'] == "1"){
													correctFIXED("Wiadomość została wysłana!");
												}
												
												if(empty($_SESSION['user_id'])){header("Location: login");}
												$nAll = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `inbox` WHERE `odbiorca` = ".$_SESSION['user_id']));
												$nUnread = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `inbox` WHERE `read` = 0 AND `odbiorca` = ".$_SESSION['user_id']));
												?>
												<div class="row justify-content-center">
														<div class="col-12 col-md-10">
																<div class="row justify-content-center m-t-50">
																		<div class="col-md-12">
																				<ul class="nav nav-tabs" id="myTab" role="tablist">
																						<li class="nav-item"><a class="nav-link active" href="inbox">Skrzynka odbiorcza (<B><?=$nUnread;?></B>/<?=$nAll;?>)</a></li>
																				</ul>
																				<div class="tab-content">
																						<div class="tab-pane fade show active">
																								<div class="alert alert-light" style="border-left: 1px solid #dee2e6; border-right: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6;">
																									<?php
																									$sid = trim(addslashes(strip_tags($_GET['sid'])));
																									switch($sid){
																									//======================================================
																									//======================================================
																									case 1:
																										$q = mysqli_query($connect,"SELECT * FROM `inbox` WHERE `odbiorca` = '".$_SESSION['user_id']."' ORDER BY `read` ASC, `id` DESC");
																										$n = mysqli_num_rows($q);
																										if($n > 0){
																										echo "<table class='table table-striped'>";
																										echo "
																										<tr>
																											<td style='font-weight: bold;'>Data</td>
																											<td style='font-weight: bold;'>Nadawca</td>
																											<td style='font-weight: bold;'>Tytuł</td>
																										</tr>
																										";
																										while($s = mysqli_fetch_array($q)){
																											$data = $s['data'];
																											$tytul = $s['tytul'];
																											$id = $s['id'];
																											$nadawca = $s['nadawca'];
																											$read = $s['read'];
																											//---
																											$qUser = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $nadawca");
																											$sUser = mysqli_fetch_array($qUser);
																											$imieUser = $sUser['imie']." ".$sUser['nazwisko'];
																											//---
																											echo "
																											<tr style='cursor: pointer; "; if($read == "0"){echo "font-weight: bold;";} echo "' onClick=\"document.location.href='readMessage-$id'\">
																												<td style='width: 1%;' nowrap='nowrap'>$data</td>
																												<td style='width: 1%;' nowrap='nowrap'>$imieUser</td>
																												<td>$tytul</td>
																											</tr>
																											";
																										}
																										echo "</table>";
																										} else {echo "Nie masz wiadomości.";}
																									break;
																									
																									case 2:
																										$id2 = trim(addslashes(strip_tags($_GET['id'])));
																										$q2 = mysqli_query($connect,"SELECT * FROM `inbox` WHERE `id` = $id2 AND `odbiorca` = ".$_SESSION['user_id']);
																										$n2 = mysqli_num_rows($q2);
																										if($n2 > 0){
																											$s2 = mysqli_fetch_array($q2);
																											$tytul2 = $s2['tytul'];
																											$tresc2 = $s2['tresc'];
																											$data2 = $s2['data'];
																											$nadawca2 = $s2['nadawca'];
																											//---
																											$qUser2 = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $nadawca2");
																											$sUser2 = mysqli_fetch_array($qUser2);
																											$imieUser2 = $sUser2['imie']." ".$sUser2['nazwisko'];
																											//---
																											echo "
																											<B>$tytul2</B><BR>
																											<span style='font-size: 12px; color: #c3c3c3;'>$imieUser2 | $data2</span><HR style='margin-top: 0px;'>
																											$tresc2
																											<div style='clear: both; height: 10px;'></div>
																											<div style='text-align: right;'>
																												<a href='message-$nadawca2' class='btn btn-info'><i class='fa fa-envelope'></i> Odpowiedz</a>&nbsp;&nbsp;<a href='removeMessage-$id2' class='btn btn-danger'><i class='fa fa-trash'></i> Usuń wiadomość</a>
																											</div>
																											";
																											mysqli_query($connect,"UPDATE `inbox` SET `read` = 1 WHERE `id` = $id2");
																										} else {header("Location: inbox");}
																									break;
																									
																									case 3:
																										//OUTBOX
																									break;
																									
																									case 4:
																										$id3 = trim(addslashes(strip_tags($_GET['id'])));
																										mysqli_query($connect,"DELETE FROM `inbox` WHERE `id` = $id3 AND `odbiorca` = ".$_SESSION['user_id']);
																										header("Location: inbox");
																									break;
																									
																									case 5:
																										$id5 = trim(addslashes(strip_tags($_GET['id'])));
																										$q5 = mysqli_query($connect,"SELECT * FROM `notifs` WHERE `id` = $id5 AND `user_id` = ".$_SESSION['user_id']);
																										$n5 = mysqli_num_rows($q5);
																										if($n5 > 0){
																											$s5 = mysqli_fetch_array($q5);
																											$data5 = $s5['data'];
																											$tytul5 = $s5['tytul'];
																											$tresc5 = $s5['tresc'];
																											mysqli_query($connect,"UPDATE `notifs` SET `viewed` = '1' WHERE `id` = $id5");
																											echo "
																											<h5 style='margin-bottom: 0px;'>$tytul5</h5>
																											<span style='color: #bcbcbc; font-size: 12px;'>$data5</span><HR>
																											$tresc5
																											";
																										} else {header("Location: inbox");exit;}
																									break;
																									//======================================================
																									//======================================================
																									}
																									?>
																								</div>
																						</div>
																				</div>
																		</div>
																</div>
														</div>
												</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>