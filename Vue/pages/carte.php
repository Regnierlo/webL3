<!--template du contenu spécifique à la page carte, avec une différenciation selon le rôle stocké dans les variables de session-->
<?php
    if ($_SESSION['template']['role'] == $roles['Interdit'])
        echo '<h1>Cette carte n’existe pas ou ne vous est pas accessible.</h1>';
    else
    {
        echo '<h1>'.$_SESSION['carte']['nom'].'</h1>';
        echo '<section id="carte" class="';
                if ($_SESSION['template']['role'] == $roles["Consultant"]) echo 'large_100'; else echo 'large_66';
                echo ' gauche fond-listique">';
            include 'scripts/php/afficher_carte.php';
        echo '</section>';

        if ($_SESSION['template']['role'] == $roles["Admin"] && $_SESSION["template"]["connecte"] == true)
        {
            echo
                '<div class="large_33 gauche">
                <section id="edition">
                    <input id="saisie-nom-elt" class="champ gauche large_50 arrondi fond-violet" type="text"/> 
                    <input id="renommer" class="champ gauche large_50 arrondi fond-violet" type="button" value="Renommer"/>
                    <input id="ajouter-fils" class="champ large_100 arrondi fond-violet" type="button" value="Ajouter un fils"/>
                    <input id="ajouter-frere" class="champ large_100 arrondi fond-violet" type="button" value="Ajouter un frère"/>
                    <input id="supprimer" class="champ large_100 arrondi fond-violet" type="button" value="Supprimer"/>
                </section>
                <section id="administration">
                    <table id="utilisateurs" class="large_100">';
            echo 'admin';
            include 'scripts/php/afficher_utilisateurs.php';
            echo   '</table>
                    <input id="saisie-pseudo-partage" class="champ gauche large_50 arrondi fond-violet" type="text"/>
                    <input id="partager-carte" class="champ gauche large_50 arrondi fond-violet" type="button" value="Partager"/>
                    <input id="saisie-nom-carte" class="champ gauche large_50 arrondi fond-violet" type="text"/>
                    <input id="renommer-carte" class="champ gauche large_50 arrondi fond-violet" type="button" value="Renommer"/>
                    <input id="supprimer-carte" class="champ large_100 arrondi fond-violet" type="button" value="Supprimer carte"/>
                </section>
            </div>';
        }

        if ($_SESSION['template']['role'] == $roles["Editeur"] && $_SESSION["template"]["connecte"] == true)
        {
            echo
                '<div class="large_33 gauche">
                <section id="edition">
                    <input id="saisie-nom-elt" class="champ gauche large_50 arrondi fond-violet" type="text"/> 
                    <input id="renommer" class="champ gauche large_50 arrondi fond-violet" type="button" value="Renommer"/>
                    <input id="ajouter-fils" class="champ large_100 arrondi fond-violet" type="button" value="Ajouter un fils"/>
                    <input id="ajouter-frere" class="champ large_100 arrondi fond-violet" type="button" value="Ajouter un frère"/>
                    <input id="supprimer" class="champ large_100 arrondi fond-violet" type="button" value="Supprimer"/>
                </section>
                <section id="administration">
                    <table id="utilisateurs" class="large_100">';
            echo 'editeur';
            include 'scripts/php/afficher_utilisateurs.php';
            echo   '</table>
                </section>
            </div>';
        }
    }
?>
