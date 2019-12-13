<?php
	require_once("CommonAction.php");
	require_once("DAO/UtilisateursDAO.php");
	require_once("DAO/AnimauxDAO.php");
	require_once("DAO/MatchDAO.php");
	
	class PagePrincipaleUtilisateurAction extends CommonAction
	{
		//Tous les id des animaux pouvant etre matcher avec le user sont la.
		public $listeMatchPossibles=[];

		//public $listeNomEntrainementNecessaires=[];
		public $cheminImage=[];
		public $nom=[];
		public $age=[];
		public $conteneurFavoris=[];
		
		//public $fichesAffichees=[];

		public $compteur=0;
		
        
		public function __construct()
		{
			parent::__construct(CommonAction::$VISIBILITY_MEMBER);
		}


        protected function executeAction()
        {
			$this->rechercheMatchsPossibles();

			if (isset($_POST["deconnexion"]))
			{
				//echo "deconnect";
				session_unset();
				session_destroy();
				session_start();

				header("location:index.php");
				exit;
			}
			elseif (isset($_POST["like"]))
			{
				//echo "yass ";
				$id=$_POST["idAnimalPhp"];
				//echo $id;
				
				$this->ajouterAuxFavoris($id);
				$this->compteur++;
				//echo $this->conteneurFavoris[0];
			}

			elseif (isset($_POST["nope"]))
			{
				echo "nope ";

				$id=$_POST["idAnimalPhp"];
				echo $id;
				// $this->enleverDeLaListePotentielle($this->compteur);
				$this->compteur++;
			}
		}


		public function rechercheMatchsPossibles()
		{
			//On cherche l'espece que l'usager desire
			$espece = MatchDAO::rechercheEspece();
			
			if ($espece==1)
			{
				# code...
			}
			elseif ($espece==2)
			{	
				$compteUser = MatchDAO::selectionnerDonneesUserChien();
				//echo $compteUser["taille"];
				$entrainementDesirees = MatchDAO::selectionnerEntrainementProfilChien();
				//Sexe deriser par l'utilisateur
				$sexe = MatchDAO::rechercheSexeChien();

				$conteneurIdPremierRound = MatchDAO::trouverMatchPremierRound($espece, $sexe);
			
				foreach($conteneurIdPremierRound as $idAnimaux)
				{
					$idChien = $idAnimaux["id"];

					$ficheChien=MatchDAO::selectionnerDonneesBonnesFichesChien($idChien);
					
					if ($compteUser["taille"] == $ficheChien["taille"])
					{
						if ($compteUser["enfant"]==$ficheChien["enfant"])
						{
							if ($compteUser["ado"]==$ficheChien["ado"])
							{
								if ($compteUser["chien"]==$ficheChien["chien"])
								{
									if ($compteUser["chat"]==$ficheChien["chat"])
									{
										if ($compteUser["balade"]==$ficheChien["exerciceRequis"])
										{
											if ($compteUser["maison"]==$ficheChien["solitude"])
											{
												if ($compteUser["habitat"]==$ficheChien["habitat"])
												{
													$listeNomEntrainementNecessaires = MatchDAO::selectionnerEntrainementFicheChien($idAnimaux);
													
													if ($listeNomEntrainementNecessaires == $entrainementDesirees)
													{
														//echo $idChien;
														//Pourquoi est-ce que j'ai besoin de []?
														$this->listeMatchPossibles[]=$idChien;
													}
													else
													{
														echo "entrainement non-corespondants";
														echo $idChien;
													}
												}
												else
												{
													echo "habitat non-corespondant";
													echo $idChien;
												}
											}
											else
											{
												echo "maison non-corespondant";
												echo $idChien;
											}
										}
										else
										{
											echo "balade non-corespondante";
											echo $idChien;
										}
									}
									else
									{
										echo "chat non-corespondant";
										echo $idChien;
									}
								}
								else
								{
									echo "chien non-corespondant";
									echo $idChien;
								}
							}
							else
							{
								echo "ado non-corespondant";
								echo $idChien;
							}
						}
						else
						{
							echo "enfant non-corespondant";
							echo $idChien;
						}
					}
					else
					{
						echo "taille non-correspondante";
						echo $idChien;
					}
				}
				//$fichesAffichees = $this->afficherPossibilites();
				$this->affichageImage();
				$this->affichageNom();
				$this->affichageAge();
			}
		}

		public function affichageImage()
		{
			foreach ($this->listeMatchPossibles as $id)
			{
				$this->cheminImage[]=MatchDAO::retournerLienImage($id);
				//var_dump($this->cheminImage);
			}
		}

		public function affichageNom()
		{
			foreach ($this->listeMatchPossibles as $id)
			{
				$this->nom[]=MatchDAO::retournerNom($id);
				//var_dump($this->cheminImage);
			}
		}

		public function affichageAge()
		{
			foreach ($this->listeMatchPossibles as $id)
			{
				$this->age[]=MatchDAO::retournerAge($id);
				//var_dump($this->cheminImage);
			}
		}

		public function afficherPossibilites()
		{
			foreach ($this->listeMatchPossibles as $id)
			{
				$fichePossible = MatchDAO::retournerFicheChien($id);
			}
			return $fichePossible;
		}

		public function ajouterAuxFavoris($idAnimalChoisi)
		{
			//echo $idAnimalChoisi;
			$this->conteneurFavoris[] = MatchDAO::ajouterUnFavoris($idAnimalChoisi);			
		}
	}