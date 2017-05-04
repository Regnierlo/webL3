<!--template du contenu spécifique au compte, on vérifie qu’il est connecté avant d’afficher ses données-->

<h1>Mon compte</h1>
<?php
    if ($_SESSION["template"]["connecte"] == true) {
        echo
            '<section id="infos">
                <div class="gauche large_66">
                    <div class="gauche marge-gauche large_50">Pseudonyme</div><div class="gauche large_50">'./*$_SESSION['compte']['pseudo']*/$compte->getLogin().'</div>
                    <div class="gauche marge-gauche large_50">Nom</div><div class="gauche large_50">'./*$_SESSION['compte']['nom']*/$compte->getNom().'</div>
                    <div class="gauche marge-gauche large_50">Prénom</div><div class="gauche large_50">'./*$_SESSION['compte']['prenom']*/$compte->getPrenom().'</div>
                    <div class="gauche marge-gauche large_50">E-mail</div><div class="gauche large_50">'./*$_SESSION['compte']['email']*/$compte->getEMail().'</div>
                </div>
                <div class="gauche large_33">
                    <form method="'.$type_requete.'" action="scripts/php/creer_carte.php">
                        <input class="champ large_100 arrondi fond-privee" type="text" name="saisie_nom_carte" value="Saisissez le nom de la carte"/>
                        <input class="champ large_100 arrondi fond-privee" type="submit" value="Créer carte"/>
                    </form>';
        if ($_REQUEST['valide'] == 'faux')
            echo '<section class="centre">Problème lors de la création de la carte</section>';
        echo   '</div>
            </section>
            <h1>Mes cartes</h1>
            <section id="cartes" class="fond-listique">';
        //affichage des carte
        include_once 'scripts/php/afficher_cartes.php';

        echo '</section>';
    }
    else
        echo '<section>Vous n’êtes pas connecté</section>';
?>