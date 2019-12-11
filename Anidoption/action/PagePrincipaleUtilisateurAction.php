<?php
	require_once("CommonAction.php");
	require_once("DAO/UtilisateursDAO.php");
	
	class PagePrincipaleUtilisateurAction extends CommonAction
	{
		
        
		public function __construct()
		{
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

        protected function executeAction()
        {
			$this->rechercheMatchsPossibles();

			if (isset($_POST["deconnexion"]))
			{
				session_unset();
				session_destroy();
				session_start();

				// header("location:index.php");
				// exit;
			}
			// elseif (isset($_POST[]))
			// {
			// 	# code...
			// }
			
		}

		public static function rechercheMatchsPossibles()
		{
			$espece = ComplementsDAO::rechercheEspece();
			
			if($espece == 1)	//Chat
			{

			}
			else if($espece == 2)	//Chien
			{
				$sexe = ComplementsDAO::rechercheSexeDesire();
				$conteneurId = ComplementsDAO::trouverToutCeuxAuSexeCorrespondant($sexe);
				
				foreach ($conteneurId as $idAnimaux)
				{
					echo $idAnimaux;
				}
			}
		}
	}