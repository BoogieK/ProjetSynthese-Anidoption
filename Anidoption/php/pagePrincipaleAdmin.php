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
<form action="pagePrincipaleAdmin.php" method="POST">
    <header>
        <div class="logo">
            <img src="../images/logo.png" alt="logo">
            <h1>Anidoption</h1>
        </div>
        <div class="espacement"></div>
        <div class="deconnexion">
          
            <button type="submit" name="deconnexion">Déconnexion</button>
        </div>
    </header>
    <main>
        <div class="espaceGauche">
            <div class="fichesChiens">
                <h2>Chiens</h2>
                <div id="Chiens">
                <!-- <form action="pagePrincipaleAdmin.php" method="post"> -->
                <?php
                        foreach($action->listeAdopt as $animal)
                        {
                            if ($animal[1]==2)
                            {          
                ?>
                    <p><?= $animal[2] ?>
                        <input type="hidden" name="idAdoption" value=<?= $animal[0] ?> >
                        <button type="submit" name = "supprimer" >
                            <img src="../images/poubelle.png"height="20" width="20">
                        </button>
                    </p>
                <?php
                        }
                    }
                ?>
                <!-- </form> -->
                </div>
            </div>
            <div class="fichesChats">
                <h2>Chats</h2>
                <div id="Chats">
                <?php
                        foreach($action->listeAdopt as $animal)
                        {
                            if ($animal[1]==1)
                            {
                    ?>
                    <p><?= $animal[2] ?>
                        <input type="hidden" name="idAdoption" value=<?= $animal[0] ?> >
                        <button type="submit" name = "supprimer" >
                            <img src="../images/poubelle.png"height="20" width="20">
                        </button>
                    </p>
                    <?php
                        }
                    }
                    ?>

                </div>
            </div>
        </div>

        <div class="contenu">
            
                <h1>Creation de profil</h1>
                <div>
                    <p>Quelle espèce voulez-vous mettre en adoption?</p> 
                
                    <p>Chien<input type="radio" name="animalFavori" id="favoriChien" value="chien"/></p>
                    
                    <p>Chat<input type="radio" name="animalFavori" id="favoriChat" value="chat"/></p>
                </div>
          
        </div>
        <div class="espaceDroit">
            <button type="submit" name="suivant">Suivant</button>
        </div>
    </main>
    </form>
<?php
    require_once("../partial/footer.php");
?>