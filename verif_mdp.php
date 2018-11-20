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
$verif = $bdd->verifMdp(sha1($_POST['mot-de-passe']), $result['id']);
    // var_dump($_POST['mot-de-passe']);
    // var_dump($_SESSION['id']);
    
if ($verif == FALSE ) {
    
    header('location: verif_mdp.html');
}
else {
    header('location: changer_mdp.html');
}