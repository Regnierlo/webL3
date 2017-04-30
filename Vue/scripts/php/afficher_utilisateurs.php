<?php
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

    //si c’est une mise à jour, on la traite ici (c’est pas le mieux à cet endroit en effet)
    if (isset($_REQUEST['maj']))
        if ($_REQUEST['maj'] == 'vrai')
        {
            //inclusions indispensables
            include_once '../../config/config.php';
            //include_once_once "../../$adresse_controleur";
            $controleur = $_SESSION['controleur'];

            //récupération des nouvelles données
            $donnees = $controleur->recuperationDonneesCarte($_SESSION['carte']['id']);
            $_SESSION['carte']['donnees'] = $donnees;

            //recherche et affectation du rôle de l’utilisateur
            definirRole($roles);
        }

    $donnees = $_SESSION['carte']['donnees'];

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
                <td>';echo $donnees[$roles['Admin']];echo'</td>
                <td class="centre"><input class="autoriser-edition" disabled="disabled" type="checkbox" checked="checked"/></td>
            </tr>';

    //affichage des éditeurs
    foreach ($donnees[$roles['Editeur']] as $utilisateur)
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
    foreach ($donnees[$roles['Consultant']] as $utilisateur)
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