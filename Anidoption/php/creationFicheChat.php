<?php
    
    require_once("../action/CreationFicheChatAction.php");
	$action = new CreationFicheChatAction();
    $action->execute();
    
?> 

<!DOCTYPE html>
<html>
    <head>
        <title>Anidoption</title>
        <link rel="stylesheet" href="../css/creationFicheChat.css">
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
            <div class="creationCompte">
                    <button type="submit">Créer un compte</button>
            </div>
        </header>

<main>

            <div class="espaceGauche">
                <button type="submit" name = "precedent"><a href="pagePrincipaleAdmin.php">Précédent</a></button>
            </div>
            <div class="contenu">
            <h2>- Compte -</h2>
            <h3>.: Chats :. </h3>
            <form action="creationFicheChat.php" method="POST" enctype="multipart/form-data">
            <div class="centrerImage">
            <div class=texteBase>
                <div>
                <label for="nom">Nom:</label>
                <input type="text" name="nom">
                </div>
                <div>
                <label for="age">Age:</label>
                <input type="text" name="age">
                </div>
                    <div>
                    <label for="sexe">Sexe: </label>
                    <select name="choixSexe">
                        <option value="male">Male</option>
                        <option value="femelle">Femelle</option>
                    </select>
                    </div>    
                    <div>
                    <label for="griffes">Griffes: </label>
                    <select name="choixGriffes">
                        <option value="pattesAvants">Dégriffé aux pattes avants</option>
                        <option value="pattesArrieres">Dégriffé aux pattes arrières</option>
                        <option value="pattes">Dégriffé aux 4 pattes</option>
                        <option value="sansPreference">Sans importance</option>
                    </select>
                    </div>  
                    <div>
                    <label for="besoinsToilettage">Toilettage: </label>
                    <select name="choixToilettage">
                        <option value="faible">Faible</option>
                        <option value="moyen">Moyen</option>
                        <option value="eleve">Élevé</option>
                    </select>
                    </div>
                </div>
                <div class="image">
                <div>
                    Image:
                    <input type="file" name="imageAnimal" />
                </div>  
                </div>
                <div class="basPageContenu">
                <div class="adoptionMultiple">
                    <label for="frereSoeur">Frère ou soeur:</label>
                    <br>
                    <div class="boutonsRadio">
                        <input type="radio" name="reponse2Chats" id="reponse2Chats" value="oui"/>Oui
                        <input type="radio" name="reponse2Chats" id="reponse2Chats" value="non"/>Non
                    </div>
                </div>
                <div class="caracteres">
                    <label for="caractere">Caractères:</label>
                    <br>
                    <input type="checkbox" name='caracteres[]' value="peureux" /> Peureux<br/>
                    <input type="checkbox" name='caracteres[]' value="manipulation" /> N'aime pas les manipulations<br/>
                    <input type="checkbox" name='caracteres[]' value="besoinAttention" /> Besoin d'attention<br/>
                    <input type="checkbox" name='caracteres[]' value="calme" /> Calme<br/>
                    <input type="checkbox" name='caracteres[]' value="aimeCaresse" /> Aime les caresses<br/>
                    <input type="checkbox" name='caracteres[]' value="aimeBrossage" /> Aime être brossé<br/>
                </div>
                <br>
                </div>
                </div>
                </div>
            <div class="espaceDroit">
            <button type="submit" name="enregistrer">Enregistrer</button>
                        
        </div>
            </form>
        </main>
        <?php
        require_once("../partial/footer.php");
        ?>