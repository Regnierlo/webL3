<!--template du contenu spécifique à la page carte, avec une différenciation selon le rôle stocké dans les variables de session-->
<?php
    if ($_SESSION['carte']['role'] == $roles['Interdit'])
        print '<h1>Cette carte n’existe pas ou ne vous est pas accessible</h1>';
    else
    {
        print '<h1>'.$_SESSION['carte']['nom'].'</h1>';
        print '<section id="carte" class="';
                if ($_SESSION['carte']['role'] == $roles["Consultant"]) print 'large_100'; else print 'large_66';
                print ' gauche fond-listique">';
            include 'scripts/php/afficher_carte.php';
        print '</section>';

        if ($_SESSION['carte']['role'] == $roles["Admin"] && $_SESSION["template"]["connecte"] == true) print
            '<div class="large_33 gauche">
                <section id="edition">
                    <input class="champ large_100 arrondi fond-violet" type="button" name="ajouter_fils" value="Ajouter un fils"/>
                    <input class="champ large_100 arrondi fond-violet" type="button" name="ajouter_frere" value="Ajouter un frère"/>
                    <input class="champ large_100 arrondi fond-violet" type="button" name="modifier" value="Modifier"/>
                    <input class="champ large_100 arrondi fond-violet" type="button" name="supprimer" value="Supprimer"/>
                </section>
                <section id="administration">
                    <table class="large_100">
                        <tr>
                            <td/><td>Autoriser édition</td><td>Retirer partage</td>
                        </tr>
            
                        <tr><!--ligne de gestion des droits pour un utilisateur-->
                            <td>Pseudo</td>
                            <td class="centre"><input class="arrondi fond-violet" type="checkbox" name="autoriser_edition"/></td>
                            <td class="centre"><input class="arrondi fond-violet" type="radio" name="retirer_partage"/></td>
                        </tr>
                    </table>
                    <input class="champ large_50 arrondi fond-violet" type="text" name="saisie_pseudo_partage"/>
                    <input class="champ large_50 arrondi fond-violet droite" type="button" name="champ_pseudo_partage" value="Partager"/>
                    <input class="champ large_50 arrondi fond-violet" type="text" name="saisie_nom_carte"/>
                    <input class="champ large_50 arrondi fond-violet droite" type="button" name="champ_nom_carte" value="Renommer"/>
                    <input class="champ large_100 arrondi fond-violet" type="button" name="supprimer_carte" value="Supprimer carte"/>
                </section>
            </div>';

        if ($_SESSION['carte']['role'] == $roles["Editeur"] && $_SESSION["template"]["connecte"] == true) print
            '<div class="large_33 gauche">
                <section id="edition">
                    <input class="champ large_100 arrondi fond-violet" type="button" name="ajouter_fils" value="Ajouter un fils"/>
                    <input class="champ large_100 arrondi fond-violet" type="button" name="ajouter_frere" value="Ajouter un frère"/>
                    <input class="champ large_100 arrondi fond-violet" type="button" name="modifier" value="Modifier"/>
                    <input class="champ large_100 arrondi fond-violet" type="button" name="supprimer" value="Supprimer"/>
                </section>
                <section id="administration">
                    <table class="large_100">
                        <tr>
                            <td/><td>Droit d’édition</td>
                        </tr>
            
                        <tr><!--ligne de visualisation des droits pour un utilisateur-->
                            <td>Pseudo</td>
                            <td class="centre"><input class="arrondi fond-violet" disabled="disabled" type="checkbox" name="autoriser_edition"/></td>
                        </tr>
                    </table>
                </section>
            </div>';
    }
?>
