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
        <form action="pagePrincipaleUtilisateur.php" method="POST" class="deconnexion" enctype="multipart/form-data">
        <button type="submit" name="deconnexion">Déconnexion</button>
                
  
    </header>
    <main>
        <div class="coteGauche">
            <div class="favoris">
                <h2>Favoris</h2>
                <div class="animauxFavoris">
                    <?php
                        foreach($action->listeFavoris as $nom)
                        {
                    ?>
                    <div>
                    <p ><?= $nom ?></p>
                    </div> 
                    <?php
                        }
                    ?>
                    
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
                    <img src="../upload/<?= $action->FichePresentee["img"]?>">
                    <div class="info">
                        <p class="nom"><?= $action->FichePresentee["nom"]?></p>
                        <p class="age"><?= $action->FichePresentee["age"]?> ans</p>
                    </div>
                    <div class="boutonsChoix">
                        <div class="like">
                            <button name="like" type="submit">
                                <img id="like" src="../images/heartButton.png" />
                                <input type="hidden" name="idAnimalPhp" value= <?=$action->FichePresentee["id"]?> >
                                <input type="hidden" name="compteur" value="<?php echo $_SESSION['compteur']; ?>" />
                            </button>

                        </div>
                        <div class="nope">
                            <button name="nope" type="submit">
                                <img name="nope" type="submit" id="nope" src="../images/refusButton.png" />
                                <input type="hidden" name="compteur" value="<?php echo $_SESSION['compteur']; ?>" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </form>  
<?php
    require_once("../partial/footer.php");
?>