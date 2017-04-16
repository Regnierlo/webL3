<?php
    print '<input class="champ arrondi fond-rose" type="text"/>';
    print '<input class="champ arrondi fond-rose" type="submit" name="recherche" value="Chercher une carte "/>';
    if (CONNECTE == 0)
    {
        print '<div class="droite">';
        print	'<input class="champ arrondi fond-rose" type="button" name="inscription" value="Inscription"/>';
        print	'<input class="champ arrondi fond-rose" type="button" name="connexion" value="Connexion"/>';
        print '</div>';
    }
    elseif (CONNECTE == 1)
    {
        print '<div class="droite">';
        print 	'<input class="champ arrondi fond-rose" type="button" name="deconnexion" value="Déconnexion"/>';
        print '</div>';
    }
?>