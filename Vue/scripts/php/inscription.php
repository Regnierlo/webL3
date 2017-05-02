<!--script php qui gère l’inscription d’un utilisateur-->

<?php
    include_once '../../config/config.php';
    //include_once "../../$adresse_controleur";
    $controleur = $_SESSION['controleur'];
    var_dump( $controleur);

    //récupération sécurisée des champs
    $pseudo = htmlentities($_REQUEST['saisie_pseudo']);
    $mdp = htmlentities($_REQUEST['saisie_mdp']);
    $prenom = htmlentities($_REQUEST['saisie_prenom']);
    $nom = htmlentities($_REQUEST['saisie_nom']);
    $mail = htmlentities($_REQUEST['saisie_mail']);

    //vérification des valeurs de connexion
    $valide = $controleur->inscription($pseudo, $mdp, $prenom, $nom, $mail);

    //redirection
    if ($valide == true)
    {
        $_SESSION['template']['connecte'] = true;
        header('Location: ../../compte.php');
    }
    else
    {
        header('Location: ../../inscription.php?valide=faux');
    }
?>