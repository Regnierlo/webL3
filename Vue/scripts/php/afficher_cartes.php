<!--affiche les cartes publiques ou sur la page du compte d’un utilisateur connecté-->

<?php
    include 'config/config.php';
    include $adresse_controleur;

    function affiche_publiques($type_requete)
    {

        //récupération des cartes
        $cartes = recuperationCartesPubliques();

        //on trie dans le sens inverse des identifiants (le plus récent en premier)
        krsort($cartes);

        //affichage des cartes
        foreach ($cartes as $i => $carte)
        {
            print '<form method="'.$type_requete.'" action="carte.php">';
            //print   '<input type="hidden" name="nom_carte" value="'.$carte["Nom"].'"/>';
            print   '<input type="hidden" name="carte" value="'./*$carte["Id"]*/$i.'"/>';
            print   '<input class="champ carte-listee gauche arrondi fond-publique" type="submit" value="'.$carte["Nom"].'"/>';
            print '</form>';
        }
    }

    function affiche_compte($type_requete, $roles)
    {
        //construction du tableau en vue de l’affichage
        $cartes = array();
        //récupération des cartes privées
        foreach (recuperationCartesPrivees() as $i => $carte)
        {
            $cartes[$i] = $carte;
            $cartes[$i]['Type'] = 'privee';
        }
        //récupération des cartes partagées
        foreach (recuperationCartesPartagees() as $i => $carte)
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
            print '<form method="'.$type_requete.'" action="carte.php">';
            //print   '<input type="hidden" name="nom_carte" value="'.$carte["Nom"].'"/>';
            print   '<input type="hidden" name="carte" value="'./*$carte["Id"]*/$i.'"/>';
            print   '<input class="champ carte-listee gauche arrondi fond-'.$couleur_fond.'" type="submit" value="'.$carte["Nom"].'"/>';
            print '</form>';
        }

    }

    if($cartes == $type_affichage_cartes['Publiques'])
        affiche_publiques($type_requete);
    else if ($cartes == $type_affichage_cartes['Compte'])
        affiche_compte($type_requete, $roles);
?>

