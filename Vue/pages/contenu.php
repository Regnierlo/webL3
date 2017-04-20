<!--template qui définit le template spécifique qui sera appelé en fonction de la page sélectionnée dans les variables de session-->

<?php
	if ($_SESSION["template"]["page"] == $pages["Accueil"])
	{
		include ("pages/accueil.php");
	}
	elseif ($_SESSION["template"]["page"] == $pages["Compte"])
	{
		include ("pages/compte.php");
	}
	elseif ($_SESSION["template"]["page"] == $pages["Carte"])
	{
		include ("pages/carte.php");
	}
	elseif ($_SESSION["template"]["page"] == $pages["Connexion"])
	{
		include ("pages/connexion.php");
	}
	elseif ($_SESSION["template"]["page"] == $pages["Inscription"])
	{
		include ("pages/inscription.php");
	}
?>