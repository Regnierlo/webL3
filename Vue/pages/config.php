<?php
	define(CONNECTE, 0);
	$pages = array("Accueil" => 0, "Compte" => 1, "Carte" => 2, "Connexion" => 3, "Inscription" => 4);
	define(PAGE, $pages["Accueil"]);
	$roles = array("Admin" => 0, "Editeur" => 1, "Consultant" => 2);
	define(ROLE, $roles["Consultant"]);
?>
