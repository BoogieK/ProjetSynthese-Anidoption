<?php
	require_once("Connexion.php");


	class MatchDAO
	{
        public static function rechercheEspece()
		{
			$connexion = Connexion::getConnexion();
			$id_user = $_SESSION["id"];
			
            $sql = $connexion->prepare("SELECT espece from utilisateurs where id=?");
			$sql->bindValue(1, $id_user);
			$sql->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
			$sql->execute();

			if ($row = $sql->fetch())	//Si row n'est pas null (qu'il y a des lignes)
			{
				$espece = $row["espece"];
			}
			return $espece;
		}
		

		public static function selectionnerDonneesUserChien()
		{
			$connexion = Connexion::getConnexion();
			$id_user = $_SESSION["id"];

			$sql = $connexion->prepare("SELECT * from compteChien where id_user=?");
			$sql->bindValue(1, $id_user);
			$sql->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
			$sql->execute();

			if ($compteCorrespondant = $sql->fetch())	//Si compteCorrespondant n'est pas null (qu'il y a des lignes)
			{
				$dataFicheUser = [];
				$dataFicheUser["sexe"] = $compteCorrespondant["sexe"];
				$dataFicheUser["taille"] = $compteCorrespondant["taille"];
				$dataFicheUser["enfant"] = $compteCorrespondant["enfant"];
				$dataFicheUser["ado"] = $compteCorrespondant["ado"];
				$dataFicheUser["futursParents"] = $compteCorrespondant["futursParents"];
				$dataFicheUser["chien"] = $compteCorrespondant["chien"];
				$dataFicheUser["chat"] = $compteCorrespondant["chat"];
				$dataFicheUser["balade"] = $compteCorrespondant["balade"];
				$dataFicheUser["maison"] = $compteCorrespondant["maison"];
				$dataFicheUser["habitat"] = $compteCorrespondant["habitat"];
            }
            return $dataFicheUser;	
		}


		public static function selectionnerDonneesBonnesFichesChien($idAnimaux)
		{
			$connexion = Connexion::getConnexion();
			
			$sql = $connexion->prepare("SELECT * from ficheChien where id_animaux=?");
			$sql->bindValue(1, $idAnimaux);
			$sql->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
			$sql->execute();

			if ($ficheCorrespondante = $sql->fetch())	//Si compteCorrespondant n'est pas null (qu'il y a des lignes)
			{
				$dataFiche = [];
				$dataFiche["taille"] = $ficheCorrespondante["taille"];
				$dataFiche["enfant"] = $ficheCorrespondante["enfant"];;
				$dataFiche["ado"] = $ficheCorrespondante["ado"];;
				$dataFiche["chien"] = $ficheCorrespondante["chien"];;
				$dataFiche["chat"] = $ficheCorrespondante["chat"];;
				$dataFiche["exerciceRequis"] = $ficheCorrespondante["exerciceRequis"];;
				$dataFiche["solitude"] = $ficheCorrespondante["solitude"];;
				$dataFiche["habitat"] = $ficheCorrespondante["habitat"];;
			}
			return $dataFiche;
		}


        public static function rechercheSexeChien()
		{
			$connexion = Connexion::getConnexion();
			$id_user = $_SESSION["id"];
			
            $sql = $connexion->prepare("SELECT sexe from compteChien where id_user=?");
			$sql->bindValue(1, $id_user);
			$sql->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
			$sql->execute();

			if ($row = $sql->fetch())	//Si row n'est pas null (qu'il y a des lignes)
			{
				$sexe = $row["sexe"];
            }
			return $sexe;
		}


		public static function trouverMatchPremierRound($espece, $sexe)
        {
            $connexion = Connexion::getConnexion();
			
			$sql = $connexion->prepare("SELECT id from animaux where espece=? AND sexe=?");
			$sql->bindValue(1, $espece);
			$sql->bindValue(2, $sexe);
			$sql->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
			$sql->execute();

			$idCorrespondants = $sql->fetchAll();	//Si row n'est pas null (qu'il y a des lignes)
            
            return $idCorrespondants;
		}


		public static function selectionnerEntrainementProfilChien()
		{
			$connexion = Connexion::getConnexion();
			$id_user = $_SESSION["id"];

			$sql = $connexion->prepare("SELECT id_compteChienEntrainement from compteChien_entrainement where id_user=?");
			$sql->bindValue(1, $id_user);
			$sql->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
			$sql->execute();

			$idEntrainement = $sql->fetchAll();

			foreach ($idEntrainement as $idEntrainementSelectionne)
			{
				$sql2 = $connexion->prepare("SELECT nom from entrainementChien where id_training=?");
				$sql2->bindValue(1, $idEntrainementSelectionne);
				$sql2->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
				$sql2->execute();

				if ($row = $sql->fetch())	//Si row n'est pas null (qu'il y a des lignes)
				{
					$entrainementsChoisis = $row["nom"];
				}
			}
			return $entrainementsChoisis;
		}

		
		public static function selectionnerEntrainementFicheChien($idAnimaux)
		{	
			$connexion = Connexion::getConnexion();
			
			$sql = $connexion->prepare("SELECT id_training from ficheChien_entrainement where id_animaux=?");
			$sql->bindValue(1, $idAnimaux);
			$sql->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
			$sql->execute();

			$idEntrainement = $sql->fetchAll();

			foreach ($idEntrainement as $idEntrainementPerso)
			{
				$sql2 = $connexion->prepare("SELECT nom from entrainementChien where id_training=?");
				$sql2->bindValue(1, $idEntrainementPerso);
				$sql2->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
				$sql2->execute();

				if ($row = $sql->fetch())	//Si row n'est pas null (qu'il y a des lignes)
				{
					$entrainementsNecessaires = $row["nom"];
				}
			}
			// echo "entrainement";
			return $entrainementsNecessaires;
		}

		public static function retournerLienImage($idAnimal)
		{
			$connexion = Connexion::getConnexion();
			
			$sql = $connexion->prepare("SELECT img from animaux where id=?");
			$sql->bindValue(1, $idAnimal);
			$sql->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
			$sql->execute();

			if ($row = $sql->fetch())	//Si row n'est pas null (qu'il y a des lignes)
			{
				$img = $row["img"];
            }
			return $img;
		}

		public static function retournerNom($idAnimal)
		{
			$connexion = Connexion::getConnexion();
			
			$sql = $connexion->prepare("SELECT nom from animaux where id=?");
			$sql->bindValue(1, $idAnimal);
			$sql->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
			$sql->execute();

			if ($row = $sql->fetch())	//Si row n'est pas null (qu'il y a des lignes)
			{
				$nom = $row["nom"];
            }
			return $nom;
		}

		public static function retournerAge($idAnimal)
		{
			$connexion = Connexion::getConnexion();
			
			$sql = $connexion->prepare("SELECT age from animaux where id=?");
			$sql->bindValue(1, $idAnimal);
			$sql->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
			$sql->execute();

			if ($row = $sql->fetch())	//Si row n'est pas null (qu'il y a des lignes)
			{
				$age = $row["age"];
            }
			return $age;
		}

		public static function ajouterUnFavoris($idAnimalChoisi)
		{
			$connexion = Connexion::getConnexion();
			
			$sql = $connexion->prepare("SELECT nom from animaux where id=?");
			$sql->bindValue(1, $idAnimalChoisi);
			$sql->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
			$sql->execute();

			if ($row = $sql->fetch())	//Si row n'est pas null (qu'il y a des lignes)
			{
				$nom = $row["nom"];
				//echo $nom;
				$id_user = $_SESSION["id"];
				
				try
            	{
                	$sql2=$connexion->prepare("INSERT INTO favoris (id_user,id_animaux) VALUES (:id_user, :id_animaux)");
					$sql2->bindValue(':id_user', $id_user);
					$sql2->bindValue(':id_animaux', $idAnimalChoisi);
                	$sql2->execute();

				} catch (PDOException $erreur)
				{
					echo "error";
					echo $erreur->getMessage();
				}	
			}
			return $nom;
		}

		public static function retournerFicheChien($idAnimal)
		{
			$connexion = Connexion::getConnexion();
			
			$sql = $connexion->prepare("SELECT * from animaux where id=?");
			$sql->bindValue(1, $idAnimal);
			$sql->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
			$sql->execute();

			if ($ficheCorrespondante = $sql->fetch())	//Si compteCorrespondant n'est pas null (qu'il y a des lignes)
			{
				$dataFiche = [];
				$dataFiche["nom"] = $ficheCorrespondante["nom"];
				$dataFiche["age"] = $ficheCorrespondante["age"];
				$dataFiche["img"] = $ficheCorrespondante["img"];
			}
			return $dataFiche;
		}
    }