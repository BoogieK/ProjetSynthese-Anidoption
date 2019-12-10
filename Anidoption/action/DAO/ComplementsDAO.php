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
    }
	