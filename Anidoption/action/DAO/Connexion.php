<?php

    class Connexion
    {
        private static $connexion = null;
        
        public static function getConnexion()
        {
            try
            {
                if (Connexion::$connexion == null)
                {
                    Connexion::$connexion = new PDO('mysql:host=127.0.0.1;port=8889;dbname=dbAnidoption','root','root');
                    Connexion::$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    Connexion::$connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                }

            } catch (PDOException $erreur)
            {
                echo $erreur->getMessage();
            }
            
            return Connexion::$connexion;
        }
    }
    