<?php include("inc/head.php"); ?>

<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/top.php"); ?>
    <div class="container login-container">
			<?php if(empty($_SESSION['user_id'])){header("Location: login");} ?>
			<h3>Ulubieni użytkownicy</h3>
        <div class="row">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9 col-lg-8 pd-t-35">
                        <?php
												showRespond($_GET['error'],$_GET['correct']);
												
												$qFav = mysqli_query($connect,"SELECT * FROM `favourites` WHERE `user_id` = ".$_SESSION['user_id']);
												$nFav = mysqli_num_rows($qFav);
												if($nFav > 0){
													while($sFav = mysqli_fetch_array($qFav)){
														$id = $sFav['lubiany'];
														$q = mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = $id");
														$n = mysqli_num_rows($q);
														if($n > 0){
															$s = mysqli_fetch_array($q);
															$show_name = $s['show_name'];
															if($show_name != "1"){
															$imie = $s['imie']." ".substr($s['nazwisko'],0,1).".";
															$nick = $s['nick'];
																if(empty($nick)){$nick = $imie;}
															} else {
																$nick = $s['imie']." ".$s['nazwisko'];
															}
															$data = $s['data'];
															$mocne_strony = $s['mocne_strony'];
															$mocne_strony = mb_substr($mocne_strony,1);
															$mocne_strony = str_replace(",",", ",$mocne_strony);
															if(empty($mocne_strony)){$mocne_strony = "-";}
															$img = $s['img'];
																if(empty($img)){$img = "no_photo.png";}
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
															<a href="orderText-<?=$id;?>" class="btn btn-primary"><i class="fa fa-cogs"></i> Zleć tekst</a>&nbsp;&nbsp;
															<a href="removeFavourites-<?=$id;?>" class="btn btn-danger"><i class="fa fa-trash"></i> Usuń z listy</a>
														</div>
														<HR>
														<?php
														}
													}
												} else {header("Location: dashboard?error=Nie polubiłeś żadnych użytkowników!");}
												?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>