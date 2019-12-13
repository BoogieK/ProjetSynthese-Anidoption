<?php
	require_once("CommonAction.php");
	require_once("DAO/UtilisateursDAO.php");
	require_once("DAO/AnimauxDAO.php");
	require_once("DAO/MatchDAO.php");
	
	class PagePrincipaleUtilisateurAction extends CommonAction
	{
		//Tableau avec tous les id des animaux pouvant etre matcher avec le user.
		public $listeMatchPossibles=[];
		public $FichePresentee;

		public function __construct()
		{
			parent::__construct(CommonAction::$VISIBILITY_MEMBER);
		}


        protected function executeAction()
        {
			//Initialisation d'un compteur de clic pour savoir quel id d'animal on choisi dans le tableau listeMatchPossibles.
			$compteur=0;

			//En arrivant sur la page, on dit partir la fonction de recherche de matchs
			$this->rechercheMatchsPossibles();
			//Afficher une fiche pour commencer
			$this->afficherFiches($compteur);
			

			if (isset($_POST["deconnexion"]))
			{
				session_unset();
				session_destroy();
				session_start();

				header("location:index.php");
				exit;
			}
			elseif (isset($_POST["like"]))
			{
				//$_SESSION["compteur"]=$compteur++;
				$compteur++;
				$this->afficherFiches($compteur);
				//$id=$_POST["idAnimalPhp"];
				
				
			}

			elseif (isset($_POST["nope"]))
			{
				//$id=$_POST["idAnimalPhp"];
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
			$idActuel = $this->listeMatchPossibles[$positionTableau];
			// echo $idActuel;
			$this->FichePresentee = MatchDAO::retournerFicheChien($idActuel);
		}
	}