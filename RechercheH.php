<?php
require_once "bdd.php";
$bdd = new BDD;
$bdd->connect();
$bdd->rechercheHomme($_POST['name'],$_POST['surname']);
$bdd->rechercheVille($_POST['city']);
?>