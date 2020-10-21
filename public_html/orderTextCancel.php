<?php
ob_start();
session_start();
$_SESSION['wykonawca'] = "0";
header("Location: postTekst");
?>