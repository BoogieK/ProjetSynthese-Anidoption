<?php

    require_once("../action/IndexAction.php");
	$action = new IndexAction();
    $action->execute();
    
?> 

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
        <form action="index.php" method="post" class="creationCompte">
			<button type="submit" name="creerCompte"> Créer un compte</button>
		</form>
    </header>
    <main>
        <div class="espaceGauche"></div>
        <div class="contenu">
            <h2>Bienvenue</h2>
            <?php
                if ($action->wrongLogin)
                {
			?>
            <div id="error-div"><strong>Erreur : </strong>Les informations fournies sont invalides</div>
            <br>
			<?php
			    }
		    ?>
            <form action="index.php" method="POST">
                <div>
                    <label for="courriel">Adresse courriel: </label>
                    <input type="text" name="adresseCourriel" id="adresseCourriel" size="60" style="height:25px;"/>
                </div>
                <div>
                    <label for="motDePasse">Mot de passe: </label>
                    <input type="password" name="motDePasse" id="motDePasse" size="60" style="height:25px;" />
                </div>
                <div>
                    <button type="submit" class="connexion">Connexion</button>
                </div>
            </form>
        </div>
        <div class="espaceDroit"></div>
    </main>

<?php
    require_once("../partial/footer.php");
?> 