<!--affiche les cartes publiques ou sur la page du compte d’un utilisateur connecté-->

<?php
    include_once 'config/config.php';
    //include_once $adresse_controleur;
    $controleur = $_SESSION['controleur'];

    /** Affiche les cartes publiques pour la page accueil
     * @param $type_requete le type de requête (post ou get)
     * @param $controleur le contrôleur à utiliser
     */
    function affiche_publiques($type_requete, $controleur)
    {

        //récupération des cartes
        $cartes = $controleur->recuperationCartesPubliques();

        //on trie dans le sens inverse des identifiants (le plus récent en premier)
        krsort($cartes);

        //affichage des cartes
        foreach ($cartes as $i => $carte)
        {
            echo '<form method="'.$type_requete.'" action="carte.php">';
            //echo   '<input type="hidden" name="nom_carte" value="'.$carte["Nom"].'"/>';
            echo   '<input type="hidden" name="carte" value="'./*$carte["Id"]*/$i.'"/>';
            echo   '<input class="champ carte-listee gauche arrondi fond-publique" type="submit" value="'.$carte["Nom"].'"/>';
            echo '</form>';
        }
    }

    /** Affiche les cartes privées et partagées pour la page compte
     * @param $type_requete le type de requête (post ou get)
     * @param $roles le tableau des rôles
     * @param $controleur le contrôleur à utiliser
     */
    function affiche_compte($type_requete, $roles, $controleur)
    {
        //construction du tableau en vue de l’affichage
        $cartes = array();
        //récupération des cartes privées
        foreach ($controleur->recuperationCartesPrivees() as $i => $carte)
        {
            $cartes[$i] = $carte;
            $cartes[$i]['Type'] = 'privee';
        }
        //récupération des cartes partagées
        foreach ($controleur->recuperationCartesPartagees() as $i => $carte)
        {
            $cartes[$i] = $carte;
            $cartes[$i]['Type'] = 'partagee';
        }

        //on trie dans le sens inverse des identifiants (le plus récent en premier)
        krsort($cartes);

        //affichage des cartes
        foreach ($cartes as $i => $carte)
        {
            //on commence par déterminer la couleur du fond, elle apportear des informations sur le type de carte
            $couleur_fond = 'rose';
            switch ($carte['Type'])
            {
                case 'privee' :
                    $couleur_fond = 'privee';
                    break;
                case 'partagee' :
                    switch ($carte['Role']) {
                        case $roles['Admin'] :
                            $couleur_fond = 'admin';
                            break;
                        case $roles['Editeur'] :
                            $couleur_fond = 'editeur';
                            break;
                        case $roles['Consultant'] :
                            $couleur_fond = 'consultant';
                            break;
                    }
                    break;
            }

            //affichage en lui-même
            echo '<form method="'.$type_requete.'" action="carte.php">';
            //echo   '<input type="hidden" name="nom_carte" value="'.$carte["Nom"].'"/>';
            echo   '<input type="hidden" name="carte" value="'./*$carte["Id"]*/$i.'"/>';
            echo   '<input class="champ carte-listee gauche arrondi fond-'.$couleur_fond.'" type="submit" value="'.$carte["Nom"].'"/>';
            echo '</form>';
        }

    }

    if($cartes == $type_affichage_cartes['Publiques'])
        affiche_publiques($type_requete, $controleur);
    else if ($cartes == $type_affichage_cartes['Compte'])
        affiche_compte($type_requete, $roles, $controleur);
?>

