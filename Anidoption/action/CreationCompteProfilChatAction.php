<?php
	require_once("CommonAction.php");
	require_once("DAO/UtilisateursDAO.php");
	require_once("DAO/ComplementsDAO.php");
	
	class CreationCompteProfilChatAction extends CommonAction
	{   
		public function __construct()
		{
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}
		
        protected function executeAction()
        {
			if (isset($_POST["enregistrer"]))
			{
				if (isset($_POST["choixSexe"]) &&
						isset($_POST["choixGriffes"]) &&
                            isset($_POST["choixToilettage"]) &&
                                isset($_POST["reponse2Chats"]) && 
									isset($_POST['caracteres']))
				{
					try
					{
						$sexe = $this->convertirSexe($_POST["choixSexe"]);
						$griffes = $this->convertirGriffes($_POST["choixGriffes"]);
                        $toilettage = $this->convertirToilettage($_POST["choixToilettage"]);
                        $frereSoeur = $this->convertirFamille($_POST["reponse2Chats"]);
						
						UtilisateursDAO::creationCompteUtilisateurProfilChat($sexe,$griffes,$toilettage,$frereSoeur);

						foreach($_POST['caracteres'] as $nomCaractere)
						{
							$idCaractere = ComplementsDAO::trouverIDCaractereChat($nomCaractere);
							ComplementsDAO::insererCaractereChatSelectionne($idCaractere);
						}

						header("location:pagePrincipaleUtilisateur.php");
						exit;

                    }catch(PDOException $erreur)
					{
					    echo $erreur->getMessage();
				    }
				}
			}
		}

		public function convertirSexe($sexe)
		{
			if ($sexe == "male")
			{
				$genre = 1;
			}						
			elseif ($sexe == "femelle")
			{
				$genre = 2;
			}

			return $genre;
		}
		
		public static function convertirGriffes($griffes)
		{
			if($griffes == "pattesAvants")
			{
				$claw =1;
			}
			elseif ($griffes == "pattesArrieres")
			{
				$claw = 2;
			}
			elseif ($griffes == "pattes")
			{
				$claw = 3;
            }
            elseif ($griffes == "sansPreference")
			{
				$claw = 4;
			}
			return $claw;
		}

		public static function convertirToilettage($toilettage)
		{
			if ($toilettage == "faible")
			{
				$grooming = 1;
			}
			elseif ($toilettage == "moyen")
			{
				$grooming = 2;
            }
            elseif ($toilettage == "eleve")
			{
				$grooming = 3;
			}
			return $grooming;
		}

		public static function convertirFamille($frereSoeur)
		{
			if ($frereSoeur == "oui")
			{
				$famille = 1;
			}
			elseif ($frereSoeur == "non")
			{
				$famille = 0;
			}
			return $famille;
		}
	}

	