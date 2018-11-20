<?php 
require_once "bdd.php";
// var_dump($_POST);
$bdd = new BDD;
$bdd->connect();
$verif = $bdd->getUser($_POST['mail'],sha1($_POST['mot-de-passe']));
var_dump(count($verif));
if ($verif == FALSE ) {
    
    header('Location: sign_in.html');
    exit(); 
}
else {
    $result = $bdd->getInfoUser($_POST['mail']);
    session_start();
    $_SESSION['mail'] = $_POST['mail'];
    if ($result['isDesact'] == 1) {

        header("location: infoDesactivation.html");
        
    } 
    
    else {
    header('Location: index.php');
    exit();
    }
}