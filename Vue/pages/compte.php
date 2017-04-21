<!--template du contenu spécifique au compte, on vérifie qu’il est connecté avant d’afficher ses données-->

<h1>Mon compte</h1>
<?php
    if ($_SESSION["template"]["connecte"] == true) {
        print
            '<section id="infos">
                <div>
                    <div>Nom</div>
                    <div>Prénom</div>
                    <div>E-mail</div>
                </div>
                <div class="droite">
                    <input class="champ arrondi fond-privee" type="button" name="creer_carte" value="Créer carte"/>
                </div>
            </section>
            <h1>Mes cartes</h1>
            <section id="cartes" class="fond-listique">';
        //affichage des cartes
        $cartes = "compte";
        include 'scripts/php/afficher_cartes.php';

        print '</section>';
    }
    else
        print '<section>Vous n’êtes pas connecté</section>';
?>