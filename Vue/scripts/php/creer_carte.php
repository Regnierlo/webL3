<!--script php qui gère la création d’une carte-->

<?php
    include '../../config/config.php';
    include "../../$adresse_controleur";

    //récupération sécurisée des champs
    $nom_carte = htmlentities($_REQUEST['saisie_nom_carte']);
    var_dump($_REQUEST['saisie_nom_carte']);

    $id = creationCarte($nom_carte);
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