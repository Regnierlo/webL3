<?php
    /** Recherche le rôle de l’utilisateur pour la carte que l’on veut afficher
     * @param $roles Tableau des rôles
     * @param $controleur Contrôleur à utiliser
     *
     */
    function definirRole($roles, $controleur)
    {
        //$donnees = $_SESSION['carte']['donnees'];
        //$publique = $donnees['publique'];
        $carte = $controleur->getCarte();
        $publique = $carte->getPublique();
        if ($_SESSION['template']['connecte'] == false)
        {
            if ($publique == 'Public')
                $_SESSION['template']['role'] = $roles['Editeur'];
        }
        else
        {
            $pseudo = $_SESSION['compte']['pseudo'];
            if ($carte->getAdmin() == $pseudo)
                $_SESSION['template']['role'] = $roles['Admin'];
            elseif ($publique == true || array_search($pseudo, $carte->getListeEditeur()) != false || $carte->getListeEditeur()[0] == $pseudo)
                $_SESSION['template']['role'] = $roles['Editeur'];
            elseif (array_search($pseudo, $carte->getListeConsultant()) != false|| $carte->getListeConsultant()[0] == $pseudo)
                $_SESSION['template']['role'] = $roles['Consultant'];
        }
    }

    //inclusions indispensables
    include_once '../../config/config.php';
    //include_once_once "../../$adresse_controleur";
    $controleur = $_SESSION['controleur'];

    //si c’est une mise à jour, on la traite ici (c’est pas le mieux à cet endroit en effet)
    if (isset($_REQUEST['maj']))
        if ($_REQUEST['maj'] == 'vrai')
        {
            //récupération des nouvelles données, on ne la fait plus du tout, elle a déjà été effectuée par afficher_carte
            //$donnees = $controleur->recuperationDonneesCarte($_SESSION['carte']['id']);
            //$_SESSION['carte']['donnees'] = $donnees;

            //recherche et affectation du rôle de l’utilisateur
            definirRole($roles, $controleur);
        }

    //$donnees = $_SESSION['carte']['donnees'];
    $carte = $controleur->getCarte();

    //affichage de l’entête
    if ($_SESSION['template']['role'] == $roles['Admin'])
        echo   '<tr>
                    <td/><td>Autoriser édition</td><td>Autoriser consultation</td>
                 </tr>';
    elseif ($_SESSION['template']['role'] == $roles['Editeur'])
        echo   '<tr>
                     <td/><td>Droit d’édition</td>
                </tr>';

    //affichage de l’admin
    echo   '<tr>
                <td>';echo /*$donnees[$roles['Admin']]*/ $carte->getAdmin();echo'</td>
                <td class="centre"><input class="autoriser-edition" disabled="disabled" type="checkbox" checked="checked"/></td>
            </tr>';

    //affichage des éditeurs
    //foreach ($donnees[$roles['Editeur']] as $utilisateur)
    foreach ($carte->getListeEditeur() as $utilisateur)
    {
        if ($_SESSION['template']['role'] == $roles['Admin'])
        {
            echo   '<tr><!--ligne de gestion des droits pour un administrateur-->
                        <td>';echo $utilisateur;echo'</td>
                        <td class="centre"><input class="autoriser-edition" type="checkbox" value="';echo $utilisateur;echo'" checked="checked"/></td>
                        <td class="centre"><input class="retirer-partage" type="checkbox" value="';echo $utilisateur;echo'" checked="checked"/></td>
                    </tr>';
        }
        elseif ($_SESSION['template']['role'] == $roles['Editeur'])
        {
            echo   '<tr><!--ligne de visualisation des droits pour un éditeur-->
                        <td>';echo $utilisateur;echo'</td>
                        <td class="centre"><input disabled="disabled" type="checkbox" checked="checked"/></td>
                    </tr>';
        }
    }

    //affichage des consultants
    //foreach ($donnees[$roles['Consultant']] as $utilisateur)
    foreach ($carte->getListeConsultant() as $utilisateur)
    {
        if ($_SESSION['template']['role'] == $roles['Admin'])
        {
            echo   '<tr><!--ligne de gestion des droits pour un administrateur-->
                        <td>';echo $utilisateur;echo'</td>
                        <td class="centre"><input class="autoriser-edition" type="checkbox" value="';echo $utilisateur;echo'"/></td>
                        <td class="centre"><input class="retirer-partage" type="checkbox" value="';echo $utilisateur;echo'" checked="checked"/></td>
                    </tr>';
        }
        elseif ($_SESSION['template']['role'] == $roles['Editeur'])
        {
            echo   '<tr><!--ligne de visualisation des droits pour un éditeur-->
                        <td>';echo $utilisateur;echo'</td>
                        <td class="centre"><input disabled="disabled" type="checkbox"/></td>
                    </tr>';
        }
    }
?>