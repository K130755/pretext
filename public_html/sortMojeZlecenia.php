<?php
ob_start();
session_start();
$sort = trim(addslashes(strip_tags($_GET['sort'])));
$_SESSION['sortMojeZlecenia'] = $sort;
header("Location: mojeZlecenia");
?>