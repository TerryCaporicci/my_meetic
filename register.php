<?php 
require_once "bdd.php";
// var_dump($_POST);
$bdd = new BDD;
$bdd->connect();

$age = $bdd->verifAge($_POST['date-de-naissance']);
$result = $bdd->verifMail($_POST['mail']);
if ($age->age >= 18 && $age->age <= 100 && $result == FALSE) {
    $bdd->insertUser($_POST['nom-de-famille'],$_POST['prenom'],$_POST['date-de-naissance'],$_POST['sexe'],$_POST['ville'],$_POST['mail'],sha1($_POST['mot-de-passe']));
    // header('location: sign_in.html');
}
else {
    echo "mail already use, please use another mail";
    // header('location: register.html');
    }
