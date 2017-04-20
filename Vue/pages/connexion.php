<h1>Connexion</h1>
<?php
    if($_SESSION["template"]["connecte"] == false) {
        print '<section id="connexion" class="fond-listique">';
        print
            '<form method=' . $type_requete . ' action="../scripts/connexion.php">
                <div class="champ gauche large_50">Pseudonyme</div>
                <input class="champ droite large_50 arrondi fond-violet" type="text" name="saisie_pseudo" value="Entrez votre pseudonyme"/>
                <div class="champ gauche large_50">Mot de passe</div>
                <input class="champ droite large_50 arrondi fond-violet" type="password" name="saisie_mdp" value="*****"/>
                <input class="champ large_100 arrondi fond-violet" type="submit" name="submit_connexion" value="Se connecter"/>
            </form>';
        if ($_REQUEST['valide'] == 'faux')
            print '<section class="centre">Valeurs de connexion non valides</section>';
        print '</section>';
    }
    else
        print '<section>Vous êtes déjà connecté</section>';

?>
