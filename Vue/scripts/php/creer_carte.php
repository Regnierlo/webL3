<!--script php qui gère la création d’une carte-->

<?php
    include_once '../../config/config.php';
    //include_once "../../$adresse_controleur";
    $controleur = $_SESSION['controleur'];

    //récupération sécurisée des champs
    $nom_carte = htmlentities($_REQUEST['saisie_nom_carte']);
    var_dump($_REQUEST['saisie_nom_carte']);

    $id = $controleur->creationCarte($nom_carte, 'Prive');
    var_dump($id);

    if ($id != false)
    {
        $_SESSION['template']['role'] = $roles['Admin'];
        header("Location: ../../carte.php?carte=$id&nom_carte=$nom_carte");
    }
    else
    {
        header('Location: ../../compte.php?valide=faux');
    }
?>