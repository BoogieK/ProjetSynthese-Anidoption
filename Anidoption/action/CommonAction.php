<?php

    session_start();
    
	abstract class CommonAction
	{
		protected static $VISIBILITY_PUBLIC = 0;
		protected static $VISIBILITY_MEMBER = 1;
		protected static $VISIBILITY_ADMIN = 2;
		
		private $pageVisibility;
		
		public function __construct($pageVisibility)
		{
			$this->pageVisibility = $pageVisibility;
		}

		public function execute()
		{
			if (!empty($_GET["logout"])) {
				session_unset();
				session_destroy();
				session_start();
			}

			if (empty($_SESSION["visibility"])) {
				$_SESSION["visibility"] = CommonAction::$VISIBILITY_PUBLIC;
			}

			if ($_SESSION["visibility"] < $this->pageVisibility) {
				header("location:index.php");
				exit;
			}

			// Methode template
			$this->executeAction();
		}

		protected abstract function executeAction();

		public function isLoggedIn()
		{
			return $_SESSION["visibility"] > CommonAction::$VISIBILITY_PUBLIC;
		}

		public function getUsername()
		{
			return empty($_SESSION["adresseCourriel"]) ? "Invité" : $_SESSION["adresseCourriel"];
		}
	}