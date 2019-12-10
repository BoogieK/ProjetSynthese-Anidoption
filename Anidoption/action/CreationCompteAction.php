<?php
	require_once("CommonAction.php");
	require_once("DAO/UtilisateursDAO.php");
	require_once("DAO/ComplementsDAO.php");
	
	class CreationCompteAction extends CommonAction
	{
		public function __construct()
		{
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

        protected function executeAction()
        {
            if (isset($_POST["suivant"]))
			{
				if (isset($_POST["prenom"]) &&
						isset($_POST["nom"]) &&
							isset($_POST["adresseCourriel"]) &&
								isset($_POST["motDePasse"]) && 
									isset($_POST["confirmationMotDePasse"]) &&
										isset($_POST["animalFavori"]))
				{
					try
					{
						$prenom = $_POST["prenom"];
                		$nom = $_POST["nom"];
                		$email = $_POST["adresseCourriel"];
						$animalFavori = $_POST["animalFavori"];
				
						$mdp = $_POST["motDePasse"];
						$confirmationMDP = $_POST["confirmationMotDePasse"];
				
						if ($mdp == $confirmationMDP)
						{
							if ($animalFavori == "chien")
							{
								$espece = 2;
							}
							elseif ($animalFavori == "chat")
							{
								$espece =1;
							}

							$id = UtilisateursDAO::creationCompteUtilisateur($prenom,$nom,$email,$espece,$mdp);

							if (!empty($id))
							{
								$_SESSION["id"] = $id["id"];

								if ($espece == 1)
								{
									header("location:creationCompteProfilChat.php");
								}
								elseif ($espece == 2)
								{
									header("location:creationCompteProfilChien.php");
								}
								exit;
							}
						}
						else
						{
							echo "Veuillez entrer correctement le mot de passe desiree";
						}

					}catch (PDOException $erreur)
					{
						echo $erreur->getMessage();
					}
				}
				
			}
		}
	}