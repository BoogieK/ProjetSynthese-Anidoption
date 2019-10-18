
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
            <div class="creationCompte">
                    <button type="submit">Créer un compte</button>
            </div>
        </header>

<main>
            <div class="espaceGauche">
                <button type="submit">Annuler</button>
            </div>
            <div class="contenu">
            <h2>- Compte -</h2>
            <form action="creationCompte.php" method="POST">
                <div>
                    <label for="prenom">Prenom: </label>
                    <input type="text" name="prenom" id="prenom" size="100"/>
                </div>    
                <div>
                    <label for="nom">Nom: </label>
                    <input type="text" name="nom" id="nom" size="100"/>
                </div>
                <div>
                    <label for="courriel">Adresse courriel: </label>
                    <input type="text" name="adresseCourriel" id="adresseCourriel" size="100"/>
                </div>
                <div>
                    <label for="motDePasse">Mot de passe: </label>
                    <input type="text" name="motDePasse" id="motDePasse" size="100"/>
                </div>
                <div>
                    <label for="confirmationMotDePasse">Confirmation du passe: </label>
                    <input type="text" name="confirmationMotDePasse" id="confirmationMotDePasse" size="100"/>
                </div>
                <br>
                <div>
                    <p>De quelle espèce voulez-vous votre compagnon? </p>
                    
                    <input type="radio" name="animalFavori" id="favoriChien" value="chien"/>Chien
                    <input type="radio" name="animalFavori" id="favoriChat" value="chat"/>Chat
                    
                </div>
            </form>

        </div>
            <div class="espaceDroit">
                    
                          
                            <button type="submit">Suivant</button>
                        
            </div>
        </main>
        <?php
        require_once("../partial/footer.php");
        ?>