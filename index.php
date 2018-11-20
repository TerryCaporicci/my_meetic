<?php
session_start();
// var_dump($_SESSION['mail']);
if (!isset($_SESSION['mail'])) {
    header("location: sign_in.html");
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
        </body>
</html>