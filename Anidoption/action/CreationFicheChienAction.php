<?php
	require_once("CommonAction.php");
	require_once("DAO/AnimauxDAO.php");
	require_once("DAO/ComplementsDAO.php");
	
	class CreationFicheChienAction extends CommonAction
	{   
		public function __construct()
		{
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}
		
        protected function executeAction()
        {
			if (isset($_POST["enregistrer"]))
			{
				if (isset($_POST["nom"]) &&
                        isset($_POST["age"]) &&
                            isset($_POST["choixSexe"]) &&
						        isset($_POST["choixTaille"]) &&
							        isset($_POST["reponseEnfant"]) &&
								        isset($_POST["reponseAdo"]) && 
									        isset($_POST["reponseAnimauxAutresChats"]) &&
                                                isset($_POST["reponseAnimauxAutresChiens"]) && 
                                                    isset($_POST["choixHeure"]) &&
												        isset($_POST["reponseDispo"]) &&
													        isset($_POST['choixEntrainement']) &&
                                                    	        isset($_POST["choixDomicile"]))
				{
					try
					{
                        $nom = $_POST["nom"];
						$age = $_POST["age"];
                        $sexe = $this->convertirSexe($_POST["choixSexe"]);
                        
						$taille = $this->convertirTaille($_POST["choixTaille"]);
						$enfant = $this->convertirEnfant($_POST["reponseEnfant"]);
						$ado = $this->convertirAdo($_POST["reponseAdo"]);
						
						$autresAnimauxChat= $this->convertirAnimauxChats($_POST["reponseAnimauxAutresChats"]);
						$autresAnimauxChien = $this->convertirAnimauxChiens($_POST["reponseAnimauxAutresChiens"]);
						$balade = $this->convertirBalade($_POST["choixHeure"]);
						$travailMaison = $this->convertirHeureMaison($_POST["reponseDispo"]);
						$habitation = $this->convertirDomicile($_POST["choixDomicile"]);
						
						if (is_numeric($age))
						{
							$id=AnimauxDAO::creationFicheAnimal($nom,$age,$sexe);
                            AnimauxDAO::creationFicheChien($id,$taille,$enfant,$ado,$autresAnimauxChat,$autresAnimauxChien,
                                                            $balade,$travailMaison,$habitation);

							foreach($_POST['choixEntrainement'] as $nomEntrainement)
							{
								$idEntrainement = ComplementsDAO::trouverIDEntrainementChien($nomEntrainement);
								AnimauxDAO::insererEntrainementChienAdoption($id, $idEntrainement);
							}
						}
						else
						{
							echo "Veuillez entrer un age sous forme numerique.";
						}
						
						header("location:pagePrincipaleAdmin.php");
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
            elseif ($autresAnimauxChat =="indetermine") {
                
                $autreChat = 2;
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
            elseif ($autresAnimauxChien =="indetermine") {
                
                $autreChien = 2;
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