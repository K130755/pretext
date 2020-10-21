<?php include("inc/head.php"); ?>

<body class="devDesktop no-color chrome home_index type_default desktop " style="<?php if(!empty($_COOKIE['background'])){echo "background: ".$_COOKIE['background'].";";} ?>">
    <?php include("inc/top.php"); ?>
    <div class="container page">
        <div class="row">
            <div class="col-12">
                <!--HTML BLOCK START-->
                <h1 class="special-head">Pytania i odpowiedzi</h1>
                <div>
                    <p><i class="fa fa-info-circle"></i> Poniżej przedstawiamy najczęściej zadawane pytania przez naszych Użytkowników oraz odpowiedzi na nie. Jeżeli nie znalazłeś rozwiązania swojego problemu lub chciałbyś zadać nam swoje pytanie, skorzystaj w formularza kontaktowego w dziale <a href="kontakt">Kontakt.</a></p>
                </div>
                <div class="accordion" id="accordionPytania">
                    <?php
										$q = mysqli_query($connect,"SELECT * FROM `faq` ORDER BY `id` ASC");
										$n = mysqli_num_rows($q);
										if($n > 0){
											while($s = mysqli_fetch_array($q)){
												$id = $s['id'];
												$pytanie = $s['pytanie'];
												$odpowiedz = $s['odpowiedz'];
												echo '
												<div class="card">
														<div class="card-header" id="heading'.$id.'">
																<h2 class="mb-0"><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse'.$id.'" aria-expanded="true" aria-controls="collapse'.$id.'"> '.$pytanie.' </button></h2></div>
														<div id="collapse'.$id.'" class="collapse" aria-labelledby="heading'.$id.'" data-parent="#accordionPytania">
																<div class="card-body"> '.$odpowiedz.' </div>
														</div>
												</div>
												';
											}
										} else {errorIMG("Strona w budowie!");}
										?>
                </div>
                <!--HTML BLOCK END-->
                <!--HTML BLOCK START-->
                <p>
                    <br>
                </p>
                <!--HTML BLOCK END-->
            </div>
        </div>
    </div>
    <?php include("inc/footer.php"); ?>
</body>
</html>