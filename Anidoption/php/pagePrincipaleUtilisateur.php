<?php

    require_once("../action/PagePrincipaleUtilisateurAction.php");
	$action = new PagePrincipaleUtilisateurAction();
    $action->execute();
    
?> 

<!DOCTYPE html>
<html>

<head>
    <title>Anidoption</title>
    <link rel="stylesheet" href="../css/pagePrincipaleUtilisateur.css">
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
            <div class="deconnexion">
                <!-- <button type="submit" name="deconnexion">Déconnexion</button> -->
                <?php
						if ($action->isLoggedIn()) {
							?>
							<div>
								[
								<a href="?logout=true">Déconnexion</a>
								]
							</div>
							<?php
						}
					?>
            </div>
    </header>
    <main>
        <div class="coteGauche">
            <div class="favoris">
                <h2>Favoris</h2>
                <div class="animauxFavoris">

                </div>
                <div class="parametres">
                    <img src="../images/settingsButton.png" alt="">
                    <h3>Paramètres</h3>
                </div>
            </div>
        </div>
        <div class="contenu">
            <div class="ficheAnimal">
                <div class="affichage">
                    <img src="../images/boogie.jpeg" alt="boogie">
                    <div class="info">
                        <p class="nom">Boogie</p>
                        <p class="age">13 ans</p>
                    </div>
                    <div class="boutonsChoix">
                        <div class="like">
                            <!-- <button  src="../images/heartButton.png" type="submit"></button> -->
                            <input type="image" id="like" src="../images/heartButton.png">
                        </div>
                        <div class="nope">
                            <input type="image" id="nope" src="../images/refusButton.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php
    require_once("../partial/footer.php");
?>