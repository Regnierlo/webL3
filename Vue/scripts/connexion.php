<!--script php qui gère la connexion d’un utilisateur-->

<?php
    include '../config/config.php';
    include '../test/test.php';

    //récupération sécurisée des champs
    $pseudo = htmlentities($_REQUEST['saisie_pseudo']);
    $mdp = htmlentities($_REQUEST['saisie_mdp']);

    //vérification des valeurs de connexion
    $valide = connecter($pseudo, $mdp);

    //redirection
    if ($valide == true)
    {
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['template']['connecte'] = true;
        //$_SESSION['template']['page'] = $pages['Compte'];
        header('Location: ../compte.php');
    }
    else
    {
        header('Location: ../connexion.php?valide=faux');
    }
?>