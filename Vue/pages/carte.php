<?php
	print '<h1>'. '</h1>';
	print '<section id="carte" class="large_65 gauche">';

	print '</section>';
	print '<div class="large_33 gauche">';
        print '<section id="edition">';
            print '<input class="large_100 arrondi fond-rose" type="button" name="ajouter_fils" value="Ajouter un fils"/>';
            print '<input class="large_100 arrondi fond-rose" type="button" name="ajouter_frere" value="Ajouter un frère"/>';
            print '<input class="large_100 arrondi fond-rose" type="button" name="modifier" value="Modifier"/>';
            print '<input class="large_100 arrondi fond-rose" type="button" name="supprimer" value="Supprimer"/>';
        print '</section>';
        print '<section id="administration">';
            print '<table class="large_100">';
                print '<tr>';
                    print '<td/><td>Autoriser édition</td><td>Retirer partage</td>';
                print '</tr>';

                print '<tr>';
                    print '<td>'.'</td>';
                    print '<td><input class="arrondi fond-rose" type="checkbox" name="autoriser_edition"/></td>';
                    print '<td><input class="arrondi fond-rose" type="radio" name="retirer_partage"/></td>';
                print '</tr>';

            print '</table>';
        print '</section>';
	print '</div>';
?>