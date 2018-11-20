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
$age = $bdd->verifAge($_POST['date-de-naissance']);
$resultat = $bdd->verifMail($_POST['mail']);
if ($age->age >= 18 && $age->age <= 100 && $resultat == FALSE) {
$bdd->modifInfoUser($_POST['nom-de-famille'],$_POST['prenom'],$_POST['date-de-naissance'],$_POST['sexe'],$_POST['ville'],$_POST['mail'],$result['id']);
    if ($_SESSION['mail'] !== $_POST['mail']) {
    session_start();
    $_SESSION['mail'] = $_POST['mail'];
    header('location: index.php');
    }
    else {
        header('location: index.php');
    }
    
}
else {
    header('location: mon_compte.php');
}

?>