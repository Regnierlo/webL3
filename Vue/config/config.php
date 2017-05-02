<!--configuration et variables utiles pour la gestion des templates et d’autres éléments de la partie vue-->

<?php
	//variables utiles
	$type_requete = 'get';
	//$adresse_controleur = 'test/test.php';

    //insertion du contrôleur
    $adresse_controleur = '../Controller/Controller.php';
	if (file_exists($adresse_controleur))
        include_once "$adresse_controleur";
	elseif (file_exists("../$adresse_controleur"))
        include_once "../$adresse_controleur";
	elseif (file_exists("../../$adresse_controleur"))
        include_once "../../$adresse_controleur";

	//le session_start après la récupération de la classe
    session_start();

	//tableaux de semi-constantes
	$pages = array("Accueil" => 0, "Compte" => 1, "Carte" => 2, "Connexion" => 3, "Inscription" => 4);
	$roles = array("Admin" => 0, "Editeur" => 1, "Consultant" => 2, "Interdit" => 3);
	$type_affichage_cartes = array("Publiques" => 0, "Compte" => 1);

	//initialisation des variables du template si inexistant
	if (! isset($_SESSION["template"]))
		$_SESSION["template"] = array("connecte" => false, "page" => $pages["Accueil"], "role" => $roles["Consultant"]);
	if (! isset($_SESSION["controleur"]))
        $_SESSION["controleur"] = new Controller();

	//temporaire pour les tests
	//$_SESSION["template"]["connecte"] = true;
	//$_SESSION["template"]["page"] = $pages["Accueil"];
	//$_SESSION["template"]["role"] = $roles["Admin"];
?>
