<?php
	require_once("CommonAction.php");
	require_once("DAO/UtilisateursDAO.php");
	
	class IndexAction extends CommonAction
	{
		public $wrongLogin = false;
        
		public function __construct()
		{
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

        protected function executeAction()
        {
			if (isset($_POST["adresseCourriel"]))
			{
				$utilisateur = UtilisateursDAO::authentification($_POST["adresseCourriel"], $_POST["motDePasse"]);
				if (!empty($utilisateur))
				{
					$_SESSION["adresseCourriel"] = $utilisateur["adresseCourriel"];
					$_SESSION["visibility"] = $utilisateur["visibility"];
					$_SESSION["id"] = $utilisateur["id"];
					
					if ($_SESSION["visibility"] == 1)
					{
						$_SESSION['compteur']=0;
						header("location:pagePrincipaleUtilisateur.php");
					}
					elseif ($_SESSION["visibility"]==2) {
						header("location:pagePrincipaleAdmin.php");
					}
					exit;
				}
				else {
					$this->wrongLogin = true;
				}
			}
			
			if (isset($_POST["creerCompte"]))
			{
				header("location:creationCompte.php");
				exit;
			}
           
		}
	}