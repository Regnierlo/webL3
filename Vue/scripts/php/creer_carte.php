<!--script php qui gère la création d’une carte-->

<?php
    include_once '../../config/config.php';
    //include_once "../../$adresse_controleur";
    $controleur = $_SESSION['controleur'];

    //récupération sécurisée des champs
    $nom_carte = htmlentities($_REQUEST['saisie_nom_carte']);
    $ok = $controleur->creationCarte($nom_carte, 'Prive');
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