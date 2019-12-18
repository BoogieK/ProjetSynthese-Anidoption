<?php
	require_once("CommonAction.php");
	require_once("DAO/UtilisateursDAO.php");
	require_once("DAO/ComplementsDAO.php");
	require_once("DAO/MatchDAO.php");
	require_once("DAO/AnimauxDAO.php");
	
	class PagePrincipaleAdminAction extends CommonAction
	{
		public $chiensEnAdoption=[];
		public $chatsEnAdoption=[];
		// public $afficherEnAdoption=[];
		public $listeAdopt=[];
		
		public function __construct()
		{
			parent::__construct(CommonAction::$VISIBILITY_ADMIN);
		}

        protected function executeAction()
        {

			$this->listeAdopt=ComplementsDAO::retournerAnimauxEnAdoption();

			if (isset($_POST["deconnexion"]))
			{
				session_unset();
				session_destroy();
				session_start();

				header("location:index.php");
				exit;
			}
			elseif(isset($_POST["animalFavori"]))
			{
                $animalFavori = $_POST["animalFavori"];

                if ($animalFavori=="chien")
                {
                    header("location:creationFicheChien.php");
				    exit;
                }
                elseif($animalFavori=="chat")
                {
                    header("location:creationFicheChat.php");
				    exit;
                }
			}
			elseif(isset($_POST["adoption"]))
			{
				$idAnimal = $_POST["idAnimal"];
				AnimauxDAO::supprimerAnimalAdopte($idAnimal);
				header("location:PagePrincipaleAdmin.php");
				exit;
			}
			
		}

		
	}

           
		
	