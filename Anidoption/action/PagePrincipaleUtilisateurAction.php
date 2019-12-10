<?php
	require_once("CommonAction.php");
	//require_once("DAO/UtilisateursDAO.php");
	
	class PagePrincipaleUtilisateurAction extends CommonAction
	{
		
        
		public function __construct()
		{
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

        protected function executeAction()
        {
			
		}
	}

           
		
	