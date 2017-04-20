<?php
	if ($_SESSION["template"]["page"] == $pages["Accueil"])
	{
		include ("accueil.php");
	}
	elseif ($_SESSION["template"]["page"] == $pages["Compte"])
	{
		include ("compte.php");
	}
	elseif ($_SESSION["template"]["page"] == $pages["Carte"])
	{
		include ("carte.php");
	}
	elseif ($_SESSION["template"]["page"] == $pages["Connexion"])
	{
		include ("connexion.php");
	}
	elseif ($_SESSION["template"]["page"] == $pages["Inscription"])
	{
		include ("inscription.php");
	}
?>