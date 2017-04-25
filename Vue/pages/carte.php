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
                    <input id="saisie-nom-elt" class="champ large_50 arrondi fond-violet" type="text"/> 
                    <input id="renommer" class="champ large_50 arrondi fond-violet" type="button" value="Renommer"/>
                    <input id="ajouter-fils" class="champ large_100 arrondi fond-violet" type="button" value="Ajouter un fils"/>
                    <input id="ajouter-frere" class="champ large_100 arrondi fond-violet" type="button" value="Ajouter un frère"/>
                    <input id="supprimer" class="champ large_100 arrondi fond-violet" type="button" value="Supprimer"/>
                </section>
                <section id="administration">
                    <table class="large_100">
                        <tr>
                            <td/><td>Autoriser édition</td><td>Autoriser consultation</td>
                        </tr>
            
                        <tr><!--ligne de gestion des droits pour un utilisateur-->
                            <td>Pseudo</td>
                            <td class="centre"><input class="autoriser-edition" type="checkbox" value="pseudo"/></td>
                            <td class="centre"><input class="retirer-partage" type="checkbox" value="pseudo" checked="checked"/></td>
                        </tr>
                    </table>
                    <input id="saisie-pseudo-partage" class="champ large_50 arrondi fond-violet" type="text"/>
                    <input id="partager-carte" class="champ large_50 arrondi fond-violet droite" type="button" value="Partager"/>
                    <input id="saisie-nom-carte" class="champ large_50 arrondi fond-violet" type="text"/>
                    <input id="renommer-carte" class="champ large_50 arrondi fond-violet droite" type="button" value="Renommer"/>
                    <input id="supprimer-carte" class="champ large_100 arrondi fond-violet" type="button" value="Supprimer carte"/>
                </section>
            </div>';

        if ($_SESSION['carte']['role'] == $roles["Editeur"] && $_SESSION["template"]["connecte"] == true) print
            '<div class="large_33 gauche">
                <section id="edition">
                    <input id="saisie-nom-elt" class="champ large_50 arrondi fond-violet" type="text"/> 
                    <input id="renommer" class="champ large_50 arrondi fond-violet" type="button" value="Renommer"/>
                    <input id="ajouter-fils" class="champ large_100 arrondi fond-violet" type="button" value="Ajouter un fils"/>
                    <input id="ajouter-frere" class="champ large_100 arrondi fond-violet" type="button" value="Ajouter un frère"/>
                    <input id="supprimer" class="champ large_100 arrondi fond-violet" type="button" value="Supprimer"/>
                </section>
                <section id="administration">
                    <table class="large_100">
                        <tr>
                            <td/><td>Droit d’édition</td>
                        </tr>
            
                        <tr><!--ligne de visualisation des droits pour un utilisateur-->
                            <td>Pseudo</td>
                            <td class="centre"><input disabled="disabled" type="checkbox"/></td>
                        </tr>
                    </table>
                </section>
            </div>';
    }
?>
