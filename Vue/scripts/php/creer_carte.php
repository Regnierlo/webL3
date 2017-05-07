<!--script php qui gère la création d’une carte-->

<?php
    echo 'debut';
    include_once '../../config/config.php';
    //include_once "../../$adresse_controleur";
    $controleur = $_SESSION['controleur'];
    echo 'recupération contrôleur';

    //récupération sécurisée des champs
    $nom_carte = htmlentities($_REQUEST['saisie_nom_carte']);
    echo 'recupération nom carte';
    $ok = $controleur->creationCarte($nom_carte, 'Prive');
    echo 'creation de la carte';
    var_dump($controleur);

    var_dump($ok);
    if ($ok != false)
    {
        $_SESSION['template']['role'] = $roles['Admin'];
        $id = $controleur->getCarte()->getId();
        var_dump($id);
        header("Location: ../../carte.php?carte=$id");
    }
    else
    {
        header('Location: ../../compte.php?valide=faux');
    }
?>