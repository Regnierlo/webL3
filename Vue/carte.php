<!--page d’une carte, on change récupère les données et on appelle le template-->

<?php
    include_once 'config/config.php';
    //include_once $adresse_controleur;
    $controleur = $_SESSION['controleur'];

    $_SESSION['template']['page'] = $pages['Carte'];
    //reset des variables liées à la carte s’il y en avait
    unset($_SESSION['carte']);
    $_SESSION['template']['role'] = $roles['Interdit'];

    //recherche le rôle de l’utilisateur pour la carte que l’on veut afficher (à corriger)
    function definirRole($roles)
    {
        $donnees = $_SESSION['carte']['donnees'];
        $publique = $donnees['publique'];
        if ($_SESSION['template']['connecte'] == false)
        {
            if ($publique == true)
                $_SESSION['template']['role'] = $roles['Consultant'];
        }
        else
        {
            $pseudo = $_SESSION['compte']['pseudo'];
            if ($donnees[$roles['Admin']] == $pseudo)
                $_SESSION['template']['role'] = $roles['Admin'];
            elseif (array_search($pseudo, $donnees[$roles['Editeur']]) != false || $donnees[$roles['Editeur']][0] == $pseudo)
                $_SESSION['template']['role'] = $roles['Editeur'];
            elseif ($publique == true || array_search($pseudo, $donnees[$roles['Consultant']]) != false|| $donnees[$roles['Consultant']][0] == $pseudo)
                $_SESSION['template']['role'] = $roles['Consultant'];
        }
    }

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
            $_SESSION['carte']['donnees'] = $donnees;
            $_SESSION['carte']['nom'] = $donnees['nom'];//à corriger
            $_SESSION['carte']['elt'] = null;

            //recherche et affectation du rôle de l’utilisateur
            definirRole($roles);
        }
    }
    include_once 'pages/template.php';
?>