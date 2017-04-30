<!--script php qui gère la déconnexion d’un utilisateur-->

<?php
    include_once '../../config/config.php';

    //procédure de déconnexion
    $_SESSION['pseudo'] = null;
    $_SESSION['template']['connecte'] = false;
    header('Location: ../../accueil.php');
?>