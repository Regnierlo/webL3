<h1>Inscription</h1>
<?php
    if($_SESSION["template"]["connecte"] == false) {
        print '<section id="inscription" class="fond-listique">';
        print
            '<form method=' . $type_requete . ' action="../scripts/inscription.php">
                <div class="champ gauche large_50">Prénom</div>
                <input class="champ droite large_50 arrondi fond-violet" type="text" name="saisie_prenom" value="Entrez votre prénom"/>
                <div class="champ gauche large_50">Nom</div>
                <input class="champ droite large_50 arrondi fond-violet" type="text" name="saisie_nom" value="Entrez votre nom"/>
                <div class="champ gauche large_50">Adresse e-mail</div>
                <input class="champ droite large_50 arrondi fond-violet" type="text" name="saisie_mail" value="Entrez votre adresse e-mail"/>
                <div class="champ gauche large_50">Pseudonyme</div>
                <input class="champ droite large_50 arrondi fond-violet" type="text" name="saisie_pseudo" value="Entrez votre pseudonyme"/>
                <div class="champ gauche large_50">Mot de passe</div>
                <input class="champ droite large_50 arrondi fond-violet" type="password" name="saisie_mdp" value="*****"/>
                <input class="large_100 arrondi fond-violet" type="submit" name="submit_inscription" value="S’inscrire"/>
            </form>';
        if ($_REQUEST['valide'] == 'faux')
            print '<section class="centre">Valeurs d’inscription non valides</section>';
        print '</section>';
    }
    else
        print '<section>Vous êtes déjà connecté</section>';
?>
