<?php
    require_once("../action/PagePrincipaleAdminAction.php");
	$action = new PagePrincipaleAdminAction();
    $action->execute();
?> 

<!DOCTYPE html>
<html>

<head>
    <title>Anidoption</title>
    <link rel="stylesheet" href="../css/pagePrincipaleAdmin.css">
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
        <form action="pagePrincipaleAdmin.php" method="POST">
            <div class="deconnexion">
                <button type="submit" name="deconnexion">Déconnexion</button>
            </div>
        </form>
    </header>

    <main>
        <div class="espaceGauche">
            <div class="fichesChiens">
                <h2>Chiens</h2>
                <?php
                    foreach($action->listeAdopt as $animal)
                    {
                        if ($animal[1]==2)
                        {          
                ?>
                <form action="pagePrincipaleAdmin.php" method="POST">
                    <div id="Chiens">
                        <p><?=$animal[2]?>
                            <input type="hidden" name="idAnimal" value=<?= $animal[0] ?> >
                            <button type="submit" name="adoption">
                                <img src="../images/poubelle.png" height="25" width="25">
                            </button>
                        </p> 
                    </div>
                </form>
                <?php
                        }
                    }
                ?>  
            </div>
            <div class="fichesChats">
                <h2>Chats</h2>
                <?php
                    foreach($action->listeAdopt as $animal)
                    {
                        if ($animal[1]==1)
                        {          
                ?>
                <form action="pagePrincipaleAdmin.php" method="POST">
                    <div id="Chats">
                        <p><?=$animal[2]?>
                            <input type="hidden" name="idAnimal" value=<?= $animal[0] ?> >
                            <button type="submit" name="adoption">
                                <img src="../images/poubelle.png" height="25" width="25">
                            </button>
                        </p>   
                    </div>
                </form> 
                <?php
                        }
                    }
                ?>
            </div>
        </div>
        <form action="pagePrincipaleAdmin.php" method="POST" class="contenu">
            <h1>Creation de profil</h1>
            <div>
                <p>Quelle espèce voulez-vous mettre en adoption?</p> 
            
                <p>Chien<input type="radio" name="animalFavori" id="favoriChien" value="chien"/></p>
                    
                <p>Chat<input type="radio" name="animalFavori" id="favoriChat" value="chat"/></p>
            </div>
            <div class="espaceDroit">
                <button type="submit" name="suivant" >Suivant</button>
            </div>
        </form>
    </main>
<?php
    require_once("../partial/footer.php");
?>