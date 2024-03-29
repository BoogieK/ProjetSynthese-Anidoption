<?php
	require_once("Connexion.php");

	class ComplementsDAO
	{
		public static function trouverIDEntrainementChien($nom)
		{
			$connexion = Connexion::getConnexion();

            $sql = $connexion->prepare("SELECT id_training from entrainementChien where nom = ?");
			$sql->bindValue(1, $nom);
			$sql->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
			$sql->execute();

			if ($row = $sql->fetch())	//Si row n'est pas null (qu'il y a des lignes)
			{
                $id_training = [];
                $id_training = $row["id_training"];
            }
			return $id_training;
		}
		
		public static function trouverIDCaractereChat($nom)
		{
			$connexion = Connexion::getConnexion();

            $sql = $connexion->prepare("SELECT id_caractere from caractereChat where nom = ?");
			$sql->bindValue(1, $nom);
			$sql->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
			$sql->execute();

			if ($row = $sql->fetch())	//Si row n'est pas null (qu'il y a des lignes)
			{
                $id_caractere = [];
                $id_caractere = $row["id_caractere"];
            }
			return $id_caractere;
		}

        public static function insererEntrainementChienSelectionne($id)
		{
            $connexion = Connexion::getConnexion();
            $id_user = $_SESSION["id"];

            $requete=$connexion->prepare("INSERT INTO compteChien_entrainement (id_user,id_compteChienEntrainement) 
												VALUES (:id_user, :id_compteChienEntrainement)");
			$requete->bindValue(':id_user', $id_user);
			$requete->bindValue(':id_compteChienEntrainement', $id);
			$requete->execute();
		}
		
		public static function insererCaractereChatSelectionne($id)
		{
            $connexion = Connexion::getConnexion();
            $id_user = $_SESSION["id"];

            $requete=$connexion->prepare("INSERT INTO compteChat_caractere (id_user,id_compteChatCaractere) 
												VALUES (:id_user, :id_compteChatCaractere)");
			$requete->bindValue(':id_user', $id_user);
			$requete->bindValue(':id_compteChatCaractere', $id);
			$requete->execute();
		}

		public static function ajouterFav($idAnimal)
		{
			$connexion = Connexion::getConnexion();
			$id_user = $_SESSION["id"];
			
			$sql = $connexion->prepare("SELECT id_animaux from favoris where id_user=?");
			$sql->bindValue(1, $id_user);
			$sql->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
			$sql->execute();

			$idFav = $sql->fetchAll();

			if (empty($idFav))
			{
				$requete=$connexion->prepare("INSERT INTO favoris (id_user,id_animaux) 
												VALUES (:id_user, :id_animaux)");
				$requete->bindValue(':id_user', $id_user);
				$requete->bindValue(':id_animaux', $idAnimal);
				$requete->execute();
				
			}
			else
			{
				$compteur = 0;
				foreach ($idFav as $id)
				{
					if ($id["id_animaux"] == $idAnimal)
					{
						$compteur++;
					}
				}
				if ($compteur ==0)
				{
					$stmt=$connexion->prepare("INSERT INTO favoris (id_user,id_animaux) 
														VALUES (:id_user, :id_animaux)");
						$stmt->bindValue(':id_user', $id_user);
						$stmt->bindValue(':id_animaux', $idAnimal);
						$stmt->execute();
				}
				
			}
		}

		public static function retournerIDSFavoris()
		{
			$connexion = Connexion::getConnexion();
			$id_user = $_SESSION["id"];

            $sql = $connexion->prepare("SELECT id_animaux from favoris where id_user=?");
			$sql->bindValue(1, $id_user);
			$sql->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
			$sql->execute();

			$idFav = $sql->fetchAll();
			
			
			return $idFav;
		}

		########################################################################################################
		#												ADMIN
		########################################################################################################

		public static function retournerIDSAdopt()
		{
			$connexion = Connexion::getConnexion();
			$espece = 2;

            $sql = $connexion->prepare("SELECT id from animaux where espece=?");
			$sql->bindValue(1, $espece);
			$sql->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
			$sql->execute();

			$idFav = $sql->fetchAll();
			
			
			return $idFav;
		}
		public static function retournerChiensEnAdoption()
		{
			$connexion = Connexion::getConnexion();
			
			$sql = $connexion->prepare("SELECT * from animaux where espece=?");
			$sql->bindValue(1, 2);
			$sql->execute();
			
			$row = $sql->fetchAll();
			foreach ($row as $animal)
			{
				$fiche=[];
				$fiche["nom"]=$animal["nom"];
				$fiche["id"]=$animal["id"];
			}
			
			return $fiche;
		}

		public static function retournerChatsEnAdoption()
		{
			$connexion = Connexion::getConnexion();

			$sql = $connexion->prepare("SELECT * from animaux where espece=?");
			$sql->bindValue(1, 1);
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			$sql->execute();
			
			$row = $sql->fetchAll();	

			return $row;
		}

		

		public static function retournerAnimauxEnAdoption()
		{
			$connexion = Connexion::getConnexion();
			
			$sql = $connexion->prepare("SELECT * from animaux");
			$sql->execute();

			$adoption = $sql->fetchAll();
			
			return $adoption;
		}
    }
	

			