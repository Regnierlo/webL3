<!--template du contenu spécifique à la page carte, avec une différenciation selon le rôle stocké dans les variables de session-->
<?php
    if ($_SESSION['template']['role'] == $roles['Interdit'])
        echo '<h1>Cette carte n’existe pas ou ne vous est pas accessible.</h1>';
    else
    {
        echo '<h1>'.$controleur->getCarte()->getNom().'</h1>';
        echo '<p>';
        echo 'Création de la carte : '.$controleur->getCarte()->getDateCreation().'<br/>';
        echo 'Dernière modification : '.$controleur->getCarte()->getDateModification().'<br/>';
        echo 'Carte '.$controleur->getCarte()->getAccessibilite().'<br/>';
        echo '</p>';
        echo '<section id="carte" class="';
                if ($_SESSION['template']['role'] == $roles["Consultant"]) echo 'large_100'; else echo 'large_66';
                echo ' gauche fond-listique">';
            include_once 'scripts/php/afficher_carte.php';
        echo '</section>';
        if ($_SESSION['template']['role'] == $roles["Admin"] && $_SESSION["template"]["connecte"] == true)
        {
            echo
                '<div class="large_33 gauche">
                <section id="edition">
                    <p>Éditer la carte</p>
                    <input id="saisie-nom-elt" class="champ gauche large_50 arrondi fond-violet" type="text"/> 
                    <input id="renommer" class="champ gauche large_50 arrondi fond-violet" type="button" value="Renommer"/>
                    <input id="ajouter-fils" class="champ large_100 arrondi fond-violet" type="button" value="Ajouter un fils"/>
                    <input id="ajouter-frere" class="champ large_100 arrondi fond-violet" type="button" value="Ajouter un frère"/>
                    <input id="supprimer" class="champ large_100 arrondi fond-violet" type="button" value="Supprimer"/>
                </section>
                <section id="administration">
                    <p>Gérer ';if ($controleur->getCarte()->getAccessibilite() != 'Public') echo 'les droits et'; echo ' la carte</p>';
            if ($controleur->getCarte()->getAccessibilite() != 'Public') {
                echo '<table id="utilisateurs" class="large_100">';
                include_once 'scripts/php/afficher_utilisateurs.php?maj=vrai';//solution moisie mais… mais j’ai pas le choix voilà
                echo '</table>';
            }
            echo    '< input id = "coche-publique" class="champ gauche large_50 arrondi fond-violet" type = "checkbox" value = "Publique" />';
            if ($controleur->getCarte()->getAccessibilite() != 'Public')
            {
                echo '< input id = "saisie-pseudo-partage" class="champ gauche large_50 arrondi fond-violet" type = "text" />
                    <input id = "partager-carte" class="champ gauche large_50 arrondi fond-violet" type = "button" value = "Partager" />';
            }
                echo '<input id="saisie-nom-carte" class="champ gauche large_50 arrondi fond-violet" type="text"/>
                    <input id="renommer-carte" class="champ gauche large_50 arrondi fond-violet" type="button" value="Renommer"/>
                    <input id="supprimer-carte" class="champ large_100 arrondi fond-violet" type="button" value="Supprimer carte"/>
                </section>
            </div>';
        }
        elseif ($_SESSION['template']['role'] == $roles["Editeur"] && $_SESSION["template"]["connecte"] == true)
        {
            echo
                '<div class="large_33 gauche">
                <section id="edition">
                    <p>Éditer la carte</p>
                    <input id="saisie-nom-elt" class="champ gauche large_50 arrondi fond-violet" type="text"/> 
                    <input id="renommer" class="champ gauche large_50 arrondi fond-violet" type="button" value="Renommer"/>
                    <input id="ajouter-fils" class="champ large_100 arrondi fond-violet" type="button" value="Ajouter un fils"/>
                    <input id="ajouter-frere" class="champ large_100 arrondi fond-violet" type="button" value="Ajouter un frère"/>
                    <input id="supprimer" class="champ large_100 arrondi fond-violet" type="button" value="Supprimer"/>
                </section>';
            if ($controleur->getCarte()->getAccessibilite() != 'Public')
            {
                echo '    
                    <section id="administration">
                        <p>Liste des utilisateurs ayant des droits</p>
                        <table id="utilisateurs" class="large_100">';
                include_once 'scripts/php/afficher_utilisateurs.php?maj=vrai';//solution moisie mais… mais j’ai pas le choix voilà
                echo '</table>
                    </section>';
            }
            echo'</div>';
        }
    }
?>
