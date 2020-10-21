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
        
				<div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-auto">
                        <div class="saldo">
                            <div class="title">Suma Twoich wypłat:</div>
                            <div class="value"><?php
															$qSumaWyplat = mysqli_query($connect,"SELECT SUM(kwota) AS sumkwota FROM `wallet_counter` WHERE `user_id` = ".$_SESSION['user_id']." AND `out` = '1'");
															$sSumaWyplat = mysqli_fetch_array($qSumaWyplat);
															echo number_format($sSumaWyplat['sumkwota'],2);
														?> &#122;&#322;</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-auto">
                        <div class="saldo">
                            <div class="title">Suma Twoich wpłat:</div>
                            <div class="value"><?php
															$qSumaWplat = mysqli_query($connect,"SELECT SUM(kwota) AS sumkwota FROM `wallet_counter` WHERE `user_id` = ".$_SESSION['user_id']." AND `in` = '1'");
															$sSumaWplat = mysqli_fetch_array($qSumaWplat);
															echo number_format($sSumaWplat['sumkwota'],2);
														?> &#122;&#322;</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="header">Zestawienie operacji</div>
                    </div>
                </div>
                <div class="mobile-scrl-x">
                    <table class="table table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th>Data wygenerowania</th>
                                <th>Nr płatności</th>
                                <th>Tytuł</th>
                                <th>Kwota</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
														$qHistory = mysqli_query($connect,"SELECT * FROM `wallet_history` WHERE `user_id` = ".$_SESSION['user_id']." ORDER BY `data` DESC");
														$nHistory = mysqli_num_rows($qHistory);
														if($nHistory > 0){
															while($sHistory = mysqli_fetch_array($qHistory)){
																$kwotaHistory = $sHistory['kwota'];
																	if($kwotaHistory < 0){$kwotaHistory = "<span style='color: #a40000;'>$kwotaHistory</span>";}
																$opisHistory = $sHistory['opis'];
																$dataHistory = $sHistory['data'];
																$idHistory = $sHistory['id'];
																
																echo "
																<tr>
																	<td>$dataHistory</td>
																	<td>$idHistory</td>
																	<td>$opisHistory</td>
																	<td>$kwotaHistory</td>
																	<td>Zrealizowano</td>
																	<td>-</td>
																</tr>
																";
															}
														} else {
															echo "
															<tr>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
															</tr>
															";
														}
														?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
				
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>