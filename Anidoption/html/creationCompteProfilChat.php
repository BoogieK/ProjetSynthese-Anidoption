<!DOCTYPE html>
<html>
    <head>
        <title>Anidoption</title>
        <link rel="stylesheet" href="../css/creationCompteProfilChat.css">
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
                <button type="submit">Précédent</button>
            </div>
            <div class="contenu">
            <h2>- Compte -</h2>
            <h3>.: Chats :. </h3>
            <form action="creationCompteProfilChat.php" method="POST">
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
                    <label for="besoinsToilettage">Besoins en toilettage: </label>
                    <select name="choixToilettage">
                        <option value="faible">Faible</option>
                        <option value="moyen">Moyen</option>
                        <option value="eleve">Élevé</option>
                    </select>
                </div>  
                <div class="adoptionMultiple">
                    <label for="frereSoeur">Seriez-vous prêt a adopter deux chats si l'un a besoin de l'autre pour être heureux?</label>
                    <br>
                    <div class="boutonsRadio">
                        <input type="radio" name="reponse2Chats" id="reponse2Chats" value="oui"/>Oui
                        <input type="radio" name="reponse2Chats" id="reponse2Chats" value="non"/>Non
                    </div>
                </div>
                <div class="caracteres">
                    <label for="caractere">Êtes-vous intéressé a adopter un chat:</label>
                    <br>
                    <input type="checkbox" name="peureux" value="oui" /> Peureux<br/>
                    <input type="checkbox" name="pasManipulation" value="oui" /> N'aime pas les manipulations<br/>
                    <input type="checkbox" name="attention" value="oui" /> Besoin d'attention<br/>
                    <input type="checkbox" name="calme" value="oui" /> Calme<br/>
                    <input type="checkbox" name="aimeCaresses" value="oui" /> Aime les caresses<br/>
                    <input type="checkbox" name="brossage" value="oui" /> Aime être brossé<br/>
                </div>
                <br>
            </form>

        </div>
            <div class="espaceDroit">
                    
                          
                            <button type="submit">Enregistrer</button>
                        
            </div>
        </main>
        <?php
        require_once("../partial/footer.php");
        ?>