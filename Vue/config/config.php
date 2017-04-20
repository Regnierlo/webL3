<!--configuration et variables utiles pour la gestion des templates et d’autres éléments de la partie vue-->

<?php
    session_start();
	//passage de l’adresse dans une variable, en cas de besoin
	//$_SESSION["adresse"] = 'ufrsciencestech.u-bourgogne.fr/~sm201172/Code/Vue/pages/template.php';
	//variables utiles
	$type_requete = 'get';
	//tableaux de constantes
	$pages = array("Accueil" => 0, "Compte" => 1, "Carte" => 2, "Connexion" => 3, "Inscription" => 4);
	$roles = array("Admin" => 0, "Editeur" => 1, "Consultant" => 2);

	//initialisation des variables du template si inexistant
	if (! isset($_SESSION["template"]))
		$_SESSION["template"] = array("connecte" => false, "page" => $pages["Accueil"], "role" => $roles["Consultant"]);
	if (! isset($_SESSION["pseudo"]))
		$_SESSION["pseudo"] = null;

	//temporaire pour les tests
	//$_SESSION["template"]["connecte"] = false;
	//$_SESSION["template"]["page"] = $pages["Accueil"];
	//$_SESSION["template"]["role"] = $roles["Admin"];
?>
