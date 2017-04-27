<!--template du contenu spécifique à la page de connexion, pas la peine de l’afficher s’il est connecté-->

<h1>Connexion</h1>
<?php
    if($_SESSION["template"]["connecte"] == false) {
        echo '<section id="connexion" class="fond-listique">';
        echo
            '<form method="'.$type_requete.'" action="scripts/php/connexion.php">
                <div class="champ gauche large_50">Pseudonyme</div>
                <input class="champ droite large_50 arrondi fond-violet" type="text" name="saisie_pseudo" value="Entrez votre pseudonyme"/>
                <div class="champ gauche large_50">Mot de passe</div>
                <input class="champ droite large_50 arrondi fond-violet" type="password" name="saisie_mdp" value="*****"/>
                <input class="champ large_100 arrondi fond-violet" type="submit" name="submit_connexion" value="Se connecter"/>
            </form>';
        if ($_REQUEST['valide'] == 'faux')
            echo '<section class="centre">Valeurs de connexion non valides</section>';
        echo '</section>';
    }
    else
        echo '<section>Vous êtes déjà connecté</section>';

?>
