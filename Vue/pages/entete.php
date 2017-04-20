    <img id="navigation_accueil" src="../images/Licorne.png" alt="Logo Listique" height="30px"/>
    <input class="champ arrondi fond-rose" type="text"/>
    <input class="champ arrondi fond-rose" type="button" name="recherche" value="Chercher une carte "/>
<?php
    if ($_SESSION["template"]["connecte"] == false)
    {
        print '<div class="droite">';
        print	'<input id="navigation_inscription" class="champ arrondi fond-rose" type="button" name="inscription" value="Inscription"/>';
        print	'<input id="navigation_connexion" class="champ arrondi fond-rose" type="button" name="connexion" value="Connexion"/>';
        print '</div>';
    }
    elseif ($_SESSION["template"]["connecte"] == true)
    {
        print '<div class="droite">';
        print   '<form method="'.$type_requete.'" action="../scripts/deconnexion.php">';
        print 	    '<input id="navigation_compte" class="champ arrondi fond-rose" type="button" name="compte" value="Mon compte"/>';
        print 	    '<input class="champ arrondi fond-rose" type="submit" name="deconnexion" value="Déconnexion"/>';
        print   '</form>';
        print '</div>';
    }
?>