<?php
    session_start();
    include '../config/config.php';
    include '../test/test.php';

    //récupération sécurisée des champs
    $pseudo = htmlentities($_REQUEST['saisie_pseudo']);
    $mdp = htmlentities($_REQUEST['saisie_mdp']);
    $prenom = htmlentities($_REQUEST['saisie_prenom']);
    $nom = htmlentities($_REQUEST['saisie_nom']);
    $mail = htmlentities($_REQUEST['saisie_mail']);

    //vérification des valeurs de connexion
    $valide = creer_compte($pseudo, $mdp, $prenom, $nom, $mail);

    //redirection
    if ($valide == true)
    {
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['template']['connecte'] = true;
        $_SESSION['template']['page'] = $pages['Compte'];
        header('Location: ../pages/template.php');
    }
    else
    {
        header('Location: ../pages/template.php?valide=faux');
    }
?>