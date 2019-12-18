<?php
	require_once("Connexion.php");

	class UtilisateursDAO
	{
		public static function authentification($adresseCourriel, $motDePasse)
		{
			$utilisateur = null;

			$connexion = Connexion::getConnexion();

			if (isset($_POST["adresseCourriel"]) && isset($_POST["motDePasse"]))
			{
				$sqlConnexion = $connexion->prepare("SELECT * from utilisateurs where adresseCourriel = ?");
				$sqlConnexion->bindValue(1, $adresseCourriel);
				$sqlConnexion->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
				$sqlConnexion->execute();

				if ($row= $sqlConnexion->fetch())	//Si row n'est pas null (qu'il y a des lignes)
				{
					if (password_verify($motDePasse, $row["motDePasse"]))
					{
						$utilisateur = [];
						$utilisateur["id"]=$row["id"];
						$utilisateur["adresseCourriel"] = $row["adresseCourriel"];
						$utilisateur["visibility"] = $row["visibility"];
					}
				}
			}
			return $utilisateur;
		}


		public static function creationCompteAdmin()
		{
			$connexion = Connexion::getConnexion();

			$adminEmail = "administration@spca.ca";

			$checkAdmin = $connexion->prepare("SELECT * from utilisateurs where adresseCourriel =:email");
			$checkAdmin->bindValue(":email", $adminEmail);
			$checkAdmin->setFetchMode(PDO::FETCH_ASSOC); 	//Permet d'aller chercher par le nom de la colonne
			$checkAdmin->execute();

			if (($row = $checkAdmin->fetch()) == 0)	//Si row est null (il n'y a pas de ligne correspondante)
			{
				$visibility =2;
				$motDePasse = PASSWORD_HASH("SPCAadmin2019", PASSWORD_DEFAULT);

				try
				{
					$sql=$connexion->prepare("INSERT INTO utilisateurs (visibility,adresseCourriel,motDePasse) VALUES (:visibility, :email, :pwd)");
					$sql->bindValue(':visibility', $visibility);
					$sql->bindValue(':email', $adminEmail);
					$sql->bindValue(':pwd', $motDePasse);
					$sql->execute();

				} catch (PDOException $erreur)
				{
					echo "icitte";
					echo $erreur->getMessage();
				}
			}
		}

		public static function creationCompteUtilisateur($prenom,$nom,$email,$espece,$mdp)
		{
			$connexion = Connexion::getConnexion();
			$visibility=1;
			
			$motDePasse = PASSWORD_HASH($mdp, PASSWORD_DEFAULT);

			try
			{
				$requete=$connexion->prepare("INSERT INTO utilisateurs (visibility,prenom,nom,espece,adresseCourriel,motDePasse) 
												VALUES (:visibility, :prenom, :nom, :espece, :email, :pwd)");
				$requete->bindValue(':visibility', $visibility);
				$requete->bindValue(':prenom', $prenom);
				$requete->bindValue(':nom', $nom);
				$requete->bindValue(':espece', $espece);
				$requete->bindValue(':email', $email);
				$requete->bindValue(':pwd', $motDePasse);
				$requete->execute();

				$sqlTrouverId = $connexion->prepare("SELECT id from utilisateurs where adresseCourriel = ?");
				$sqlTrouverId->bindValue(1, $email);
				$sqlTrouverId->setFetchMode(PDO::FETCH_ASSOC);
				$sqlTrouverId->execute();
					
				if ($row = $sqlTrouverId->fetch())
				{
					$id = [];
					$id["id"] = $row["id"];					
				}
				return $id;

			}catch (PDOException $erreur)
			{
				echo $erreur->getMessage();
			}
		}

		public static function creationCompteUtilisateurProfilChien($sexe,$taille,$enfant,$ado,$futursParents,
																		$autresAnimauxChat,$autresAnimauxChien,$balade,
																			$travailMaison,$habitation)
		{
			$connexion = Connexion::getConnexion();
			$id_user = $_SESSION["id"];

			try
			{
				$requete=$connexion->prepare("INSERT INTO compteChien (id_user,sexe,taille,enfant,ado,futursParents,chien, chat,balade,maison,habitat) 
												VALUES (:id_user,:sexe, :taille, :enfant, :ado, :futursParents, :chien, :chat, :balade, :maison, :habitat)");
				$requete->bindValue(':id_user', $id_user);
				$requete->bindValue(':sexe', $sexe);
				$requete->bindValue(':taille', $taille);
				$requete->bindValue(':enfant', $enfant);
				$requete->bindValue(':ado', $ado);
				$requete->bindValue(':futursParents', $futursParents);
				$requete->bindValue(':chien', $autresAnimauxChat);
				$requete->bindValue(':chat', $autresAnimauxChien);
				$requete->bindValue(':balade', $balade);
				$requete->bindValue(':maison', $travailMaison);
				$requete->bindValue(':habitat', $habitation);
				$requete->execute();

			}catch (PDOException $erreur)
			{
				echo $erreur->getMessage();
			}
		}

		public static function creationCompteUtilisateurProfilChat($sexe,$griffes,$toilettage,$frereSoeur)
		{
			$connexion = Connexion::getConnexion();
			$id_user = $_SESSION["id"];
			
			try
			{
				$requete=$connexion->prepare("INSERT INTO compteChat (id_user, sexe, griffes, toilettage, famille) 
												VALUES (:id_user, :sexe, :griffes, :toilettage, :famille)");
				$requete->bindValue(':id_user', $id_user);
				$requete->bindValue(':sexe', $sexe);
				$requete->bindValue(':griffes', $griffes);
				$requete->bindValue(':toilettage', $toilettage);
				$requete->bindValue(':famille', $frereSoeur);
				$requete->execute();

			}catch (PDOException $erreur)
			{
				echo $erreur->getMessage();
			}
		}
	}
	


		