<?php
	require_once("CommonAction.php");
	require_once("DAO/UtilisateursDAO.php");
	require_once("DAO/AnimauxDAO.php");
	require_once("DAO/MatchDAO.php");
	require_once("DAO/ComplementsDAO.php");
	
	class PagePrincipaleUtilisateurAction extends CommonAction
	{
		//Tableau avec tous les id des animaux pouvant etre matcher avec le user.
		public $listeMatchPossibles=[];
		public $FichePresentee;
		public $listeFavoris=[];
		

		public function __construct()
		{
			parent::__construct(CommonAction::$VISIBILITY_MEMBER);
		}


        protected function executeAction()
        {
			//En arrivant sur la page, on dit partir la fonction de recherche de matchs
			$this->rechercheMatchsPossibles();
			//Afficher la premiere fiche pour commencer
			$this->afficherFiches($_SESSION['compteur']);
			//Afficher les favoris de l'usager
			$this->afficherFavoris();
			
			
			if (isset($_POST["deconnexion"]))
			{
				session_unset();
				session_destroy();
				session_start();

				header("location:index.php");
				exit;
			}
			
			//Si tu like ou dislike une fiche
			elseif (isset($_POST["like"]) || isset($_POST["nope"]))
			{
				if (isset($_POST["like"]) )
				{
					$idAnimalPhp = $_POST["idAnimalPhp"];
					$this->ajouterFavoris($idAnimalPhp);
				}

				++$_SESSION['compteur'];
				$this->afficherFiches($_SESSION['compteur']);
				
				if ($_SESSION['compteur']>=sizeof($this->listeMatchPossibles))
				{	//Quand il n'y a plus de choix adaptes, on le mentionne au user
					$this->finFiches();
				}	
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
													{	//J'ai besoin de [] pour pouvoir .append les id dans mon tableau, car 
														//cette fois-ci, je n'ai pas de fonction qui appel un fetch ou fetchAll MySQL.
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
			}
		
		}

		public function afficherFiches($positionTableau)
		{
			//Aller chercher le id de l'animal a la position ou on est rendu dans le tableau
			$idActuel = $this->listeMatchPossibles[$positionTableau];
			$this->FichePresentee = MatchDAO::retournerFicheChien($idActuel);	
		}

		public function ajouterFavoris($idAnimalAime)
		{
			ComplementsDAO::ajouterFav($idAnimalAime);
		}

		public function afficherFavoris()
		{
			$idFav = ComplementsDAO::retournerIDSFavoris();
		
			foreach ($idFav as $id)
			{
				foreach ($id as $int) {
					
					$this->listeFavoris[]=MatchDAO::retournerNomFavoris($int);
				}
			}
		}

		public function finFiches()
		{
			$this->FichePresentee["nom"] = "Aucun choix possibles";	
			$this->FichePresentee["age"] = " - ";
			$this->FichePresentee["img"] = "sad.gif";
		}
	}