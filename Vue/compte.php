<!--page de compte, on change la variable et on appelle le template-->

<?php
    include_once 'config/config.php';
    //include_once $adresse_controleur;
    $controleur = $_SESSION['controleur'];

    $_SESSION['template']['page'] = $pages['Compte'];
    //paramètre d’afficha des cartes
    $cartes = $type_affichage_cartes['Compte'];
    //données du compte
    $compte = $controleur->getCompte();

    include_once 'pages/template.php';
?>