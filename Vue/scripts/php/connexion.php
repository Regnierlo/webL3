<!--script php qui gère la connexion d’un utilisateur-->

<?php
    include_once '../../config/config.php';
    //include_once "../../$adresse_controleur";
    $controleur = $_SESSION['controleur'];

    //récupération sécurisée des champs
    $pseudo = htmlentities($_REQUEST['saisie_pseudo']);
    $mdp = htmlentities($_REQUEST['saisie_mdp']);

    //vérification des valeurs de connexion
    $valide = $controleur->connexion($pseudo, $mdp);

    //redirection
    if ($valide == true)
    {
        $_SESSION['template']['connecte'] = true;
        header('Location: ../../compte.php');
    }
    else
    {
        header('Location: ../../connexion.php?valide=faux');
    }
?>