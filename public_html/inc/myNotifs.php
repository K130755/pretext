<?php
ob_start();
session_start();
include("../admin/inc/conn.php");
							echo '<a href="javascript:;" onClick="document.getElementById(\'myNotifs\').style.display=\'none\';document.getElementById(\'myNotifs2\').style.display=\'none\';"><i class="fa fa-times" style="font-size: 17px; color: #6f6f6f; float: right;"></i></a>
										<div style="clear: both;"></div>
										';
										$nBell = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `notifs` WHERE `user_id` = '".$_SESSION['user_id']."' AND `viewed` = 0"));
										if($nBell > 0){
										echo '<div style="clear: both; height: 10px;"></div>';
											$qNotifs = mysqli_query($connect,"SELECT * FROM `notifs` WHERE `user_id` = ".$_SESSION['user_id']." AND `viewed` = '0'");
											$lpNotifs = 0;
											while($sNotifs = mysqli_fetch_array($qNotifs)){
											$lpNotifs++;
												$tytulNotifs = $sNotifs['tytul'];
												$idNotifs = $sNotifs['id'];
												echo "<a href='notif-$idNotifs' class='myNotifLink' style='text-decoration: none;'><i class='fas fa-bell' style='color: #c4c4c4;'></i> $tytulNotifs</a><HR style='margin-top: 4px; margin-bottom: 7px;'>";
											}
										} else {
											echo "<CENTER><B>Brak powiadomień</B></CENTER>";
										}
?>
<script type="text/javascript">
	document.getElementById('notifBell').innerHTML = '<i class="fas fa-bell"></i><span style="font-size: 11px; <?php if($nBell > 0){echo "color: #e60000;";} else {echo "color: #fff; display: none;";} ?>"><?=$nBell;?></span>';
	document.getElementById('notifBell2').innerHTML = '<i class="fas fa-bell"></i><span style="font-size: 11px; <?php if($nBell > 0){echo "color: #e60000;";} else {echo "color: #fff; display: none;";} ?>"><?=$nBell;?></span>';
</script>