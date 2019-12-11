<?php

    require_once("../action/CreationFicheChienAction.php");
	$action = new CreationFicheChienAction();
    $action->execute();
    
?> 

<!DOCTYPE html>
<html>
    <head>
        <title>Anidoption</title>
        <link rel="stylesheet" href="../css/creationFicheChien.css">
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
            <h3>.: Chiens :. </h3>
            <form action="creationFicheChien.php" method="POST" enctype="multipart/form-data">
            <div class="centrerImage">
                <div class="texteBase">
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
                    <label for="taille">Taille: </label>
                    <select name="choixTaille">
                        <option value="petit">Petit</option>
                        <option value="moyen">Moyen</option>
                        <option value="grand">Grand</option>
                    </select>
                </div>  
                </div>
                <br>
                <div class="image">
                    <div>
                        Image:
                        <input type="file" name="imageAnimal" />
                    </div>  
                </div>
                <br>
                <div class="basPageContenu">
                    <div class="enfants">
                        <label for="enfant">Adéquat avec les enfant(s) de -16 ans?</label>
                        <br>
                        <div class="boutonsRadio">
                            <input type="radio" name="reponseEnfant" id="reponseEnfant" value="oui"/>Oui
                            <input type="radio" name="reponseEnfant" id="reponseEnfant" value="non"/>Non
                        </div>
                    </div>
                    <br>
                    <div class="ados">
                        <label for="ados">Adéquat avec les enfant(s) de +16 ans?</label>
                        <br>
                        <div class="boutonsRadio">
                            <input type="radio" name="reponseAdo" id="reponseAdo" value="oui"/>Oui
                            <input type="radio" name="reponseAdo" id="reponseAdo" value="non"/>Non
                        </div>
                    </div>
                    <br>
                    <div class="animauxAutres">
                        <label for="animauxAutres">Amical avec les: </label>
                        <br>
                        <div class="boutonsRadio">
                            <label for="autreAnimauxChats" class="autresAnimaux">Chats</label>
                            <input type="radio" name="reponseAnimauxAutresChats" id="reponseAnimauxAutres" value="oui"/>Oui
                            <input type="radio" name="reponseAnimauxAutresChats" id="reponseAnimauxAutres" value="non"/>Non
                            <input type="radio" name="reponseAnimauxAutresChats" id="reponseAnimauxAutres" value="indetermine"/>Indéterminé
                            <br>
                            <label for="autreAnimauxChiens" class="autresAnimaux">Chiens</label>
                            <input type="radio" name="reponseAnimauxAutresChiens" id="reponseAnimauxAutres" value="oui"/>Oui
                            <input type="radio" name="reponseAnimauxAutresChiens" id="reponseAnimauxAutres" value="non"/>Non
                            <input type="radio" name="reponseAnimauxAutresChiens" id="reponseAnimauxAutres" value="indetermine"/>Indéterminé
                        </div>
                    </div>
                    <br>
                    <div>
                        <label for="temps">Besoins en exercices: </label>
                        <select name="choixHeure">
                            <option value="heure12">Entre 1 et 2 heures</option>
                            <option value="heure23">Entre 2 et 3 heures</option>
                            <option value="heure3+">Plus de 3 heures</option>
                        </select>
                    </div>
                    <br>
                    <div class="disponibilite">
                        <label for="disponibilite">Capacité a rester seul:</label>
                        <br>
                        <div class="boutonsRadio">
                            <input type="radio" name="reponseDispo" id="reponseDispo" value="oui"/>Oui
                            <input type="radio" name="reponseDispo" id="reponseDispo" value="non"/>Non
                        </div>
                    </div> 
                    <br>
                    <div class="caracteres">
                        <label for="caractere">Entrainements requis:</label>
                        <br>
                        <input type="checkbox" name='choixEntrainement[]' value="possession" /> Possession<br/>
                        <input type="checkbox" name='choixEntrainement[]' value="solitude" /> Rester seul à la maison<br/>
                        <input type="checkbox" name='choixEntrainement[]' value="manipulation" /> Manipulations<br/>
                        <input type="checkbox" name='choixEntrainement[]' value="marcheLaisse" /> Marche en laisse<br/>
                        <input type="checkbox" name='choixEntrainement[]' value="proprete" /> Propreté<br/>
                        <input type="checkbox" name='choixEntrainement[]' value="jappements" /> Jappements<br/>
                        <input type="checkbox" name='choixEntrainement[]' value="commandesBases" /> Commandes de bases<br/>
                        <input type="checkbox" name='choixEntrainement[]' value="cage" /> Introduction à la cage<br/>
                        <input type="checkbox" name='choixEntrainement[]' value="selfControl" /> Auto-contrôle<br/>
                        <input type="checkbox" name='choixEntrainement[]' value="foodProtect" /> Protection de la nourriture<br/>
                    </div>
                    <br>
                    <div>
                        <label for="domicile">Peut vivre dans:</label>
                        <select name="choixDomicile">
                            <option value="petit">Appartement</option>
                            <option value="moyen">Maison</option>
                        </select>
                    </div>
                    <br>
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