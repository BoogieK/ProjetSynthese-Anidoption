<?php
	require_once("CommonAction.php");
	require_once("DAO/UtilisateursDAO.php");
	
	class PagePrincipaleAdminAction extends CommonAction
	{
		public function __construct()
		{
			parent::__construct(CommonAction::$VISIBILITY_ADMIN);
		}

        protected function executeAction()
        {
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
			
		}
	}

           
		
	