<?php
	if (PAGE == $pages["Accueil"])
	{
		include ("accueil.php");
	}
	elseif (PAGE == $pages["Compte"])
	{
		include ("compte.php");
	}
	elseif (PAGE == $pages["Carte"])
	{
		include ("carte.php");
	}
	elseif (PAGE == $pages["Connexion"])
	{
		include ("connexion.php");
	}
	elseif (PAGE == $pages["Inscription"])
	{
		include ("inscription.php");
	}
?>