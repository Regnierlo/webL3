<!--page d’une carte, on change récupère les données et on appelle le template-->

<?php
    include 'config/config.php';
    include $adresse_controleur;
    $controleur = new Controller();

    $_SESSION['template']['page'] = $pages['Carte'];

    //gestion des données de la carte
    if (isset($_REQUEST['carte']))
    {

        $id_carte = $_REQUEST['carte'];

        //récupération des données de la carte
        $donnees = $controleur->recuperationDonneesCarte($id_carte);

        if ($donnees != false)
        {
            //affectation des données
            $_SESSION['carte']['id'] = $id_carte;
            $_SESSION['carte']['nom'] = 'toto';
            $_SESSION['carte']['role'] = $roles['Consultant'];
            $_SESSION['carte']['elt'] = null;
            $_SESSION['carte']['donnees'] = $donnees;
        }
        else
        {
            //suppression des données de la carte si elle existait
            unset($_SESSION['carte']);
            $_SESSION['carte']['role'] = $roles['Interdit'];
        }
    }
    else
    {
        //suppression des données de la carte si elle existait
        unset($_SESSION['carte']);
        $_SESSION['carte']['role'] = $roles['Interdit'];
    }
    include 'pages/template.php';
?>