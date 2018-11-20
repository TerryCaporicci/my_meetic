<?php
session_start();
// var_dump($_SESSION['mail']);
if (!isset($_SESSION['mail'])) {
    header("location: sign_in.html");
}
else {
    require_once "bdd.php";
    $bdd = new BDD;
    $bdd->connect();
    $result = $bdd->getInfoUser($_SESSION['mail']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My tchoin</title>  
    
</head>
<body>
    
    <header>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">My tchoin</a>
                </li>
                
                <div>
                <li id="toggle" class="nav-link">rencontre</li>
                <ul class="dropdown">
                    <li class="nav-item"><a class="nav-link" href="rencontreH.php">homme</a></li>
                    <li class="nav-item"><a class="nav-link" href="rencontreF.php">femme</a></li>
                </ul>
                </div>
                
                <li class="nav-item">
                    <a class="nav-link " href="mon_compte.php" action="infoUser.php">mon compte</a>
                    <li class="nav-item">
                        <a class="nav-link " href="deconnexion.php">deconnexion</a>
                    </ul>
                    
                </nav>
            </header>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="jquery.js"></script>
    <div class="row">
  <div class="col-sm-6 col-md-3">
      <div class="caption">
        <form action="infoUser.php" method="POST">
            <label class="modif_formulaire">nom de famille</label>
            <input type="text" name="nom-de-famille" value=<?php echo($result['name']);?> />
            <br />
            <label class="modif_formulaire">prenom</label>
            <input type="text" name="prenom" value=<?php echo($result['surname']);?> />
            <br />
            <label class="modif_formulaire">date de naissance</label>
            <input type="date" name="date-de-naissance" value=<?php echo($result['birthdate']);?> />
            <br />
            <label class="modif_formulaire">sexe</label>
            <input type="text" name="sexe" value=<?php echo($result['sex']);?> />
            <br />
            <label class="modif_formulaire">ville</label>
            <input type="text" name="ville" value=<?php echo($result['city']);?> />
            <br />
            <label class="modif_formulaire">mail</label>
            <input type="email" name="mail" value=<?php echo($result['mail']);?> />
            <br />
            <input type="submit" value="modifier vos information" />
            
        </form>
        <form action="desactivation.php" method="POST">
            <input type="submit" value="desactiver votre compte" />
        </form>
            <p class="texte">Envie de changer de mot de passe ?<a href="verif_mdp.html">cliquer ici</a></p>
      </div>
    </div>
  </div>
</div>
</body>
</html>
