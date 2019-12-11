<?php
	require_once("Connexion.php");

	class AnimauxDAO
	{
		public static function creationFicheAnimal($nom,$age,$sexe)
		{
            $id=null;
            $connexion = Connexion::getConnexion();
            
            try
            {
                $sql=$connexion->prepare("INSERT INTO animaux (nom,age,sexe) VALUES (:nom, :age, :sexe)");
				$sql->bindValue(':nom', $nom);
				$sql->bindValue(':age', $age);
				$sql->bindValue(':sexe', $sexe);
                $sql->execute();
                
                $sqlTrouverId = $connexion->prepare("SELECT id from animaux where nom=? AND age=? AND sexe =?");
                $sqlTrouverId->bindValue(1, $nom);
                $sqlTrouverId->bindValue(2, $age);
                $sqlTrouverId->bindValue(3, $sexe);
                $sqlTrouverId->setFetchMode(PDO::FETCH_ASSOC);
                $sqlTrouverId->execute();
                        
                if ($row = $sqlTrouverId->fetch())
                {
                    $id= $row["id"];					
                }

            } catch(PDOException $erreur)
			{
				echo $erreur->getMessage();
            }
            return $id;
        }

        public static function creationFicheChat($id,$griffes,$toilettage,$frereSoeur)
        {
            $connexion = Connexion::getConnexion();
            
            try
            {
                $sql=$connexion->prepare("INSERT INTO ficheChat (id_animaux,griffes,toilettage,famille) VALUES (:id_animaux,:griffes,:toilettage,:famille)");
				$sql->bindValue(':id_animaux', $id);
				$sql->bindValue(':griffes', $griffes);
                $sql->bindValue(':toilettage', $toilettage);
                $sql->bindValue(':famille', $frereSoeur);
                $sql->execute();

			} catch (PDOException $erreur)
			{
				echo $erreur->getMessage();
			}	

        }

        public static function creationFicheChien($id,$taille,$enfant,$ado,$autresAnimauxChat,$autresAnimauxChien,
                                                    $balade,$travailMaison,$habitation)
        {
            $connexion = Connexion::getConnexion();
            
            try
            {
                $sql=$connexion->prepare("INSERT INTO ficheChien (id_animaux,taille,enfant,ado,chien,chat,exerciceRequis,
                                                                    solitude,habitat) VALUES (:id_animaux,:taille,:enfant,
                                                                                :ado,:chien,:chat,:exerciceRequis,:solitude,
                                                                                    :habitat)");
				$sql->bindValue(':id_animaux', $id);
				$sql->bindValue(':taille', $taille);
                $sql->bindValue(':enfant', $enfant);
                $sql->bindValue(':ado', $ado);
                $sql->bindValue(':chien', $autresAnimauxChat);
                $sql->bindValue(':chat', $autresAnimauxChien);
                $sql->bindValue(':exerciceRequis', $balade);
                $sql->bindValue(':solitude', $travailMaison);
                $sql->bindValue(':habitat', $habitation);
                $sql->execute();

			} catch (PDOException $erreur)
			{
				echo $erreur->getMessage();
			}	

        }

        public static function insererCaractereChatAdoption($id, $idCaractere)
        {
            $connexion = Connexion::getConnexion();

            $requete=$connexion->prepare("INSERT INTO ficheChat_caractere (id_animaux,id_caractere) 
												VALUES (:id_chat, :id_ficheChatCaractere)");
			$requete->bindValue(':id_chat', $id);
			$requete->bindValue(':id_ficheChatCaractere', $idCaractere);
			$requete->execute();
        }

        public static function insererEntrainementChienAdoption($id, $idEntrainement)
        {
            $connexion = Connexion::getConnexion();

            $requete=$connexion->prepare("INSERT INTO ficheChien_entrainement (id_animaux,id_training) 
												VALUES (:id_chien, :id_ficheChienTraining)");
			$requete->bindValue(':id_chien', $id);
			$requete->bindValue(':id_ficheChienTraining', $idEntrainement);
			$requete->execute();
        }
    }

