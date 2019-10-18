<!DOCTYPE html>
<html>

<head>
    <title>Anidoption</title>
    <link rel="stylesheet" href="../css/accueil.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <header>
        <div class="logo">
            <img src="../images/logo.png" alt="logo">
            <h1>Anidoption</h1>
        </div>
        <div class="espacement"></div>
        <div class="creationCompte">
            <button type="submit">Créer un compte</button>
        </div>
    </header>
    <main>
        <div class="espaceGauche"></div>
        <div class="contenu">
            <h2>Bienvenue</h2>
            <form action="accueil.php" method="POST">
                <div>
                    <label for="courriel">Adresse courriel: </label>
                    <input type="text" name="adresseCourriel" size="50" />
                </div>
                <div>
                    <label for="motDePasse">Mot de passe: </label>
                    <input type="text" name="motDePasse" id="motDePasse" size="50" />
                </div>
                <div>
                    <button type="submit">Connexion</button>
                </div>
            </form>
        </div>
        <div class="espaceDroit"></div>
    </main>

<?php
    require_once("../partial/footer.php");
?>