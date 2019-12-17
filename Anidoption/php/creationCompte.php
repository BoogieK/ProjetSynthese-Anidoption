<?php

    require_once("../action/CreationCompteAction.php");
	$action = new CreationCompteAction();
    $action->execute();
    
?> 


<!DOCTYPE html>
<html>
    <head>
        <title>Anidoption</title>
        <link rel="stylesheet" href="../css/creerCompte.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <body>
        <header>
            <div class="logo">
                <img src="../images/logo.png" alt="logo" >
                <h1>Anidoption</h1>
            </div>
            <div class="espacement"></div>
            <form action="index.php" method="post" class="creationCompte">
			<button type="submit" name="creerCompte"> Créer un compte</button>
		</form>
        </header>

<main>
    <form action="creationCompte.php" method="POST" class="espaceGauche">
        <button type="submit"><a href="index.php">Annuler</a></button>
    </form>       
    <div class="contenu">
        <h2>- Compte -</h2>
        <form action="creationCompte.php" method="POST">
            <div>
                <label for="prenom">Prenom: </label>
                <input type="text" name="prenom" id="prenom" size="30" style="height:25px;"/>
            </div>
            <div>
                <label for="nom">Nom: </label>
                <input type="text" name="nom" id="nom" size="30" style="height:25px;"/>
            </div>
            <div>
                <label for="courriel">Adresse courriel: </label>
                <input type="text" name="adresseCourriel" id="adresseCourriel" size="46" style="height:25px;"/>
            </div>
            <div>
                <label for="motDePasse">Mot de passe: </label>
                <input type="password" name="motDePasse" id="motDePasse" size="51" style="height:25px;"/>
            </div>
            <div>
                <label for="confirmationMotDePasse">Confirmation du passe: </label>
                <input type="password" name="confirmationMotDePasse" id="confirmationMotDePasse" size="40" style="height:25px;"/>
            </div>
        <br>
        <div>
            <p>De quelle espèce voulez-vous votre compagnon? </p>
            <input type="radio" name="animalFavori" id="favoriChien" value="chien"/>Chien
            <input type="radio" name="animalFavori" id="favoriChat" value="chat"/>Chat
        </div>
    </div>
    <div class="espaceDroit">
    <button type="submit" name="suivant">Suivant</button>
    </form>   
                          
           
                        
            </div>
        </main>
        <?php
        require_once("../partial/footer.php");
        ?>