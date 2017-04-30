<!--template qui définit le template spécifique qui sera appelé en fonction de la page sélectionnée dans les variables de session-->

<?php
	if ($_SESSION["template"]["page"] == $pages["Accueil"])
	{
		include_once ("pages/accueil.php");
	}
	elseif ($_SESSION["template"]["page"] == $pages["Compte"])
	{
		include_once ("pages/compte.php");
	}
	elseif ($_SESSION["template"]["page"] == $pages["Carte"])
	{
		include_once ("pages/carte.php");
	}
	elseif ($_SESSION["template"]["page"] == $pages["Connexion"])
	{
		include_once ("pages/connexion.php");
	}
	elseif ($_SESSION["template"]["page"] == $pages["Inscription"])
	{
		include_once ("pages/inscription.php");
	}
?>