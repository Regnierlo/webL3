<!--template du contenu spécifique au compte, on vérifie qu’il est connecté avant d’afficher ses données-->

<h1>Mon compte</h1>
<?php
    if ($_SESSION["template"]["connecte"] == true) {
        print
            '<section id="infos">
                <div class="gauche large_66">
                    <div>Nom</div><div>'.$_SESSION['compte']['nom'].'</div>
                    <div>Prénom</div><div>'.$_SESSION['compte']['prenom'].'</div>
                    <div>E-mail</div><div>'.$_SESSION['compte']['email'].'</div>
                </div>
                <div class="gauche large_33">
                    <form method="'.$type_requete.'" action="scripts/php/creer_carte.php">
                        <input class="champ large_100 arrondi fond-privee" type="text" name="saisie_nom_carte" value="Saisissez le nom de la carte"/>
                        <input class="champ large_100 arrondi fond-privee" type="submit" value="Créer carte"/>
                    </form>';
        if ($_REQUEST['valide'] == 'faux')
            print '<section class="centre">Problème lors de la création de la carte</section>';
        print    '</div>
            </section>
            <h1>Mes cartes</h1>
            <section id="cartes" class="fond-listique">';
        //affichage des carte
        include 'scripts/php/afficher_cartes.php';

        print '</section>';
    }
    else
        print '<section>Vous n’êtes pas connecté</section>';
?>