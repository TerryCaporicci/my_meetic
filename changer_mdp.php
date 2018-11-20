<?php

session_start();

if (!isset($_SESSION['mail'])) {
    header("location: sign_in.html");
}

require_once "bdd.php";

$bdd = new BDD;
$bdd->connect();
$result = $bdd->getInfoUser($_SESSION['mail']);
if (isset($_POST['mot-de-passe']) && isset($result['id'])) {
    $bdd->changeMdp(sha1($_POST['mot-de-passe']), $result['id']);
    header("location: mon_compte.php");
}
else {
    header("location: changer_mdp.html");
}