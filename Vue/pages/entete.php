<!--template de l’entête commmune à toutes les pages, il y a une distinction selon que l’utilisateur est connecté ou non pour l’affichage des boutons en haut à droite-->

<img id="navigation_accueil" class="gauche" src="images/Licorne.png" alt="Logo Listique" height="30px"/>
<input class="gauche champ arrondi fond-rose" type="text" name="saisie_recherche"/>
<input class="champ arrondi fond-rose" type="button" name="recherche" value="Chercher une carte "/>
<?php
    if ($_SESSION["template"]["connecte"] == false)
    {
        echo '<div class="droite">';
        echo   '<form class="gauche" method="'.$type_requete.'" action="inscription.php">';
        echo	    '<input id="navigation_inscription" class="champ arrondi fond-rose" type="submit" value="Inscription"/>';
        echo   '</form>';
        echo   '<form class="droite" method="'.$type_requete.'" action="connexion.php">';
        echo	    '<input id="navigation_connexion" class="champ arrondi fond-rose" type="submit" value="Connexion"/>';
        echo   '</form>';
        echo '</div>';
    }
    elseif ($_SESSION["template"]["connecte"] == true)
    {
        echo '<div class="droite">';
        echo   '<form class="gauche" method="'.$type_requete.'" action="compte.php">';
        echo 	    '<input id="navigation_compte" class="champ arrondi fond-rose" type="submit" value="Mon compte"/>';
        echo   '</form>';
        echo   '<form class="droite" method="'.$type_requete.'" action="scripts/php/deconnexion.php">';
        echo 	    '<input class="champ arrondi fond-rose" type="submit" value="Déconnexion"/>';
        echo   '</form>';
        echo '</div>';
    }
?>