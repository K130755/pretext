<?php
ob_start();
session_start();
$id = trim(addslashes(strip_tags($_GET['id'])));
$_SESSION['wykonawca'] = $id;
header("Location: postTekst");
?>