<?php
	require_once("CommonAction.php");
	require_once("DAO/AnimauxDAO.php");
	require_once("DAO/ComplementsDAO.php");
	
	class CreationFicheChatAction extends CommonAction
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
								isset($_POST["choixGriffes"]) &&
                            		isset($_POST["choixToilettage"]) &&
                                		isset($_POST["reponse2Chats"]) && 
											isset($_POST['caracteres']) &&
												isset($_FILES['imageAnimal']))
				{
					try
					{

						$nom = $_POST["nom"];
						$age = $_POST["age"];
						$sexe = $this->convertirSexe($_POST["choixSexe"]);
						
						$image = $this->verifierIMG($_FILES['imageAnimal']);
						$griffes = $this->convertirGriffes($_POST["choixGriffes"]);
                        $toilettage = $this->convertirToilettage($_POST["choixToilettage"]);
                        $frereSoeur = $this->convertirFamille($_POST["reponse2Chats"]);
						
						if (!empty($image))
						{
							if (is_numeric($age))
							{
								$id=AnimauxDAO::creationFicheAnimal($nom,$age,$sexe,$image);
								AnimauxDAO::creationFicheChat($id,$griffes,$toilettage,$frereSoeur);

								foreach($_POST['caracteres'] as $nomCaractere)
								{
									$idCaractere = ComplementsDAO::trouverIDCaractereChat($nomCaractere);
									AnimauxDAO::insererCaractereChatAdoption($id, $idCaractere);
								}
							}
							else
							{
								echo "Veuillez entrer un age sous forme numerique.";
							}
						}
						else
						{
							echo "Veuillez entrer une image valide.";
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
		
		public static function convertirGriffes($griffes)
		{
			if($griffes == "pattesAvants")
			{
				$claw =1;
			}
			elseif ($griffes == "pattesArrieres")
			{
				$claw = 2;
			}
			elseif ($griffes == "pattes")
			{
				$claw = 3;
            }
            elseif ($griffes == "sansPreference")
			{
				$claw = 4;
			}
			return $claw;
		}

		public static function convertirToilettage($toilettage)
		{
			if ($toilettage == "faible")
			{
				$grooming = 1;
			}
			elseif ($toilettage == "moyen")
			{
				$grooming = 2;
            }
            elseif ($toilettage == "eleve")
			{
				$grooming = 3;
			}
			return $grooming;
		}

		public static function convertirFamille($frereSoeur)
		{
			if ($frereSoeur == "oui")
			{
				$famille = 1;
			}
			elseif ($frereSoeur == "non")
			{
				$famille = 0;
			}
			return $famille;
		}

		public function verifierIMG($image)
		{
			//Le code qui suit ne m'appartient pas au complet. Ne sachant pas comment upload un lien pour une image, j'ai ete sur ce site:
			//https://www.tutorialspoint.com/php/php_file_uploading.htm

			$errors= array();
			$file_name = $_FILES['imageAnimal']['name'];
			$file_size =$_FILES['imageAnimal']['size'];
			$file_tmp =$_FILES['imageAnimal']['tmp_name'];
			$file_type=$_FILES['imageAnimal']['type'];
			$file_ext=strtolower(end(explode('.',$_FILES['imageAnimal']['name'])));

			$extensions= array("jpeg","jpg","png");

			if(in_array($file_ext,$extensions)=== false)
			{
				$errors[]="extension not allowed, please choose a JPEG or PNG file.";
			}
			if($file_size > 2097152)
			{
				$errors[]='File size must be excately 2 MB';
			}
			if(empty($errors)==true)
			{
				move_uploaded_file($file_tmp,"upload/".$file_name);
				return $file_name;
			}
			else
			{
				print_r($errors);
			}
		}
	}

	