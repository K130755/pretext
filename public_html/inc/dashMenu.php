<?php
$request_uri = $_SERVER['REQUEST_URI'];
$request_uri = str_replace("/","",$request_uri);
$request_uri = str_replace("pretext","",$request_uri);
$request_uri = str_replace(" ","",$request_uri);
?>
<div class="col-6 col-md"><a href="dashboard" <?php if($request_uri == "dashboard"){echo 'class="active"';} ?>>Moje dane</a></div>
<div class="col-6 col-md"><a href="wallet" <?php if($request_uri == "wallet"){echo 'class="active"';} ?>>Portfel</a></div>
<div class="col-6 col-md"><a href="history" <?php if($request_uri == "history"){echo 'class="active"';} ?>>Historia</a></div>
<div class="col-6 col-md"><a href="inbox" <?php if($request_uri == "inbox"){echo 'class="active"';} ?>>Wiadomości <?php $nInbox = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `inbox` WHERE `odbiorca` = '".$_SESSION['user_id']."' AND `read` = 0")); echo "($nInbox)"; ?></a></div>
<div class="col-6 col-md"><a href="mojeZlecenia" <?php if($request_uri == "mojeZlecenia"){echo 'class="active"';} ?>>Moje zlecenia</a></div>