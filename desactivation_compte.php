<?php
session_start();
// var_dump($_SESSION['mail']);
if (!isset($_SESSION['mail'])) {
    header("location: sign_in.html");
}

require_once "bdd.php";
// var_dump($_POST);
$bdd = new BDD;
$bdd->connect();
$result = $bdd->getInfoUser($_SESSION['mail']);
$bdd->desactivation($result['id']);
// var_dump($bdd->desactivation($_SESSION['id']));
session_destroy();
session_unset();
header("location: sign_in.html");