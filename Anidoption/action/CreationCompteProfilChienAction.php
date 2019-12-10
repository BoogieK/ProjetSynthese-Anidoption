<?php
	require_once("CommonAction.php");
	require_once("DAO/UtilisateursDAO.php");
	require_once("DAO/ComplementsDAO.php");
	
	class CreationCompteProfilChienAction extends CommonAction
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
						isset($_POST["choixTaille"]) &&
							isset($_POST["reponseEnfant"]) &&
								isset($_POST["reponseAdo"]) && 
									isset($_POST["reponseFutursParents"]) &&
                                        isset($_POST["reponseAnimauxAutresChats"]) &&
                                            isset($_POST["reponseAnimauxAutresChiens"]) && 
                                                isset($_POST["choixHeure"]) &&
													isset($_POST["reponseDispo"]) &&
														isset($_POST['choixEntrainement']) &&
                                                        	isset($_POST["choixDomicile"]))
				{
					try
					{
						$sexe = $this->convertirSexe($_POST["choixSexe"]);
						$taille = $this->convertirTaille($_POST["choixTaille"]);
						$enfant = $this->convertirEnfant($_POST["reponseEnfant"]);
						$ado = $this->convertirAdo($_POST["reponseAdo"]);
						$futursParents = $this->convertirParents($_POST["reponseFutursParents"]);
						$autresAnimauxChat= $this->convertirAnimauxChats($_POST["reponseAnimauxAutresChats"]);
						$autresAnimauxChien = $this->convertirAnimauxChiens($_POST["reponseAnimauxAutresChiens"]);
						$balade = $this->convertirBalade($_POST["choixHeure"]);
						$travailMaison = $this->convertirHeureMaison($_POST["reponseDispo"]);
						$habitation = $this->convertirDomicile($_POST["choixDomicile"]);
						
						UtilisateursDAO::creationCompteUtilisateurProfilChien($sexe,$taille,$enfant,$ado,$futursParents,$autresAnimauxChat,
						$autresAnimauxChien,$balade,$travailMaison,$habitation);

						
						foreach($_POST['choixEntrainement'] as $nomEntrainement)
						{
							$idEntrainement = ComplementsDAO::trouverIDEntrainementChien($nomEntrainement);
							ComplementsDAO::insererEntrainementChienSelectionne($idEntrainement);
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
		
		public static function convertirTaille($taille)
		{
			if($taille == "petit")
			{
				$grandeur =1;
			}
			elseif ($taille == "moyen")
			{
				$grandeur = 2;
			}
			elseif ($taille == "grand")
			{
				$grandeur = 3;
			}
			return $grandeur;
		}

		public static function convertirEnfant($enfant)
		{
			if ($enfant == "oui")
			{
				$kid = 1;
			}
			elseif ($enfant == "non")
			{
				$kid = 0;
			}
			return $kid;
		}

		public static function convertirAdo($ado)
		{
			if ($ado == "oui")
			{
				$teen = 1;
			}
			elseif ($ado == "non")
			{
				$teen = 0;
			}
			return $teen;
		}

		public static function convertirParents($futursParents)
		{
			if ($futursParents == "oui")
			{
				$futurParents = 1;
			}
			elseif ($futursParents == "non")
			{
				$futurParents = 0;
			}
			return $futurParents;
		}

		public static function convertirAnimauxChats($autresAnimauxChat)
		{
			if ($autresAnimauxChat == "oui")
			{
				$autreChat = 1;
			}
			elseif ($autresAnimauxChat == "non")
			{
				$autreChat = 0;
			}
			return $autreChat;
		}

		public static function convertirAnimauxChiens($autresAnimauxChien)
		{
			if ($autresAnimauxChien == "oui")
			{
				$autreChien = 1;
			}
			elseif ($autresAnimauxChien == "non")
			{
				$autreChien = 0;
			}
			return $autreChien;
		}

		public static function convertirBalade($balade)
		{
			if ($balade == "heure12")
			{
				$promenade = 1;
			}
			elseif ($balade == "heure23")
			{
				$promenade = 2;
			}
			elseif ($balade == "heure3+")
			{
				$promenade = 3;
			}
			return $promenade;
		}

		public static function convertirHeureMaison($travailMaison)
		{
			if ($travailMaison == "oui")
			{
				$teletravail = 1;
			}
			elseif ($travailMaison == "non")
			{
				$teletravail = 0;
			}
			return $teletravail;
		}

		public static function convertirDomicile($habitation)
		{
			if ($habitation == "petit")
			{
				$toit = 1;
			}
			elseif ($habitation == "moyen")
			{
				$toit = 2;
			}
			return $toit;
		}
	}

	