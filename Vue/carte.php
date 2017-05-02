<!--page d’une carte, on change récupère les données et on appelle le template-->

<?php
    include_once 'config/config.php';
    //include_once $adresse_controleur;
    $controleur = $_SESSION['controleur'];

    $_SESSION['template']['page'] = $pages['Carte'];
    //reset des variables liées à la carte s’il y en avait
    //unset($_SESSION['carte']);
    $_SESSION['template']['role'] = $roles['Interdit'];

    //recherche le rôle de l’utilisateur pour la carte que l’on veut afficher (à corriger)
    function definirRole($roles, $controleur)
    {
        //$donnees = $_SESSION['carte']['donnees'];
        //$publique = $donnees['publique'];
        $carte = $controleur->getCarte();
        $publique = $carte->getPublique();
        if ($_SESSION['template']['connecte'] == false)
        {
            if ($publique == 'Public')
                $_SESSION['template']['role'] = $roles['Consultant'];
        }
        else
        {
            $pseudo = $_SESSION['compte']['pseudo'];
            if ($carte->getAdmin() == $pseudo)
                $_SESSION['template']['role'] = $roles['Admin'];
            elseif (array_search($pseudo, $carte->getListeEditeur()) != false || $carte->getListeEditeur()[0] == $pseudo)
                $_SESSION['template']['role'] = $roles['Editeur'];
            elseif ($publique == true || array_search($pseudo, $carte->getListeConsultant()) != false|| $carte->getListeConsultant()[0] == $pseudo)
                $_SESSION['template']['role'] = $roles['Consultant'];
        }
    }

    //gestion des données de la carte
    if (isset($_REQUEST['carte']))
    {
        $id_carte = $_REQUEST['carte'];

        //récupération des données de la carte
        $res = $controleur->recuperationCarte($id_carte);

        if ($res != false)
        {
            //affectation des données
            /*$_SESSION['carte']['id'] = $id_carte;
            $_SESSION['carte']['donnees'] = $donnees;
            $_SESSION['carte']['nom'] = $donnees['nom'];//à corriger
            $_SESSION['carte']['elt'] = null;*/
            $_SESSION['elt_select'] = null;

            //recherche et affectation du rôle de l’utilisateur
            definirRole($roles, $controleur);
        }
    }
    include_once 'pages/template.php';
?>