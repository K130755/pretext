<?php include("inc/head.php"); ?>

<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/top.php"); ?>
    <div class="container login-container">
        <div class="row">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9 col-lg-8 pd-t-35">
                        <?php
												showRespond($_GET['error'],$_GET['correct']);
												if(empty($_SESSION['user_id'])){header("Location: login");}
												
												$id = trim(addslashes(strip_tags($_GET['id'])));
												$q = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $id");
												$n = mysqli_num_rows($q);
												if($n > 0){
													$s = mysqli_fetch_array($q);
													$show_name = $s['show_name'];
													if($show_name != "1"){
													$imie = $s['imie']." ".substr($s['nazwisko'],0,1).".";
													$nick = $s['nick'];
														if(empty($nick)){$nick = $imie;}
													} else {$nick = $s['imie']." ".$s['nazwisko'];}
													$data = $s['data'];
													$mocne_strony = $s['mocne_strony'];
													$mocne_strony = mb_substr($mocne_strony,1);
													$mocne_strony = str_replace(",",", ",$mocne_strony);
													if(empty($mocne_strony)){$mocne_strony = "-";}
													$img = $s['img'];
														if(empty($img)){$img = "no_photo.png";}
												} else {header("Location: users");}
												?>
												<div class="row row-special-head">
                            <div class="col-12">
                                <div class="special-head">Użytkownik <?=$nick;?></div>
                            </div>
                        </div>
												
												<img src="images/users/<?=$img;?>" style="float: left; max-width: 100px; max-height: 100px; margin-right: 10px;">
												<h4><?=$nick;?></h4>
												Data dołączenia: <?=$data;?>
												<HR>
												<B>Mocne strony:</B><BR><?=$mocne_strony;?>
												<div style="text-align: right; margin-top: 10px;">
													<a href="message-<?=$id;?>" class="btn btn-info"><i class="fa fa-envelope"></i> Wyślij wiadomość</a>&nbsp;&nbsp;
													<a href="orderText-<?=$id;?>" class="btn btn-primary"><i class="fa fa-cogs"></i> Zleć tekst</a>
													<?php if(mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `favourites` WHERE `lubiany` = $id AND `user_id` = ".$_SESSION['user_id'])) == 0){ ?>&nbsp;&nbsp;<a href="addFavourites-<?=$id;?>" class="btn btn-default"><i class="fa fa-star"></i> Dodaj do ulubionych</a><?php } ?>
												</div>
												<?php
												$qPortfolio = mysqli_query($connect,"SELECT * FROM `portfolio` WHERE `user_id` = $id");
												$nPortfolio = mysqli_num_rows($qPortfolio);
												if($nPortfolio > 0){
													echo "<HR>";
													echo "<h4><B>Portfolio</B></h4>";
													while($sPortfolio = mysqli_fetch_array($qPortfolio)){
														$tytulPortfolio = $sPortfolio['tytul'];
														$trescPortfolio = $sPortfolio['tresc'];
														$idPortfolio = $sPortfolio['id'];
														echo "
														<div style='padding: 10px; font-weight: bold; font-size: 16px; background: #f8f8f8; border: 1px solid #f3f3f3; margin-bottom: 5px; cursor: pointer;' onClick=\"document.getElementById('tresc$idPortfolio').style.display='block';\">$tytulPortfolio</div>
														<div style='display: none; border: 1px solid #f3f3f3; padding: 10px; margin-bottom: 15px;' id='tresc$idPortfolio'>$trescPortfolio</div>
														";
													}
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